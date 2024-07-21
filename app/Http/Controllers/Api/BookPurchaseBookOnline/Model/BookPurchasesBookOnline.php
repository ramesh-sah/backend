<?php

namespace App\Http\Controllers\Api\BookPurchaseBookOnline\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPurchasesBookOnline extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'book_purchases_book_onlines_id';
    protected $fillable = [
        'purchase_id',
        'online_id'
    ];
}
