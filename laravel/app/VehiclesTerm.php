<?php


namespace App;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Lang;

class VehiclesTerm extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'info',
        'amount',
        'min_price',
        'max_price'
    ];
    protected $dates = ['deleted_at'];

    public function ScopeCarTerms($query, $id){
        return $query->with('trans')->whereIn('id', $id);
    }
    public function info(){
        return $this->hasOne(VehiclesTermTranslation::class, 'term_id', 'id');
    }
    public function trans(){
        return $this->info()->where('lang', Lang::locale());
    }
    public function scopeTranslate($query, $lang){
        return $query->with(['info' => function($query) use ($lang)
        {
            $query->where('vehicles_terms_translation.lang', $lang);
        }]);
    }
    public function hasAmount() : bool
    {
        return $this->amount == 1;
    }
    public function getTermPriceByDays($days){
        if(empty($this->price)){
            return null;
        }

        return $this->countTermPrice($this->id, $days);

    }
    public function countTermPrice($term_id, $days){
        $term = $this->where('id', $term_id)->first();
	if(empty($term)){
		return null;
	}

        $total = $term->price * $days;

        if(empty($term->price)){
            return null;
        }

        if(!empty($term->min_price) && $total < $term->min_price){
            return number_format($term->min_price / $days, 2);
        }
        if(!empty($term->max_price) && $total > $term->max_price){
            return number_format($term->max_price / $days, 2);
        }

        return $term->price;
    }

    public function getTermPriceContent($days = null){
        if($days == null) {
            if ($_GET)
                $days = Helper::finalDays($_GET);
            else
                $days = 1;
        }
        return $this->getTermPriceByDays($days);
    }

    public function transl(){
        return VehiclesTermTranslation::where('term_id', $this->id)->where('lang', Lang::locale())->first();

    }
    public function isFree() : bool {
        return $this->price === null;
    }
    public function getVehicleTerms($terms_id, $days){
        $arr = [];
        foreach ($terms_id as $key => $term){
            $arr[$key]['price'] = $this->countTermPrice($term, $days);
            $arr[$key]['id'] = $term;
        }

        return $arr;

    }
}
