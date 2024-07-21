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

    // Static counter for custom IDs
    // private static $counter = 0;

    // public static function create(array $attributes = [])
    // {
    //     // Generate a custom ID
    //     self::$counter++;
    //     $customId = 'pub-' . str_pad(self::$counter, 4, '0', STR_PAD_LEFT);

    //     // Set the custom ID as the publisher_id
    //     $attributes['publisher_id'] = $customId;

    //     // Create the publisher
    //     return parent::create($attributes);
    // }
}
