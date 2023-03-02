@extends('layouts.admin.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Book</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form class="" action="{{ route('admin.books.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Book</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" id="author" name="author" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <input type="text" id="genre" name="genre" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" rows="6"
                                          class="form-control editor"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="isbn">ISBN</label>
                                <input type="text" id="isbn" name="isbn" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="publisher">Publisher</label>
                                <input type="text" id="publisher" name="publisher" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="published">Published</label>
                                <input type="date" id="published" name="published" class="form-control"/>
                            </div>


                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control"/>
                            </div>

                        </div>
                        <div class="card-footer text-muted">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="application/javascript">

    </script>
@endsection
