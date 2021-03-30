@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row justivy-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <h3>Book list</h3>
                    <div class="make-inline">
                        <form action="{{route('book.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Author: </label>
                                <select class="form-control" name="author_id">
                                    <option value="0" disabled @if($filterBy == 0) selected @endif>Select Author</option>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" @if($filterBy == $author->id) selected @endif>
                                            {{$author->name}} {{$author->surname}} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @csrf
                            <label class="form-check-label" >Sort by title</label>
                            <label class="form-check-label" for="sortAscending">Ascending</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" id="sortAscending" name="sort" value="ascending" @if($sortBy == 'ascending') checked @endif>
                            </div>
                            <label class="form-check-label" for="sortAscending">Descending</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" id="sortDescending" name="sort" value="descending" @if($sortBy == 'descending') checked @endif>
                            </div>
                            <button type="submit" class="btn btn-info">FILTER</button>
                        </form>
                        <a class="btn btn-info" href="{{route('book.index')}}">Clear filter</a>
                        <a class="btn btn-info" href="{{route('book.index',['sort' => 'book_title'])}}">Sort books by title</a>
                        <a class="btn btn-info" href="{{route('book.index',['sort' => 'book_pages'])}}">Sort books by length</a>
                        
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