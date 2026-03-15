<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'total_quantity',
        'total_price',
        'transaction_date'
    ];

    // Relationship for id user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship for id transcations items
    public function transactionsItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
