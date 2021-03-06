@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="form-row">
            <div class="form-group">
            <a href="{{route('book.create')}}" class="btn btn-success">Add book</a>
            </div>
        </div>
        <form action="{{ route('book.index') }}" method="GET">
            @csrf
            <div class="form-row">
                <label for="author_id" class="col-form-label text-md-right">{{ __('Filter by author name: ') }}</label>
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
                <label for="book_id" class="col-form-label text-md-right">{{ __('Filter by book name: ') }}</label>
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
        <div class="form-group">
            <a href="{{route('book.index')}}" class="btn btn-dark">Clear filter</a>
        </div>
        <div class="form-row">
            <div class="form-group col">
                <form method="get" action="{{route('books.pdf')}}">
                    <input style="display:none" name="sort" value='{{$sort}}'  />
                    <input style="display:none" name="direction" value='{{ $direction }}' />
                    <input style="display:none" name="authorid" value='{{ $author_id }}' />
                    <input style="display:none" name="bookid" value='{{ $book_id }}' />

                    <button class="btn btn-dark" >Export filtered and sorted Books table to pdf </button>
                </form>
            </div>
        </div>



        <table class="table table-striped">
            <tr>
                <th width="80px"> @sortablelink('id','ID') </th>
                <th width="150px"> @sortablelink('title','Title') </th>
                <th> @sortablelink('isbn','Isbn') </th>
                <th width="80px"> @sortablelink('pages','Pages') </th>
                <th> @sortablelink('about','About') </th>
                <th width="210px"> @sortablelink('author_id','Author name') </th>
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
                            <a class="btn btn-dark" href="{{route('book.pdf', [$book])}}">Export book</a>
                        </div>
                        <td>
                        <form method="post" action={{ route('book.destroy', [$book]) }}>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{-- {{$book->links()}} --}}

            {!! $books->appends(Request::except('page'))->render() !!}
        </div>


@endsection
