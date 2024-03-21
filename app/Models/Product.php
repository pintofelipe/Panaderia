<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'amount', 'price'];
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function orders() /* un producto esta en muchas ordenes*/
    {
        return $this->hasMany(Order::class); /*hasMany -> significa muchos - el producto esta en muchas ordenes*/
    }
    
}
