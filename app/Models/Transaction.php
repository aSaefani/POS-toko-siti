<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    
    protected $fillable = [
        'transaction_code', 'total', 'paid_amount', 'change_amount', 'user_id', 'is_printed'
    ];
    
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}