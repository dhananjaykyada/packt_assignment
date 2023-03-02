@extends('layouts.frontend.master')
@section('style')

@endsection
@section('content')

    <div class="mt-4 mb-5 p-5 bg-gradient bg-dark text-white rounded text-center">
        <h1>{{ $book->title }}</h1>
        <p>{{ $book->published }}</p>
    </div>

    <div class="container justify-content-center align-items-center my-5 py-5">
        <div class="row">
            <div class="col-md-4">
                @if($book->image && \Illuminate\Support\Facades\Storage::exists($book->image))
                    <img alt="{{ $book->title }}" class="w-100"
                         src="{{ \Illuminate\Support\Facades\Storage::url($book->image) }}">
                @else
                    <img alt="{{ $book->title }}" class="w-100"
                         src="{{ asset('frontend/images/book_placeholder.jpg') }}">
                @endif

                <div class="meta_information mt-5">
                    <p class="mb-2"><b>Author: </b>{{ $book->author }}</p>
                    <p class="mb-2"><b>Publisher: </b>{{ $book->publisher }}</p>
                    <p class="mb-2"><b>Published at: </b>{{ $book->published }}</p>
                    <p class="mb-2"><b>Genre: </b>{{ $book->genre }}</p>
                    <p class="mb-2"><b>ISBN: </b>{{ $book->isbn }}</p>
                </div>
            </div>
            <div class="col-md-8">
                <h2>{{ $book->title }}</h2>
                <div class="description_text">{{ $book->description }}</div>
            </div>
        </div>
    </div>
@endsection
