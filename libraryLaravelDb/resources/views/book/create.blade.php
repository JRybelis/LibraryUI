@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add new book</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('book.store')}}">
                            <div class="form-group">
                                <label>Title: </label>
                                <input type="text" name="book_title" class="form-control">
                                <label>ISBN: </label>
                                <input type="text" name="book_isbn" class="form-control">
                                <label>Pages: </label>
                                <input type="text" name="book_pages" class="form-control">
                                <label>About: </label>
                                <textarea id="summernote" name="book_about" class="form-control"></textarea>
                                <small class="text-muted">Please select author's name: </small>
                                <select name="author_id">
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}">{{$author->name}} {{$author->surname}}</option>            
                                    @endforeach
                                </select>
                                
                            @csrf
                            <div class="justify-content-md-end">
                                <button type="submit" class="btn btn-primary">ADD</button>
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
