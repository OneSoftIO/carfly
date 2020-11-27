<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Post extends Model
{
    protected $table = 'posts';
    public function ScopeGetActivePost($query){
        return $query->where('post_type', 'post')
            ->where('status', true)
            ->with(['translation' => function($query){
                $query->where('posts_translation.lang', Lang::locale());
            }])
            ->orderBy('created_at', 'DESC');
    }
    public function scopeGetActiveCat($query){
        return $query->with(['cat' => function($query){
            $query->where('terms_translation.lang', Lang::locale());
        }]);
    }
    public function scopeTranslation($query, string $lang ){

        return $query->with(['translation' => function($query) use ($lang)
        {
            $query->where('posts_translation.lang', $lang);
        }]);

    }
    public function ScopeGetActivePage($query){
        return $query->where('post_type', 'page')->where('status', true)->orderBy('created_at', 'DESC');
    }
    public function scopeGetPostBySlug($query, $id){
        return $query->where('post_type', 'post')
            ->where('status', 1)
            ->where('id', $id)
            ->with(['translation' => function($query){
                $query->where('posts_translation.lang', Lang::locale());
        }]);
    }
    public function scopeGetActivePageBySlug($query, $slug){
        return $query
            ->where('post_type', 'page')
            ->where('status', true)
            ->whereHas('translation', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->with('translation');
    }
    public function Meta(){
        return $this->hasOne('App\PostMeta');
    }
    public function translation(){
        return $this->hasOne(PostTranslation::class, 'post_id', 'id');
    }
    public function hasYoutubeCode(){
        return (isset($this->youtube_code) && !empty($this->youtube_code))?true:false;
    }
    public function cat(){
        return $this->belongsToMany(Term::class, 'post_terms', 'post_id', 'term_id');
    }
    public function formatMonth() :string
    {
        Carbon::setLocale('lt');
        $createdDate =  new Carbon($this->created_at);

        return $createdDate->formatLocalized('%B');

    }
    public function trans(){
        return $this->translation()->first();
    }


}
