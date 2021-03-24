@foreach($authors as $author)
    <a href="{{route('author.edit', [$author])}}">{{$author->name}} {{$author->surname}}</a><br>
@endforeach


