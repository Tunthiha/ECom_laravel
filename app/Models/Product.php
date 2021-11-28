<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','description','price','total_quantity','category_id','user_id'
    ];
    protected $appends = ['image_url'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function color()
    {
        return $this->belongsToMany(Color::class,'color_product');
    }
    public function size()
    {
        return $this->belongsToMany(Size::class,'size_product');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function image()
    {
        return $this->hasMany(Image::class);
    }
    public function addtocart()
    {
        return $this->hasMany(Addtocart::class);
    }
    public function order()
    {
        return $this->hasMany(order::class);
    }
}
