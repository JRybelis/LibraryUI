<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Validator;


class BookController extends Controller
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
        $authors = Author::all();
        
        //filtering
        if ($request->author_id) {
           $books = Book::where('author_id', $request->author_id)->get();
           $filterBy = $request->author_id;
        } else {
            $books = Book::all();
        }
        
        //sorting
        if ($request->sort && 'ascending' == $request->sort) {
            $books = $books->sortBy('title');
            $sortBy = 'ascending';
        }
        elseif ($request->sort && 'descending' == $request->sort) {
            $books = $books->sortByDesc('title');
            $sortBy = 'descending';
        }
        // if ('book_title' == $request->sort) {
        //     $books = Book::orderBy('title')->get();
        // } elseif ('book_pages' == $request->sort) {
        //     $books = Book::orderBy('pages')->get();
        // }
        
        return view('book.index', [
            'books' => $books, 
            'authors' => $authors,
            'filterBy' => $filterBy ?? 0, 
            'sortBy' => $sortBy ?? '' 
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('book.create', ['authors' => $authors, 'publishers' => $publishers]);
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
                'book_title' => ['required', 'max:255'],
                'book_isbn' => ['required', 'max:20'],
                'book_pages' => ['required'],
                'book_about' => ['required']
            ]
        );

        if ($validator->fails()){
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        // static function that creates the object. logic moved out
        // Book::create($request);

        //IRL alternative to the store method logic above
        Book::new()->refreshAndSaveBook($request);
        return redirect()->route('book.index')->with('success_message', 'The book record has been added to the library database.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view ('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make
        (
            $request->all(),
            [
                'book_title' => ['required', 'max:255'],
                'book_isbn' => ['required', 'max:20'],
                'book_pages' => ['required'],
                'book_about' => ['required']
            ]
        );

        if ($validator->fails()){
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        //simplest:
        // $book->title = $request->book_title;
        // $book->isbn = $request->book_isbn;
        // $book->pages = $request->book_pages;
        // $book->about = $request->book_about;
        // $book->author_id = $request->author_id;
        // $book->save();

        //IRL alternative to the update method logic in controller:
        $book->refreshAndSaveBook($request);
        return redirect()->route('book.index')->with('success_message', 'The book record has been updated in the library database.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //simplest:
        // $book->delete();
        
        //IRL alternative to the destroy method logic in controller:
        $book->remove($book);
        return redirect()->route('book.index')->with('success_message', 'The book record has been removed from the library database.');
    }
}
