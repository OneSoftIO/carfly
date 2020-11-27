<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = 'terms';
    protected $fillable = [
        'term_group',

    ];
    public function childs(){
        return $this->hasMany(Term::class, 'term_group', 'id');
    }
    public function scopeParentTerm($query){
        return $query->where('term_group', 0);
    }
    public function trans(){
        return $this->hasOne(TermTranslation::class, 'term_id');
    }
    public function scopeChildTerm($query){
        return $query->whereNotIn('term_group', [0])->orderby('term_group');
    }
    public function scopeActive($query){
        return $query->with('trans')->where('status', 1);
    }

    public function translate(){
        return $this->hasOne(TermTranslation::class, 'term_id', 'id')->first();
    }

}
