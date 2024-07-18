<?php

namespace App\Http\Controllers\Api\BookPurchaseCategory\Model;

use App\Http\Controllers\Api\BookPurchase\Model\BookPurchase;
use App\Http\Controllers\Api\Category\Model\Category;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Ramsey\Uuid\Uuid;

class BookPurchaseCategory extends Model
{
    use HasFactory, HasUuids,  SoftDeletes, FilterQueryString;


    protected $table = 'book_purchases_categories';
    protected $primaryKey = 'book_purchases_categories_id';
    protected $filters = [
        'sort',
        'like',
        'in',
    ];

    protected $fillable = [
        'purchase_id',
        'category_id',
    ];
    protected $dates = ['deleted_at'];
    public function bookPurchaseForeign()
    {
        return $this->belongsTo(BookPurchase::class, 'purchase_id');
    }
    public function categoryForeign()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

   
}
