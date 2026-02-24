<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    protected $fillable = [
        'book_code',
        'title',
        'author',
        'publisher',
        'year',
        'is_borrowed',
        'category_id',
        'cover_image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class)->where('status', 'borrowed');
    }
}
