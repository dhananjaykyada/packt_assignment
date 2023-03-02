<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;


class BookController extends Controller {

    public function listBooks( Request $request ) {

        $book_query = Book::query();
        if ( isset( $request->search ) && $request->search ) {
            $book_query->where( 'title', 'like', '%' . $request->search . '%' )
                       ->orWhere( 'author', 'like', '%' . $request->search . '%' )
                       ->orWhere( 'isbn', 'like', '%' . $request->search . '%' )
                       ->orWhere( 'description', 'like', '%' . $request->search . '%' )
                       ->orWhere( 'genre', 'like', '%' . $request->search . '%' );
        }

        $books = $book_query->paginate( 8 );


        return BookResource::collection( $books );
    }
}
