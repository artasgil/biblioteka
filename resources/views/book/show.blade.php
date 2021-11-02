@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-striped">
            <tr>
                <th> Book ID </th>
                <th> Book title </th>
                <th> Book isbn </th>
                <th> Book pages</th>
                <th> About book</th>
                <th> Book author name</th>
            </tr>
                <tr>
                    <td>{{ $book->id }} </td>
                    <td>{{ $book->title }} </td>
                    <td>{{ $book->isbn }} </td>
                    <td>{{ $book->pages}} </td>
                    <td>{!! $book->about !!} </td>
                    <td>{{ $book->bookAuthor->name }}</td>
                </tr>
        </table>

    </div>


@endsection
