<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'meta';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'description', 'keywords', 'page_id'];

    public static function getMetaData(){
        return [
            0 => [
                'name' => 'Titulinis',
                'id' => 'titulinis'
            ],
            1 => [
                'name' => 'Automobilių sąrašas',
                'id'  => 'auto-list'
            ],
            2 => [
                'name' => 'Straipsnių sąrašas',
                'id' => 'articles'
            ],
            3 => [
                'name' => 'Kontaktų puslapis',
                'id' => 'contacts'
            ]
        ];
    }

    public function getMeta(string $id){

        return $this->where('page_id', $id)->first();
    }
}
