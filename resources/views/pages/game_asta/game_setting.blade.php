@extends('index')

@section('page')
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Game_Setting') }}">{{ Translate_menu('L_SETTINGS')}}</a></li>
  <li class="breadcrumb-item menunameheader"><a href="{{ route('Game_Setting') }}">{{ Translate_menu('L_GAME_SETTING')}}</a></li>
@endsection


@section('content')

<div class="game-settings">
  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Asta Poker</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm">{{ Translate_menu('L_SETTINGS')}}</th>
                    <th class="th-sm">{{ TranslateMenuGame('L_NAME')}}</th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($tpk as $tpk)
                    <tr>
                        <td>{{ $tpk->name }}</td>
                        @if($menu && $mainmenu )
                        <td><a href="#" class="inlineSetting" data-type="number" data-name="value" data-pk="{{ $tpk->id }}" data-url="{{ route('GameSetting-updateTpk') }}">{{ $tpk->value }}</a></td>
                        @else 
                        <td>{{ $tpk->value }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Asta Big Two</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm">{{ TranslateMenuGame('L_NAME')}}</th>
                    <th class="th-sm">{{ Translate_Menu('L_SETTINGS')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($bgt as $bgt)
                    <tr>
                        <td>{{ $bgt->name }}</td>
                        @if ($menu && $mainmenu)
                        <td><a href="" class="inlineSetting" data-name="value" data-pk="{{ $bgt->id }}" data-type="number" data-url="{{ route('GameSetting-updateBgt') }}">{{ $bgt->value }}</a></td>
                        @else
                        <td>{{ $bgt->value }}</td>
                        @endif
                        
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Domino Susun</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm">{{ TranslateMenuGame('L_NAME')}}</th>
                    <th class="th-sm">{{ Translate_Menu('L_SETTINGS')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($dms as $dms)
                    <tr>
                        <td>{{ $dms->name }}</td>
                        @if ($menu && $mainmenu)
                        <td><a href="" class="inlineSetting" data-pk="{{ $dms->id }}" data-name="value" data-type="number" data-url="{{ route('GameSetting-updateDms') }}">{{ $dms->value }}</a></td>
                        @else 
                        <td>{{ $dms->value }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
      
      <header>
        <div class="widget-header">	
          <h2><strong>Domino QQ</strong></h2>				
        </div>
      </header>
    
      <div>
        <div class="widget-body">
          <div class="custom-scroll table-responsive" style="height:350px;">
            
            <div class="table-outer">
              <table class="table table-bordered">
                <thead class="th-table">
                  <tr>
                    <th class="th-sm">{{ TranslateMenuGame('L_NAME')}}</th>
                    <th class="th-sm">{{ Translate_Menu('L_SETTINGS')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($dmq as $dmq)
                    <tr>
                        <td>{{ $dmq->name }}</td>
                        @if ($menu && $mainmenu)
                        <td><a href=""class="inlineSetting" data-pk="{{ $dmq->id }}" data-name="value" data-type="number" data-url="{{ route('GameSetting-updateDmq') }}">{{ $dmq->value}}</a></td>
                        @else 
                        <td>{{ $dmq->value}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        
          </div>
        
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  $(document).ready(function() {
    $('table.table').dataTable( {
      "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
    });
  });

  table = $('table.table').dataTable({
    "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
    "autoWidth" : true,
    "paging": false,
    "classes": {
      "sWrapper": "dataTables_wrapper dt-bootstrap4"
    },
    "oLanguage": {
      "sSearch": '<span class="input-group-addon"><i class="fa fa-search"></i></span>'
    },
    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('.inlineSetting').editable({
            mode :'inline',
            step: 'any',
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            }
        });
     
    },
    responsive: false
  });
</script>
@endsection