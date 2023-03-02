<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BookResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray( $request ) {
        $image = '';
        if ( $this->image && Storage::exists( $this->image ) ) {
            $image = Storage::url( $this->image );
        } else {
            $image = asset( 'frontend/images/book_placeholder.jpg' );
        }

        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'author'      => $this->author,
            'genre'       => $this->genre,
            'description' => $this->description,
            'isbn'        => $this->isbn,
            'publisher'   => $this->publisher,
            'image'       => $image,
            'published'   => $this->published,
            'url'         => route( 'get-book', [ $this->id ] ),
        ];
    }
}
