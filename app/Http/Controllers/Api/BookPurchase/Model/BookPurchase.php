<?php

namespace App\Http\Controllers\Api\BookPurchase\Model;

use App\Http\Controllers\Api\CoverImage\Model\CoverImage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Ramsey\Uuid\Uuid;

class BookPurchase extends Model
{
    use HasFactory, HasUuids,  SoftDeletes, FilterQueryString;

    protected $table = 'book_purchases';
    protected $primaryKey = 'purchase_id';
    protected $filters = [
        'sort',
        'like',
        'in',
    ];
    protected $fillable = [
        'class_number',
        'title',
        'book_number',
        'sub_title',
        'edition_statement',
        'number_of_pages',
        'publication_year',
        'series_statement',
        'quantity',
        'online',
        'image_id',

    ];
    public function coverImageForeign()
    {
        return $this->belongsTo(CoverImage::class, 'image_id');
    }


    protected $dates = ['deleted_at'];
}
