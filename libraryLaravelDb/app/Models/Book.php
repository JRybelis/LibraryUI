<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;

class Book extends Model
{
    use HasFactory;

    //logic moved out of controller:
    // public static function create(Request $request) 
    // {
    //     $book = new self;
    //     $book->title = $request->book_title;
    //     $book->isbn = $request->book_isbn;
    //     $book->pages = $request->book_pages;
    //     $book->about = $request->book_about;
    //     $book->author_id = $request->author_id;
    //     $book->save();
    // }

    public function bookAuthor()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
        
    public function bookPublisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }

    //IRL alternative to create & edit methods
    public static function new()
    {
        return new self;
    }
    public function refreshAndSaveBook(Request $request)
    {
        $this->title = $request->book_title;
        $this->isbn = $request->book_isbn;
        $this->pages = $request->book_pages;
        $this->about = $request->book_about;
        $this->author_id = $request->author_id;
        $this->publisher_id = $request->publisher_id;
        $this->save();
        return $this;
    }

    public function remove(Book $book)
    {
        $this->delete();
    }
}
