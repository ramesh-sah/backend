<?php

namespace App\Http\Controllers\Api\BookReservation\Model;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReservation extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'reservation_id';
    protected $fillable = [
        'class_number',
        'book_number',
        'status',
        'member_id',
        'employee_id',
        'book_id'
    ];
}
