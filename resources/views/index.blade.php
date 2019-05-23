<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css"> --}}
    {{-- <link href="/css/dropzone.css" rel="stylesheet"> --}}

    <!-- Bootstrap core CSS -->
    <link href="/css/datatables/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/css/datatables/mdb.min.css" rel="stylesheet">

    <!-- MDBootstrap Datatables  -->
    <link href="/css/datatables/addons/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <!-- bootstrap -->
    {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/x-editable.css">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  
    {{-- <script src="/js/dropzone.js"></script> --}}

    <!-- x-editable (bootstrap version) -->
    <script type="text/javascript" src="/js/datatables/addons/datatables.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>

    {{-- js dropzone --}}
    {{-- <script src="/js/dropzone.js"></script> --}}
    <script>
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <title>Document</title>
</head>
<body>

    <div class="d-flex flex-column w-100 border" style="height:99.9%;">
        <div class="topnav-admin d-flex flex-row">
            <div class="row w-100">
                @include('header.header_profile')
            </div>
        </div>
        <div class="d-flex flex-row w-100 h-100">
            <div class="sidebar">
                @yield('sidebarmenu')
            </div>
            <div class="d-flex flex-column content-aii">
                <div class="topnav-menu d-flex flex-row" style="width:97%;">
                    @include('header.header_menu')
                </div>

                @if(Request::is('Game-Asta-Poker/*'))
                    <div class="menugame border-bottom border-dark" style="display: table; width:100%;">
                        @include('menu.nama_game')
                    </div>
                    <div class="aii-content-game">
                        @yield('content')
                    </div>  
                @else 
                    <div class="aii-content">
                        @yield('content')
                    </div>  
                @endif

            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    {{-- <script src="/js/datatables/jquery-3.4.0.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    {{-- TE<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
     <!-- MDB core JavaScript -->
    {{-- TE<script type="text/javascript" src="/js/datatables/mdb.min.js"></script> --}}

    <!-- MDBootstrap Datatables  -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script> --}}
    <script src="https://d3js.org/d3.v3.min.js"  charset="utf-8"></script>
    <script src="/js/horizontal-chart.js"></script>
    <script src="/js/classeditable.js"></script>
    
</body>
</html>