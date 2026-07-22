<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    
    protected $fillable = [
        'name', 'sku', 'category', 'price', 'stock', 'image_url'
    ];
    
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
    
    public function isLowStock()
    {
        return $this->stock <= 5;
    }
}