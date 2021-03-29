@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row justivy-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Book list</h3>
                    <a href="{{route('book.index',['sort' => 'book_title'])}}">Sort books by title</a>
                    <a href="{{route('book.index',['sort' => 'book_pages'])}}">Sort books by length</a>
                    <a href="{{route('book.index')}}">Default order</a>
                </div>
                <div class="card-body">
                <ul class="list-group">
                    @foreach($books as $book)
                        <li class="list-group-item list-line">
                            <div class="list-line__books">
                                <div class="list-line__books__title">
                                    {{$book->title}}
                                </div>
                                by 
                                <div class="list-line__books__author">
                                    {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}
                                </div>
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('book.show', [$book])}}" class="btn btn-info">PREVIEW</a>
                                <a href="{{route('book.edit', [$book])}}" class="btn btn-info">EDIT</a>
                                <form method="POST" action="{{route('book.destroy', [$book])}}">
                                @csrf
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection