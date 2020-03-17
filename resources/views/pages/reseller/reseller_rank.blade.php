@extends('index')

@section('page')
  <li class="breadcrumb-item"><a href="{{ route('Reseller_Rank') }}">{{ translate_menu('L_RESELLER')}}</a></li>
  <li class="breadcrumb-item"><a href="{{ route('Reseller_Rank') }}">{{ translate_menu('L_RESELLER_RANK')}}</a></li>
@endsection

@section('content')
@if (count($errors) > 0)
<div class="error-val">
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>  
      @endforeach
    </ul>
  </div>  
</div>
@endif

@if (\Session::has('success'))
<div class="alert alert-success">
  <p>{{\Session::get('success')}}</p>
</div>
@endif

<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
<header>
  <div class="widget-header">	
    <h2><strong>{{ translate_menu('L_RESELLER_RANK')}}</strong></h2>				
  </div>
</header>

<div>
  <div class="widget-body">
    <div class="widget-body-toolbar">
      
      <div class="row">
        
        <!-- Button tambah bot baru -->
        <div class="col-9 col-sm-5 col-md-5 col-lg-5">
          <div class="input-group">
            @if($menu && $mainmenu)
            <button class="btn sa-btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus"></i>{{ TranslateReseller('Create new reseller')}}
            </button>
            @endif
          </div>
        </div>
        <!-- End Button tambah bot baru -->

      </div>

    </div>
    
    <div class="custom-scroll table-responsive" style="height:800px;">
      
      <div class="table-outer">
        <table class="table table-bordered">
          <thead>
            <tr>
              @if($menu && $mainmenu)
              <th style="width:100px"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;{{ TranslateReseller('Select All')}}</th>
              @endif
              <th class="th-sm">ID</th>
              <th class="th-sm">{{ TranslateMenuGame('Name')}}</th>
              <th class="th-sm">{{ TranslateReseller('Gold Group')}}</th>
              <th class="th-sm">{{ translate_menuTransaction('Type')}}</th>
              <th class="th-sm">Bonus</th>
              @if($menu && $mainmenu)
              <th class="th-sm">
                <a  href="#" style="color:red;font-weight:bold;" 
                        class="delete" 
                        id="trash" 
                        data-toggle="modal" 
                        data-target="#deleteAll"><i class="fa  fa-trash-o"></i>
                </a>
              </th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($rank as $rk)
            @if($menu && $mainmenu)
            <tr>
                <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $rk->id }}" class="deletepermission{{ $rk->id }} deleteIdAll"></td>
                <td>{{ $rk->id }}</td>
                <td><a href="#" class="usertext" data-name="name" data-pk="{{ $rk->id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ $rk->name }}</a></td>
                <td><a href="#" class="usertext" data-name="gold" data-pk="{{ $rk->id }}" data-type="number" data-url="{{ route('ResellerRank-update') }}">{{ number_format($rk->gold, 2) }}</a></td>
                <td><a href="#" class="typeday" data-name="type" data-pk="{{ $rk->id }}" data-type="select" data-url="{{ route('ResellerRank-update') }}">{{ TranslateReseller(strTransactionType($rk->type)) }}</a></td>
                <td><a href="#" class="usertext" data-name="bonus" data-pk="{{ $rk->id }}" data-type="text" data-url="{{ route('ResellerRank-update') }}">{{ number_format($rk->bonus, 2) }}</a></td>
                <td>
                    <a href="#" style="color:red;" class="delete{{ $rk->id }}" 
                        id="delete" 
                        data-pk="{{ $rk->id }}" 
                        data-toggle="modal" 
                        data-target="#delete-modal">
                          <i class="fa fa-times"></i>
                    </a>
                </td>
            </tr>
            @else 
            <tr>
              <td>{{ $rk->id}}</td>
              <td>{{ $rk->name }}</td>
              <td>{{ number_format($rk->gold, 2) }}</td>
              <td>{{ TranslateReseller(strTransactionType($rk->type)) }}</td>
              <td>{{ number_format($rk->bonus, 2) }}</td>
            </tr>
            @endif
            @endforeach

          </tbody>
        </table>
      </div>
    
    </div>
  
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateReseller('Create Reseller Rank')}}</h4>
      <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="fa fa-remove"></i>
      </button>
    </div>
    <form action="{{ route('ResellerRank-create') }}" method="post">
      @csrf
      <div class="modal-body">

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <input type="text" class="form-control" name="id" placeholder="ID" required >
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="rankname" placeholder="Rank Name" required onkeyup="manage(this)">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="submit" class="btn sa-btn-primary submit-data btn-create toggle-disabled" disabled onclick="FunctionLoadBtn()">
          <i class="fa fa-save"></i> {{ TranslateMenuItem('Save')}}
        </button>
        <button type="submit" class="btn btn-danger" data-dismiss="modal">
          <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel')}}
        </button>
      </div>
    </form>
  </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('DeleteData')}}</h5>
      <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">
        <i class="fa fa-remove"></i>
      </button>
    </div>
    <div class="modal-body">
      {{ TranslateMenuItem('Are U Sure')}}
      <form action="{{ route('ResellerRank-delete') }}" method="post">
        {{ method_field('delete')}}
        {{ csrf_field() }}
        <input type="hidden" name="id" id="id" value="">
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
    </div>
      </form>
  </div>
