<?php

namespace App\Http\Controllers\Admin;

use App\PostTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post, Auth, DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use App\Term;
use App\PostTerm;
class PostsController extends Controller
{
    public function PostPage(){

        $posts = Post::where('post_type', 'post')
            ->with(['translation' => function($query){
                $query->where('posts_translation.lang', 'lt');
            }])->get();
        return view('admin.posts.posts', compact('posts'));
    }
    public function Page(){
        $posts = Post::where('post_type', 'page')
            ->with(['translation' => function($query){
            $query->where('posts_translation.lang', 'lt');
        }])->get();
        return view('admin.pages.pages', compact('posts'));
    }
    public function PageCreate($lang){
        return view('admin.pages.create', compact('lang'));
    }
    public function PostCreate(){
        $terms = Term::parentTerm()->get();
        $termChild = Term::childTerm()->get();
        return view('admin.posts.create', compact('terms', 'termChild'));

    }
    public function AddPostToDB(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $this->AddPost($request, 'post');

        return back()->with('success', 'Įrašas sukurtas');

    }
    public function AddPageToDB(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $this->AddPost($request, 'page');

        return back()->with('success', 'Puslapis sukurtas');

    }
    function AddTerm($terms, $id){

        foreach($terms as $term){
            $postTerm = new PostTerm;
            $postTerm->post_id = $id;
            $postTerm->term_id = $term;
            $postTerm->save();
        }
    }
    public function UpdateTerm($terms, $id){
        $delete = PostTerm::where('post_id', $id)->whereNotIn('term_id', $terms)->delete();
        foreach($terms as $term):
            $row = PostTerm::where('post_id', $id)->where('term_id', $term)->first();
            if (!$row) {
                $add = new PostTerm;
                $add->post_id = $id;
                $add->term_id = $term;
                $add->save();
            }

        endforeach;
    }
    public function AddPost($request, $type){
        $userId = Auth::id();

        if($request->status == 'on'):
            $postStatus = true;
        else:
            $postStatus = false;
        endif;

        $image = $this->UploadImage($request, 'photo');

        $post = new Post;
        $post->post_author = 1;
        $post->status = $postStatus;
        $post->post_type = $type;
        $post->youtube_code = $request->youtube_code;
        $post->image = $image;
        $post->save();

        $this->tranlatePost($request, $post->id);

        if(isset($request->terms))
            $this->AddTerm($request->terms, $post->id);
    }
    protected function tranlatePost($request, int $id){
        $slug = Str::slug($request->name, '-');

        PostTranslation::updateOrCreate([
            'post_id' => $id,
            'lang' => $request->lang
        ],[
            'post_title' => $request->name,
            'slug' => $slug,
            'post_content' => $request->description,
            'post_short_content' => $request->short_description

        ]);
    }

    public function UploadImage($request,$name){
        if ($request->hasFile($name)):
            $image = $request->file($name);
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('images', $imageName);

            return $path;
        endif;
    }

    public function DeletePost($id){
        $delete = Post::destroy($id);
        return back()->with('success', 'Įrašas pašalintas');
    }
    public function PostEdit($id, $lang){

        $post = Post::where('id', $id)
            ->translation($lang)
            ->first();

        $terms = Term::parentTerm()->get();
        $termChild = Term::childTerm()->get();
        $activeTerms = PostTerm::ofPostId($id)->get();
        //return $activeTerms;
        return view('admin.pages.edit', compact('post', 'meta', 'terms', 'termChild', 'activeTerms', 'lang'));

    }
    public function DeletePostImage($id){
        $delete = Post::find($id);
        $delete->image = null;
        $delete->update();

        return back()->with('success', 'Nuotrauka pašalinta');
    }

    public function PostEditSave(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);
        $this->UpdatePost($request, $id);
        if($request->terms)
            $this->UpdateTerm($request->terms, $id);

        return back()->with('success', 'Atnaujinta');

    }

    public function UpdatePost($request, $id){
        $post = Post::find($id);

        if($request->status == 'on')
            $postStatus = true;
        else
            $postStatus = false;

        $image = $this->UploadImage($request, 'photo');

        $post->post_author = Auth::id();
        $post->status = $postStatus;
        $post->youtube_code = $request->youtube_code;
        if(!empty($image)):
            $post->image = $image;
        endif;
        $post->update();

        $this->updateOrCreateTrans($request, $post->id);

    }
    public function updateOrCreateTrans($request, int $id){
        $slug = Str::slug($request->name, '-');

        PostTranslation::updateOrCreate([
            'post_id' => $id,
            'lang' => $request->lang
        ],[
            'post_title' => $request->name,
            'slug' => $slug,
            'post_content' => $request->description,
            'post_short_content' => $request->short_description,
            'post_title_headline' => $request->title_headline,
            'meta_name' => $request->metadata_name,
            'meta_description' => $request->metadata_description,
            'meta_keywords' => $request->metadata_keywords,
        ]);
    }
}
