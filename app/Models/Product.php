<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    // Relationship for id transcations items
    public function transactionsItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
