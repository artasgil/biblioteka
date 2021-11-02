@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Book') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('book.update', [$book]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="book_title"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Book title') }}</label>

                                <div class="col-md-6">
                                    <input id="book_title" type="text" class="form-control @error('book_title') is-invalid @enderror" name="book_title" value="{{$book->title}}" autofocus>
                                        @error('book_title')
                                        <span role="alert" class="invalid-feedback">
                                            <strong>*{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="book_isbn"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Book isbn code') }}</label>

                                <div class="col-md-6">
                                    <input id="book_isbn" type="integer" class="form-control @error('book_isbn') is-invalid @enderror" name="book_isbn" value="{{$book->isbn}}" autofocus>
                                        @error('book_isbn')
                                        <span role="alert" class="invalid-feedback">
                                            <strong>*{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="book_pages"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Book pages') }}</label>
                            <div class="col-md-6">
                                <input id="book_pages" type="integer" class="form-control @error('book_pages') is-invalid @enderror" name="book_pages" value="{{$book->pages}}" autofocus>
                                    @error('book_pages')
                                    <span role="alert" class="invalid-feedback">
                                        <strong>*{{$message}}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>

                            <div class="form-group row">
                                <label for="book_about"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Book description') }}</label>

                                <div class="col-md-6">
                                    <textarea class="summernote @error('book_about') is-invalid @enderror" cols="38" rows="5"
                                        name="book_about">{{$book->about}}"</textarea>
                                        @error('book_about')
                                        <span role="alert" class="invalid-feedback">
                                            <strong>*{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="book_author"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Book author') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('book_author') is-invalid @enderror" name="book_author">
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}" @if($book->author_id == $author->id) selected @endif>{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('book_author')
                                    <span role="alert" class="invalid-feedback">
                                        <strong>*{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endsection
