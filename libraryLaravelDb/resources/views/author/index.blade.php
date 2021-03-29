@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Authors list</h3>
                    <a href="{{route('author.index', ['sort' => 'surname'])}}">Sort authors by surname</a>
                    <a href="{{route('author.index', ['sort' => 'name'])}}">Sort authors by name</a>
                    <a href="{{route('author.index')}}">Default order</a>
                </div>
                <div class="card-body">
                <ul class="list-group">
                    @foreach($authors as $author)
                        <li class="list-group-item list-line">
                            <div> 
                                {{$author->name}} {{$author->surname}} 
                            </div>
                            <div class="list-line__buttons">
                                <a href="{{route('author.edit', [$author])}}" class="btn btn-info">EDIT</a>
                                <form method="POST" action="{{route('author.destroy', [$author])}}">
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


