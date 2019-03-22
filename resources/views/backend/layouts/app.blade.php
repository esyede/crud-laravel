@php
$routeNames = Route::current()->getName();
$names = str_replace(['.', 'home'], ' ', $routeNames);
$array = explode(' ', trim($names));
if (count($array) == 1) {
    $array = ['dashboard'];
}
$breadcrumb = null;
foreach ($array as $value) {
    $breadcrumb .= '<li class="active">'.ucfirst($value).'</li>';
}
$second = $array[0];
unset($array[0]);
$rest = implode(' ', $array);
$second = empty($rest) ? 'Dashboard' : $second;
$pageTitle = ucfirst($second).'<small>'.ucwords(empty($rest) ? 'home' : $rest).'</small>';
if (mb_strpos($routeNames, 'downloads') !== false) {
    $pageTitle = 'Dashboard<small>Downloads</small>';
     $breadcrumb = '<li class="active">Downloads</li>';
}
if (mb_strpos($routeNames, 'tutorials') !== false) {
    $pageTitle = 'Dashboard<small>Tutorials</small>';
    $breadcrumb = '<li class="active">Tutorials</li>';
}
$breadcrumb = str_replace('One', 'Listing', $breadcrumb);
$pageTitle = str_replace('One', 'Listing', $pageTitle);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="generator" content="{{ config('app.name', 'Site') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            {{ config('app.name', 'Site') }} || 
            {{ 
                str_replace(
                    ['• Home', '• Downloads', '• Tutorials'],
                    ['Home', 'Downloads', 'Tutorials'],
                    str_replace(
                        ['Dashboard', '<small>', '</small>'],
                        [null, ' • ', null],
                        $pageTitle
                    )
                )
            }}
        </title>
        <!--[if lt IE 9]>
        <script src="{{ asset('js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('js/respond.min.js') }}"></script>
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('css/jquery.datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.datepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminlte.select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/icheck.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pace.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        
        <div class="wrapper">
            @include('backend.partials.navbar')
            @include('backend.partials.sidebar')
            <div class="content-wrapper">
                @include('backend.partials.content_header')
                @include('backend.partials.content_actual')
            </div>
            @include('backend.partials.footer')
        </div>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/icheck.min.js') }}"></script>
        <script src="{{ asset('js/fastclick.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/pace.min.js') }}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        @stack('scripts')
        <script type="text/javascript">
          $(function () {
            // Initialize iCheck elements
            $('input[type="checkbox"], input[type="radio"]').iCheck({
              checkboxClass: 'icheckbox_square-blue',
              radioClass: 'iradio_square-blue',
              increaseArea: '20%' // optional
            })
            // Initialize select2 elements
            $('.select2').select2()
          });
        </script>
    </body>
</html>