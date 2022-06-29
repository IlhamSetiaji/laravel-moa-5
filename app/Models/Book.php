<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'book_genres','book_id','genre_id');
    }

}
