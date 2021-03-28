<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //prohibits editing without being logged in.
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return view('author.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // static function that creates the object. logic moved out
        // Author::create($request); 
        
        //IRL alternative to the store method logic above
        Author::new()->refreshAndSaveAuthor($request);
        return redirect()-> route('author.index')->with('success_message', 'The author has been successfully added to the database.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view ('author.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //simplest:
        // $author->name = $request->author_name;
        // $author->surname = $request->author_surname;
        // $author->save();
        
        //logic moved out:
        // $author->edit($request);

        //IRL alternative to the update method logic above:
        $author->refreshAndSaveAuthor($request);
        return redirect()->route('author.index')->with('success_message', 'The author has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //simplest:
        // if($author->authorBooksList->count() !== 0) {
        //     return redirect()->route('author.index')->with('info_message', 'Unable to delete, as this author has books assigned.');
        // }
        // $author->delete();
        
        //logic moved out:
        $author->remove($author);
        return redirect()->route('author.index')->with('success_message', 'The author has been successfully deleted.');
    }
}
