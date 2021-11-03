@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Author') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('author.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="author_name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Author name') }}</label>

                                <div class="col-md-6">
                                    <input id="author_name" type="text" class="form-control @error('author_name') is-invalid @enderror" name="author_name" autofocus>
                                        @error('author_name')
                                        <span role="alert" class="invalid-feedback">
                                            <strong>*{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="author_surname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Author surname') }}</label>

                                <div class="col-md-6">
                                    <input id="book_isbn" type="text" class="form-control @error('author_surname') is-invalid @enderror" name="author_surname" autofocus>
                                        @error('author_surname')
                                        <span role="alert" class="invalid-feedback">
                                            <strong>*{{$message}}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
