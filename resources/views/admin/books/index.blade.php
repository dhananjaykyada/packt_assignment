@extends('layouts.admin.master')
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Books</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Books</h3>
                <div class="card-tools">
                    <a type="button" href="{{ route('admin.books.create') }}" class="btn btn-info">
                        Add Books
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th style="width: 1%">
                            #
                        </th>
                        <th style="width: 20%">
                            Title
                        </th>
                        <th style="width: 20%">
                            Author
                        </th>
                        <th style="width: 20%">
                            ISBN
                        </th>
                        <th style="width: 30%">
                            Image
                        </th>
                        <th style="width: 20%">
                            Action
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    @if($books)
                        @foreach($books as $book)
                            <tr>
                                <td> {{ $book->id }} </td>
                                <td> {{ $book->title }} </td>
                                <td> {{ $book->author }} </td>
                                <td> {{ $book->isbn }} </td>
                                <td>
                                    @if($book->image && \Illuminate\Support\Facades\Storage::exists($book->image))
                                        <img alt="{{ $book->name }}" class="table-avatar"
                                             src="{{ \Illuminate\Support\Facades\Storage::url($book->image) }}">
                                    @endif
                                </td>
                                <td class="actions">
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route('admin.books.edit',$book->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>

                                    <a class="btn btn-danger btn-sm delete_btn" href="javascript:void(0)">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>

                                    <form class="delete_form d-none"
                                          action="{{ route('admin.books.destroy',$book->id) }}"
                                          method="Post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">No Books Found</td>
                        </tr>
                    @endif

                    @if($book)
                        <tr>
                            <td colspan="4">
                                <div class="d-flex justify-content-start">
                                    {!! $books->links('vendor.pagination.bootstrap-4') !!}
                                </div>
                            </td>
                        </tr>
                    @endif
                    </tbody>


                </table>
            </div>

        </div>

    </section>

@endsection

@section('script')
    <script type="application/javascript">
        jQuery(document).ready(function ($) {
            $('.delete_btn').click(function (e) {
                e.preventDefault();
                let form = $(this).parent().find('.delete_form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        console.log(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
