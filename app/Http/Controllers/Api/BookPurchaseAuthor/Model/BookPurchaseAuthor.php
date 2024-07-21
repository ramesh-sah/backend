<?php

namespace App\Http\Controllers\Api\BookPurchaseAuthor\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPurchaseAuthor extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'book_purchase_authors';
    protected $fillable = [
        'author_id',
        'purchase_id',
    ];
}
