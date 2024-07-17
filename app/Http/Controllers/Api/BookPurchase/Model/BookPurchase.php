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
        'publisher_id'
    ];
    public function coverImageForeign()
    {
        return $this->belongsTo(CoverImage::class, 'image_id');
    }

    public function publisher()
    {
        return $this->hasOne(Publisher::class, 'publisher_id', 'publisher_id');
    }

    public function barcode()
    {
        return $this->hasMany(Barcode::class, 'purchase_id', 'purchase_id');
    }

    public function author()
    {
        return $this->hasManyThrough(Author::class, BookPurchaseAuthors::class, 'purchase_id', 'author_id', 'purchase_id', 'author_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, BookPurchasesCategories::class, 'purchase_id', 'category_id', 'purchase_id', 'category_id');
    }

    public function isbns()
    {
        return $this->hasManyThrough(Isbn::class, BookPurchasesIsbns::class, 'purchase_id', 'isbn_id', 'purchase_id', 'isbn_id');
    }

    public function online()
    {
        return $this->hasManyThrough(BookOnline::class, BookPurchasesBookOnlines::class, 'purchase_id', 'online_id', 'purchase_id', 'online_id');
    }

    protected $dates = ['deleted_at'];
}
