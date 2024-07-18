<?php

namespace App\Http\Controllers\Api\Author\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'author_id';
    protected $fillable = [
        "author_first_name",
        "author_middle_name",
        "author_last_name"
    ];
}
