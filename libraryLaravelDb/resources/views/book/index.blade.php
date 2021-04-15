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
                                <label>Select: </label>
                                <select class="form-control" name="author_id">
                                    <option value="0" disabled @if($filterBy == 0) selected @endif>Author</option>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" @if($filterBy == $author->id) selected @endif>
                                            {{$author->name}} {{$author->surname}} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @csrf
                            <div class="form-group make-inline">
                                <label>Choose: </label>
                                <select class="form-control" name="sort_type">
                                    <option value="0" disabled @if($sortType == '') selected @endif>Book sorting type</option>
                                    <option value="title" name="title" @if($sortType == 'title') selected @endif>Title</option>
                                    <option value="length" name="length" @if($sortType == 'length') selected @endif>Amount of pages</option>
                                </select>
                            </div>
                            <label class="form-check-label" >Sorting order:</label>
                            <label class="form-check-label" for="sortAscending">Ascending</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" id="sortAscending" name="sort" value="ascending" @if($sortBy == 'ascending') checked @endif>
                            </div>
                            <label class="form-check-label" for="sortAscending">Descending</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" id="sortDescending" name="sort" value="descending" @if($sortBy == 'descending') checked @endif>
                            </div>
                            <button type="submit" class="btn btn-secondary">FILTER</button>
                        </form>
                        <a class="btn btn-secondary" href="{{route('book.index')}}">Clear filter</a>
                    </div>
                <div class="card-body">
                <ul class="list-group">
                    @foreach($books as $book)
                        <li class="list-group-item list-line">
                            <div class="list-line__books">
                                <div class="list-line__books__title">
                                    {{$book->title}}
                                </div>
                                <div class="list-line__books__author">
                                   by {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}, 
                                </div>
                                <div class="list-line__books__publisher">
                                    published at {{$book->bookPublisher->title}}
                                </div>
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('book.show', [$book])}}" class="btn btn-warning">PREVIEW</a>
                                <a href="{{route('book.makePdf', [$book])}}" class="btn btn-warning">DOWNLOAD PDF</a>
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