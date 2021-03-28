@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit book information </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('book.update', [$book])}}">
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" type="text" name="book_title" value="{{$book->title}}">
                                <label>ISBN: </label>
                                <input class="form-control" type="text" name="book_isbn" value="{{$book->isbn}}">
                                <label>Pages: </label>
                                <input class="form-control" type="text" name="book_pages" value="{{$book->pages}}">
                                </label>About: </label>
                                <textarea id="summernote" class="form-control" name="book_about">{{$book->about}}</textarea>
                                <small class="text-muted">Please select author's name: </small>
                                <select name="author_id">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" @if($author->id == $book->author_id) selected @endif> {{$author->name}} {{$author->surname}} </option>
                                    @endforeach
                                </select>
                            @csrf
                            <div class="justify-content-md-end">
                                <button type="submit" class="btn btn-primary">EDIT</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    $(document).ready(function(){
        $('#summernote').summernote();
    });
    </script>

@endsection
