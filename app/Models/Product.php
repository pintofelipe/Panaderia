<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'quantity',
        'provider_id',
        'status',
        'registeredby',
    ];

    protected $guarded = [
        'id',
        'estatus',
        'registeredby'

    ];

    public function provider() {
        return $this->belongsTo(Provider::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
