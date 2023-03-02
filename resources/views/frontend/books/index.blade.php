@extends('layouts.frontend.master')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="mt-5 p-4 w-100">
            <div class="loader d-none">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control search_input"
                       placeholder="search by title, isbn, publisher, etc">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-search"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <div class="result_container mt-5">
                <h5 class="mb-4"><span class="total_books"></span> Books found.</h5>
                <div class="books_list"></div>
                <div class="book_result_pagination overflow-auto mt-5"></div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="application/javascript">
        jQuery(document).ready(function ($) {

            let page_number = 1;
            listData(page_number);

            $('.btn-search').click(function () {
                listData(1);
            });

            $(document).on('click', '.book_result_pagination .page-link', function () {
                let new_page_number = $(this).attr('data-page-number');
                listData(new_page_number);
            });

            $('.search_input').keypress(function (e) {
                var key = e.which;
                if (key == 13)  // the enter key
                {
                    $('.btn-search').click();
                }
            });

            function listData(page = 1) {
                let search = $('.search_input').val();
                toggleLoader();
                $.ajax({
                    url: api_url + '/list-books',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        '_token': token,
                        'page': page,
                        'search': search
                    },
                    success: function (response) {
                        toggleLoader();
                        addBookList(response.data);
                        addBookPagination(response.meta);
                    }
                });
            }

            function addBookList(book_data) {
                let list_html = '';
                if (book_data) {
                    list_html += '<div class="row">'
                    $(book_data).each(function (i, book) {
                        list_html += `
                           <div class="col-12 col-md-6 col-xl-3 mb-5">
                                <div class="card shadow">
                                    <img src="` + book.image + `" class="card-img-top" alt="` + book.title + `">
                                    <div class="card-body">
                                        <h4 class="card-title">  <a href="` + book.url + `">` + book.title + `</a></h4>
                                        <h6 class="author-title">` + book.author + `</h6>
                                        <ul class="list-unstyled my-4">
                                            <li><span class="icon me-2"><i class="fas fa-user"></i></span><span>` + book.author + `</span></li>
                                            <li><span class="icon me-2"><i class="fas fa-film"></i></span><span>` + book.genre + `</span></li>
                                            <li><span class="icon me-2"><i class="fas fa-book"></i></span><span>` + book.isbn + `</span></li>
                                            <li><span class="icon me-2"><i class="fas fa-newspaper"></i></span><span>` + book.publisher + `</span></li>
                                        </ul>
                                      <a href="` + book.url + `" class="btn btn-outline-info w-100">View</a>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    list_html += '</div>'
                }

                $('.books_list').html(list_html);
            }

            function addBookPagination(pagination_data) {
                let total_records = pagination_data.total;
                let total_pages = pagination_data.last_page;
                let current_page = pagination_data.current_page;

                $('.total_books').html(total_records);
                let pagination_html = '';
                pagination_html += `
                    <nav aria-label="Books pagination">
                      <ul class="pagination">
                      `;

                for (let i = 1; i <= total_pages; i++) {
                    let active_class = '';
                    if (current_page === i) {
                        active_class = 'active';
                    }
                    pagination_html += '<li class="page-item ' + active_class + '"><a class="page-link" data-page-number="' + i + '" href="javascript:void(0)">' + i + '</a></li>';
                }


                pagination_html += `
                      </ul>
                    </nav>
                `;


                $('.book_result_pagination').html(pagination_html);
            }

            function toggleLoader() {
                $('.loader').toggleClass('d-none');
            }

        });
    </script>
@endsection
