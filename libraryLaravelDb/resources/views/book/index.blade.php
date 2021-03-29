@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row justivy-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Book list</h3>

                    <form action="{{route('book.index')}}" method="get">
                        <div class="form-group">
                            <label>Author: </label>
                            <select name="author_id">
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif> {{$author->name}} {{$author->surname}} </option>
                                @endforeach
                            </select>
                        @csrf
                    </form>

                    <a class="btn btn-info" href="{{route('book.index',['sort' => 'book_title'])}}">Sort books by title</a>
                    <a class="btn btn-info" href="{{route('book.index',['sort' => 'book_pages'])}}">Sort books by length</a>
                    <a class="btn btn-info" href="{{route('book.index')}}">Default order</a>
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