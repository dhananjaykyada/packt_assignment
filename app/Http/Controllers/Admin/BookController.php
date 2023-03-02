<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $books = Book::orderBy( 'created_at', 'DESC' )->paginate( 10 );

        return view( 'admin.books.index', compact( 'books' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'admin.books.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $request->validate( [
            'title'       => 'required',
            'author'      => 'required',
            'genre'       => 'required',
            'description' => 'required',
            'isbn'        => 'required',
            'publisher'   => 'required',
//            'image'        => '',
            'published'   => 'required',
        ] );

        $book              = new Book();
        $book->title       = $request->title;
        $book->author      = $request->author;
        $book->genre       = $request->genre;
        $book->description = $request->description;
        $book->isbn        = $request->isbn;
        $book->publisher   = $request->publisher;
        $book->published   = $request->published;

        try {
            if ( $book->save() ) {
                if ( $request->image ) {
                    $book->image = Storage::put( 'books', $request->image );
                    $book->save();
                }

                return redirect()->route( 'admin.books.index' )->withSuccess( 'New book added successfully' );
            }

            return redirect()->back()->withError( 'Book not saved.' )->withInput();

        } catch ( \Exception $e ) {
            return redirect()->back()->withError( $e->getMessage() )->withInput();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $book = Book::where( 'id', $id )->first();
        if ( ! $book ) {
            return redirect()->back()->withError( 'No book found.' );
        }

        return view( 'admin.books.edit', compact( 'book' ) );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        $book = Book::where( 'id', $id )->first();
        if ( ! $book ) {
            return redirect()->back()->withError( 'No book found.' );
        }

        $request->validate( [
            'title'       => 'required',
            'author'      => 'required',
            'genre'       => 'required',
            'description' => 'required',
            'isbn'        => 'required',
            'publisher'   => 'required',
//            'image'        => '',
            'published'   => 'required',
        ] );

        $book->title       = $request->title;
        $book->author      = $request->author;
        $book->genre       = $request->genre;
        $book->description = $request->description;
        $book->isbn        = $request->isbn;
        $book->publisher   = $request->publisher;
        $book->published   = $request->published;

        try {
            if ( $book->save() ) {
                if ( $request->image ) {
                    if ( $book->image && Storage::exists( $book->image ) ) {
                        Storage::delete( $book->image );
                    }

                    $book->image = Storage::put( 'books', $request->image );
                    $book->save();
                }

                return redirect()->route( 'admin.books.index' )->withSuccess( 'New book added successfully' );
            }

            return redirect()->back()->withError( 'Book not saved.' )->withInput();

        } catch ( \Exception $e ) {
            return redirect()->back()->withError( $e->getMessage() )->withInput();

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $book = Book::where( 'id', $id )->first();
        if ( ! $book ) {
            return redirect()->back()->withError( 'No book found.' );
        }
        try {
            if ( $book->delete() ) {
                if ( $book->image && Storage::exists( $book->image ) ) {
                    Storage::delete( $book->image );
                }

                return redirect()->back()->withSuccess( 'Book deleted successfully.' );
            }

            return redirect()->back()->withError( 'Book not deleted.' );

        } catch ( \Exception $e ) {
            return redirect()->back()->withError( $e->getMessage() )->withInput();

        }

    }
}
