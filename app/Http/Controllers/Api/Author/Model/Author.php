<?php

namespace App\Http\Controllers\Api\Author\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class Author extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $primaryKey = 'publisher_id';
    protected $fillable = [
        'publisher_name',
        'publication_place',
    ];

    
}
