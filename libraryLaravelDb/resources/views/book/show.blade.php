@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$book->title}} by {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</div>
                    <div class="card-body">
                        {!!$book->about!!}

                        <a href="{{route('book.edit',[$book])}}" class="btn btn-info">EDIT BOOK</a>
                        <a href="{{route('author.edit',[$book->bookAuthor])}}" class="btn btn-info">EDIT AUTHOR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection