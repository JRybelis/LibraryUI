<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Author extends Model
{
    use HasFactory;
    
    public static function create(Request $request) //creates 
    {
        $author = new self;
        $author->name = $request->author_name;
        $author->surname = $request->author_surname;
        $author->save();
    }

    public function edit(Request $request)
    {
        $this->name = $request->author_name;
        $this->surname = $request->author_surname;
        $this->save();
    }
    
    // public static function destroy(Author $author)
    // {
    //     if($author->authorBooksList->count() !== 0) {
    //         return 'Unable to delete, as this author has books assigned.';
    //     }
    //     $author->delete();
    // }

    public function authorBooksList() 
    {
        return $this->hasMany('App\Models\Book', 'author_id', 'id');
    }
}
