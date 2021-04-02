@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$book->title}} by {{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}. Published at {{$book->bookPublisher->title}}.</div>
                    <div class="card-body">
                        {!!$book->about!!}

                        <a href="{{route('book.edit',[$book])}}" class="btn btn-info">EDIT BOOK</a>
                        <a href="{{route('author.edit',[$book->bookAuthor])}}" class="btn btn-info">EDIT AUTHOR</a>
                        <a href="{{route('publisher.edit',[$book->bookPublisher])}}" class="btn btn-info">EDIT PUBLISHER</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection