<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv= "Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$book->title}}</title>
    </head>
        <style>
            @font-face {
                font-family: 'Monserrat';
                font-style: normal;
                font-weight: 400;
                src: url({{asset('fonts/Monserrat-Regular.ttf')}});
            }
            @font-face {
                font-family: 'Monserrat';
                font-style: normal;
                font-weight: bold;
                src: url({{asset('fonts/Monserrat-Bold.ttf')}});
            }
            body {
                font-family: 'Monserrat';
            }
        </style>
    <body>
        <h1>{{$book->title}}</h1>

        <h3><b>Publisher: </b> {{$book->bookPublisher->title}}</h3>
        <h4>{{$book->bookAuthor->name}} {{$book->bookAuthor->surname}}</h4>
        <div>{!!$book->about!!}</div>
    </body>
</html>