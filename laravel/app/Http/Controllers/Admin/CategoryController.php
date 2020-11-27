<?php

namespace App\Http\Controllers\Admin;

use App\TermTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Term;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function Page(){

        $terms = Term::with(['trans' => function($query){
            $query->where('terms_translation.lang', 'lt');
        }])
        ->get();
		return view('admin.category.category', compact('terms'));
	}
	public function PageCreate(){

        $terms = Term::parentTerm()->get();
		return view('admin.category.create', compact('terms'));

	}
	public function TermSave(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $this->AddTerm($request);

        return back()->with('success', 'Kategorija išsaugota');
    }
    public function AddTerm($request){

        if($request->status == 'on')
            $termStatus = true;
        else
            $termStatus = false;

        $term = new Term;
        $term->term_group = $request->parent;
        $term->status = $termStatus;
        $term->save();

        $this->termTransUpdate($request, $term->id);

    }
    public function TermEdit($id, $lang){
        $term = Term::where('id', $id)
        ->with(['trans' => function($query) use($lang){
            $query->where('terms_translation.lang', $lang);
        }])->first();

        $terms = Term::parentTerm()
        ->with(['trans' => function($query){
            $query->where('terms_translation.lang', 'lt');
        }])
            ->get();
        return view('admin.category.edit', compact('term', 'terms', 'lang'));
    }
    public function TermEditSave(Request $request, $id){
        if($request->status == 'on'):
            $termStatus = true;
        else:
            $termStatus = false;
        endif;

        $term = Term::find($id);
        $term->term_group = $request->parent;
        $term->status = $termStatus;
        $term->update();

        $this->termTransUpdate($request,$term->id);

        return back()->with('success', 'Kategorija atnaujinta.');
    }
    public function termTransUpdate($request, int $id){
        $slug = Str::slug($request->name, '_');

        TermTranslation::updateOrCreate([
            'term_id' => $id,
            'lang' => $request->lang
        ],[
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'meta_name' => $request->metadata_name,
            'meta_description' => $request->metadata_description,
            'meta_keywords' => $request->metadata_keywords,


        ]);
    }
}
