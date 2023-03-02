<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'books', function ( Blueprint $table ) {
            $table->id();
            $table->char( 'title', 100 );
            $table->char( 'author', 100 );
            $table->char( 'genre', 100 );
            $table->longText( 'description', 100 )->nullable();
            $table->unsignedBigInteger( 'isbn' );
            $table->char( 'publisher', 50 );
            $table->char( 'image', 200 )->nullable();
            $table->date( 'published' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'books' );
    }
};