</div>
</div>

<!-- Modal DELETE ALL SELECTED -->
<div class="modal fade" id="deleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('Delete all selected data')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are you sure want to delete it')}}
        <form action="{{ route('ResellerRank-deleteAllSelectedRank') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="text" name="userIdAll" id="idDeleteAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal -->


<script type="text/javascript">
  //Loading button after submit
  function FunctionLoadBtn(){
    $(".btn-create").text("Loading...");
    $(this).submit('loading').delay(1000).queue(function () {
    })
  }

  //Disable submit before form fullfilled
  function manage(txt) {
    var bt = document.getElementById('submit');
    if (txt.value != '') {
      bt.disabled = false;
    } else {
      bt.disabled = true;
    }
  }

  $(document).ready(function() {
  $('table.table').dataTable( {
    "lengthMenu": [[20, 25, 50, -1], [20, 25, 50, "All"]],
    "pagingType": "full_numbers",
  });

  //CHECKBOX ALL
  $('#trash').hide();
    $('#checkAll').on('click', function(e) {
      if($(this).is(':checked', true))
      {
        $(".deleteIdAll").prop('checked', true);
        $("#trash").show();
      }else{
        $(".deleteIdAll").prop('checked', false);
        $("#trash").hide();
      }
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

    $('.usertext').editable({
      mode :'inline',
      validate: function(value) {
        if($.trim(value) == '') {
          return 'This field is required';
        }
      }
    });

    $('.typeday').editable({
      mode: 'inline',
      validate: function(value) {
        if($.trim(value) == '') {
          return 'This field is required';
        }
      },
      source: [
        {value: '', text: "{{ TranslatePlaceholdertxt('L_CHOOSE_TYPE') }}"},
        @php
          echo'{value: "'.$explodetype[0].'", text:"'.TranslateReseller($explodetype[1]).'"},';
          echo'{value: "'.$explodetype[2].'", text:"'.TranslateReseller($explodetype[3]).'"}';
        @endphp
      ]
    })

    @php
        foreach($rank as $rk) {
          echo'$(".delete'.$rk->id.'").hide();';
          echo'$(".deletepermission'.$rk->id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$rk->id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$rk->id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$rk->id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$rk->id.'").click(function(e) {';
            echo'e.preventDefault();';

            echo"var id = $(this).attr('data-pk');";
            echo'var test = $("#id").val(id);';
          echo'});';
        }
      @endphp

    //js delete on delete all selected modal
    $('.delete').click(function(e) {
      e.preventDefault();
      var allVals = [];
      $('.deleteIdAll:checked').each(function() {
        allVals.push($(this).attr('data-pk'));
        var join_selected_values = allVals.join(",");
        $('#idDeleteAll').val(join_selected_values);
      });
    });

    //hide and show icon delete all
    $('#trash').hide();
    $(".deleteIdAll").click(function(e) {
      if($(".deleteIdAll:checked").length > 1) {
          $("#trash").show();
      }else{
          $("#trash").hide();
        }
    });
  },
  responsive: false
});

</script>
@endsection