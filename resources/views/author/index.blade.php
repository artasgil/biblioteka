@extends('layouts.app')

@section('content')

    <div class="container">
        @if(session()->has('error_message'))
    <div class="alert alert-danger">
    {{session()->get("error_message")}}
    </div>
    @endif

    @if(session()->has('sucess_message'))
    <div class="alert alert-success">
    {{session()->get("sucess_message")}}
    </div>
    @endif

        <div class="form-row">
            <div class="form-group">
            <a href="{{route('author.create')}}" class="btn btn-success">Add author</a>
            </div>
        </div>
        <table class="table table-striped">
            <tr>
                <th width="80px"> @sortablelink('id','ID') </th>
                <th width="150px"> @sortablelink('name','Name') </th>
                <th> @sortablelink('surname','Surname') </th>
                <th> Total books </th>
                <th> Action </th>
                <th> Delete </th>
            </tr>

            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->id }} </td>
                    <td>{{ $author->name }} </td>
                    <td>{{ $author->surname }} </td>
                    <td>{{ $author->authorAll->count() }} </td>



                    <td>
                        <div class="btn-group-vertical">
                            <a href="{{ route('author.show', [$author]) }}" class="btn btn-secondary">Show </a>
                            <a href="{{ route('author.edit', [$author]) }}" class="btn btn-primary">Edit </a>
                        </div>
                        <td>
                        <form method="post" action={{ route('author.destroy', [$author]) }}>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {{-- {{$authors->links()}} --}}

            {!! $authors->appends(Request::except('page'))->render() !!}

        </div>


@endsection
