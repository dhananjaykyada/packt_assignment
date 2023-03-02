<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME', 'Assignment') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet"/>
    @yield('style')
</head>
<body>

@include('layouts.frontend.partials.header')

<div class="wrapper">
    @yield('content')
</div>
<!-- ./wrapper -->

@include('layouts.frontend.partials.footer')




@yield('modal')
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="application/javascript"
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="application/javascript">
    let token = '{{ csrf_token() }}';
    let api_url = '{{ env('APP_URL') . '/api/v1' }}';
</script>
<script type="application/javascript"
        src="{{ asset('frontend/js/theme.js') }}"></script>
@yield('script')

</body>
</html>
