<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $table = 'transactions_items';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    // Relationship for id transcations
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relationship for id product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
