@extends('index')


@section('page')
<li class="breadcrumb-item"><a href="{{ route('Novice_Asta_Poker') }}">Games > Asta Poker</a></li>
<li class="breadcrumb-item"><a href="{{ route('Novice_Asta_Poker') }}">Monitoring Table</a></li>
<li class="breadcrumb-item"><a href="{{ route('Novice_Asta_Poker') }}">Novice</a></li>
@endsection


@section('content')
  <!-- Form Category -->
  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-puzzle-piece"></i>{{ TranslateMenuGame('Asta Poker Table') }}</strong></h2>				
      </div>
    </header>

    <div>
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                    jgn lupa diisi
            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>

        
        
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="th-sm">{{ TranslateMenuGame('Table Name') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Play Time') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Seat') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('Username Player') }}</th>
                  <th class="th-sm">{{ TranslateMenuGame('See Detail') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $table->name }}</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
    </div>
  </div>
  <!-- End Form Category -->
@endsection