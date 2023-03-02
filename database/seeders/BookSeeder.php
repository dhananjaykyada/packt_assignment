<?php

namespace Database\Seeders;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $curl = curl_init();

        curl_setopt_array( $curl, array(
            CURLOPT_URL            => "https://fakerapi.it/api/v1/books?_quantity=10000",// your preferred link
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_TIMEOUT        => 30000,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER     => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ) );
        $response = curl_exec( $curl );
        $err      = curl_error( $curl );
        curl_close( $curl );

        if ( $err ) {
            echo "cURL Error #:" . $err;
            die;
        } else {
            $curl_response = json_decode( $response, true );
            if ( $curl_response && $curl_response['status'] = 'OK' ) {
                $books_insert_data = [];

                $books = $curl_response['data'];
                if ( $books ) {
                    foreach ( $books as $book ) {
                        $single_book_data                = [];
                        $single_book_data['title']       = $book['title'];
                        $single_book_data['author']      = $book['author'];
                        $single_book_data['genre']       = $book['genre'];
                        $single_book_data['description'] = $book['description'];
                        $single_book_data['isbn']        = $book['isbn'];
                        $single_book_data['publisher']   = $book['publisher'];
                        $single_book_data['image']       = '';
                        $single_book_data['published']   = $book['published'];
                        $single_book_data['created_at']  = Carbon::now();
                        $single_book_data['updated_at']  = Carbon::now();
                        $books_insert_data[]             = $single_book_data;
                    }
                }

                if ( $books_insert_data ) {
                    Book::insert( $books_insert_data );
                }
            }
        }
    }
}
