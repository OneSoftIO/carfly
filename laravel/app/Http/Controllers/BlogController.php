<?php

namespace App\Http\Controllers;

use App\PostTerm;
use App\Term;
use App\TermTranslation;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    private $cats;

    public function __construct()
    {
        $this->cats = Term::active()->parentTerm()->with('childs')->get();
    }

    public function Page(){
        $posts = Post::getActivePost()->with('cat')->paginate(5);
        $cats = $this->cats;
        return view('blog.blog', compact('posts', 'cats'));
    }

    public function PageBlogPost($id, $slug){
        $post = Post::getPostBySlug($id)->with('cat')->first();


        if($post->translation->slug !== $slug){
            return redirect()->route('blog.post.page', ['id' => $id, 'slug' => $post->translation->slug]);
        }


        return view('blog.blog-post', compact('post'));
    }
    
    public function catIndex($id){
        $getPostsID = PostTerm::where('term_id', $id)->pluck('post_id')->toArray();
        $posts = Post::whereIn('id', $getPostsID)->getActivePost()->with('cat')->paginate(5);
        $cats = $this->cats;

        return view('blog.blog', compact('posts', 'cats'));
    }
}
