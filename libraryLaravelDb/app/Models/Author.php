<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
    use HasFactory;
    
    //logic moved out of controller:
    // public static function create(Request $request) //creates 
    // {
    //     $author = new self;
    //     $author->name = $request->author_name;
    //     $author->surname = $request->author_surname;
    //     $author->save();
    // }

    //simplest:
    // public function edit(Request $request)
    // {
    //     $this->name = $request->author_name;
    //     $this->surname = $request->author_surname;
    //     $this->save();
    // }
    
    public function authorBooksList() 
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }


    //IRL alternative to create & edit methods above
    public static function new() 
    {
        return new self;
    }

    public function refreshAndSaveAuthor(Request $request)
    {
        $this->name = $request->author_name;
        $this->surname = $request->author_surname;
        $this->save();
        return $this;
    }

    public function remove(Author $author)
    {
        if($this->authorBooksList->count() !== 0) {
            return false;
        }
        $this->delete();
        return true;
    }
}
