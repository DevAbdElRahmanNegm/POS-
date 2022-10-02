<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [ 'category_id' ,'name', 'description','image' , 'purchase_price' , 'sale_price' , 'stock'];

    public $translatedAttributes = ['name' , 'description'];


    public function category(){

        return $this->belongsTo(Category::class);
    }


    public function getImagePathAttribute(){

        return asset('images/products/' . $this->image);
    }



    public function getProfitAttribute(){

        $profit = $this->sale_price - $this->purchase_price;


        return $profit;
    }

    public function orders(){

        return $this->belongsToMany(Order::class , 'product_order');
    }
}
