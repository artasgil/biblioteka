@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-striped">
            <tr>
                <th> Author ID </th>
                <th> Author name </th>
                <th> Author surname </th>
            </tr>
                <tr>
                    <td>{{ $author->id }} </td>
                    <td>{{ $author->name }} </td>
                    <td>{{ $author->surname }} </td>
                </tr>
        </table>
    </div>

@endsection
