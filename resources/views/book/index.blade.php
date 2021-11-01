@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="form-row">
            <div class="form-group col">
            <a href="{{route('book.create')}}" class="btn btn-success">Add book</a>
            </div>
        </div>
        <form action="{{ route('book.index') }}" method="GET">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-2">
                    <select class="form-control" name="author_id">
                        <option value="all" @if ($author_id == 'all') selected @endif > Visi </option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" @if ($author_id == $author->id) selected @endif>{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-info">Filter</button>
                    </div>
            </div>
        </form>
        <form action="{{ route('book.index') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <select class="form-control" name="book_id">
                        <option value="all" @if ($book_id == 'all') selected @endif > Visi </option>
                        @foreach ($booksFilter as $book)
                            <option value="{{ $book->id }}" @if ($book_id == $book->id) selected @endif>{{ $book->title }}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-info">Filter</button>
                    </div>
            </div>
        </form>



        <table class="table table-striped">

            <tr>
                <th> ID </th>
                <th> Title </th>
                <th> Isbn </th>
                <th> Pages </th>
                <th> About </th>
                <th> Author name </th>
                <th> Action </th>

                <th> Delete </th>




            </tr>

            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }} </td>
                    <td>{{ $book->title }} </td>
                    <td>{{ $book->isbn }} </td>
                    <td>{{ $book->pages}} </td>
                    <td>{!! $book->about !!} </td>
                    <td>{{ $book->bookAuthor->name }}</td>
                    <td>
                        <div class="btn-group-vertical">
                            <a href="{{ route('book.show', [$book]) }}" class="btn btn-secondary">Show </a>
                            <a href="{{ route('book.edit', [$book]) }}" class="btn btn-primary">Edit </a>
                        </div>
                        <td>
                        <form method="post" action={{ route('book.destroy', [$book]) }}>
                            @csrf
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                        <td>
                    </td>
            @endforeach
        </table>


        {{-- {{$book->links()}} --}}

        @if ($paginatonsettingg != 1)
            {!! $books->appends(Request::except('page'))->render() !!}
@endif



    </div>
@endsection
