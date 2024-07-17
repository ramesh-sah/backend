<?php

namespace App\Http\Controllers\Api\BookPurchaseAuthor\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPurchaseAuthor extends Model
{
    use HasFactory;

    protected $primaryKey = 'publisher_id';
    protected $fillable = [
        'author_id',
        'purchase_id',
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
