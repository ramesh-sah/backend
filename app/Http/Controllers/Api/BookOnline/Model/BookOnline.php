<?php

namespace App\Http\Controllers\Api\BookOnline\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Ramsey\Uuid\Uuid;

class BookOnline extends Model
{
    use HasFactory, HasUuids, SoftDeletes, FilterQueryString;

    protected $table = 'book_onlines';
    protected $primaryKey = 'online_id';
    protected $filters = [
        'sort',
        'like',
        'in',
    ];

    protected $fillable = [
        'name',
        'price',
        'url'
    ];
    protected $dates = ['deleted_at'];

    
}
