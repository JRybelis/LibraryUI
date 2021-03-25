<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use Illuminate\Http\Request;

class Book extends Model
{
    use HasFactory;

    public static function create(Request $request) 
    {
        $book = new self;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
    }

    public function bookAuthor()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
