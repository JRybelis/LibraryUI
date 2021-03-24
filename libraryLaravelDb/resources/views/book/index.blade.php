@foreach($books as $book)
    {{$book->title}} <a href="{{route('book.edit', [$book])}}">[EDIT]</a>
    <form method="POST" action="{{route('book.destroy', [$book])}}">
        @csrf
        <button type="submit">DELETE</button>
    </form>
    <br>
@endforeach