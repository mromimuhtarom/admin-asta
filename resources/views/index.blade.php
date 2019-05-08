<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="/css/datatables/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="/css/datatables/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    {{-- <link href="css/style.css" rel="stylesheet"> --}}

    <!-- MDBootstrap Datatables  -->
    <link href="/css/datatables/addons/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>
<body>

    <div class="d-flex flex-column w-100 h-100">
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
                <div class="topnav-menu d-flex flex-row">
                    @include('header.header_menu')
                </div>
              
                <div class="aii-content">
                    @yield('content')
                </div>  
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="/js/datatables/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <!-- MDB core JavaScript -->
    <script type="text/javascript" src="/js/datatables/mdb.min.js"></script>

    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="/js/datatables/addons/datatables.min.js"></script>
    <script src="https://d3js.org/d3.v3.min.js"  charset="utf-8"></script>
    <script src="/js/horizontal-chart.js"></script>
    <script>
            $(document).ready(function() {
            $('table.display').DataTable();
            } );
    </script>

    <script>
        $('#dt-material-checkbox').dataTable({

        columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
        }],
        select: {
        style: 'os',
        selector: 'td:first-child'
        }
        });
    </script>
</body>
</html>