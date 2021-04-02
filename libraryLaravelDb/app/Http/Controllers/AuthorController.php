<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;


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
    public function index(Request $request)
    {
        if('name' == $request->sort) {
            $authors = Author::orderBy('name')->get();
        } elseif ('surname' == $request->sort) {
            $authors = Author::orderBy('surname')->get();
        } else {
            $authors = Author::all();
        }

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

        $validator = Validator::make
        (
            $request->all(),
            [
                'author_name' => ['required', 'min:2', 'max:64'],
                'author_surname' => ['required', 'min:2', 'max:64'],
            ],
            //custom error messages:
            // [
            //     'author_name.required' => 'Name field cannot be left blank.',
            //     'author_name.min' => 'Name must be at least 2 characters long.'
            // ],
            // [
            //     'author_surname.required' => 'Surname field cannot be left blank.',
            //     'author_surname.min' => 'Surname must be at least 2 characters long.'
            // ]
        );

        if ($validator->fails()){
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

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
        $validator = Validator::make
        (
            $request->all(),
            [
                'author_name' => ['required', 'min:2', 'max:64'],
                'author_surname' => ['required', 'min:2', 'max:64'],
            ]
       
        );

        if ($validator->fails()){
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

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
        if (($author->remove($author)) == false) {
            return redirect()->route('author.index')->with('info_message', 'Unable to delete, as this author has books assigned.');
        } else {
            return redirect()->route('author.index')->with('success_message', 'The author has been successfully deleted.');
        }
    }
}
