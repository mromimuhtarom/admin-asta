@extends('index')

@section('page')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('List_Reseller') }}">Reseller</a></li>
        <li class="breadcrumb-item"><a href="{{ route('List_Reseller') }}">Reseller</a></li>
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
      <h2><strong>List Reseller</strong></h2>				
    </div>
  </header>

  <div>
    <div class="widget-body">
      
      <div class="custom-scroll table-responsive" style="height:800px;">
        
        <div class="table-outer">
          <table class="table table-bordered">
            <thead>
              <tr>
                @if($menu && $mainmenu)
                <th style="width:100px;"><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission">&nbsp; &nbsp;Select all</th></th>
                @endif
                <th class="th-sm">ID Reseller</th>
                <th class="th-sm">Username</th>
                <th class="th-sm">Name</th>
                <th class="th-sm">Phone</th>
                <th class="th-sm">Email</th>
                <th class="th-sm">Saldo Gold</th>
                <th class="th-sm">Rank</th>
                @if($menu && $mainmenu)
                <th class="th-sm">Reset Password</th>
                <th class="th-sm" style="width:90px;">
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
              @foreach($reseller as $rsl)
              @if($menu && $mainmenu)
              <tr>
                  <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $rsl->reseller_id }}" class="deletepermission{{ $rsl->reseller_id }} deleteIdAll"></td>
                  <td>{{ $rsl->reseller_id }}</td>
                  <td><a href="#" class="usertext" data-name="username" data-pk="{{ $rsl->reseller_id }}" data-type="text" data-url="{{ route('ListReseller-update') }}">{{ $rsl->username }}</a></td>
                  <td><a href="#" class="usertext" data-name="fullname" data-pk="{{ $rsl->reseller_id }}" data-type="text" data-url="{{ route('ListReseller-update') }}">{{ $rsl->fullname }}</a></td>
                  <td><a href="#" class="usertext" data-name="phone" data-pk="{{ $rsl->reseller_id }}" data-type="number" data-url="{{ route('ListReseller-update') }}">{{ $rsl->phone }}</a></td>
                  <td><a href="#" class="usertext" data-name="email" data-pk="{{ $rsl->reseller_id }}" data-type="email" data-url="{{ route('ListReseller-update') }}">{{ $rsl->email }}</a></td>
                  <td><a href="#" class="usertext" data-name="gold" data-pk="{{ $rsl->reseller_id }}" data-type="number" data-url="{{ route('ListReseller-update') }}">{{ $rsl->gold }}</a></td>
                  <td><a href="#" class="rank" data-name="rank_id" data-value="{{ $rsl->rank_id }}" data-pk="{{ $rsl->reseller_id }}" data-type="select" data-url="{{ route('ListReseller-update') }}">{{ $rsl->rankname }}</a></td>
                  <td><a href="#" class="password{{ $rsl->reseller_id }} btn btn-primary" id="password" data-pk="{{ $rsl->reseller_id }}" data-toggle="modal" data-target="#reset-password">Reset Password</a></td>
                  <td>
                    <a href="#" style="color:red;" class="delete{{ $rsl->reseller_id }}" 
                      id="delete" 
                      data-pk="{{ $rsl->reseller_id }}" 
                      data-toggle="modal" 
                      data-target="#delete-modal">
                        <i class="fa fa-times"></i>
                    </a>
                  </td>
              </tr>
              @else 
              <tr>
                <td>{{ $rsl->reseller_id }}</td>
                <td>{{ $rsl->username }}</td>
                <td>{{ $rsl->fullname }}</td>
                <td>{{ $rsl->phone }}</td>
                <td>{{ $rsl->email }}</td>
                <td>{{ $rsl->gold }}</td>
                <td>{{ $rsl->rankname }}</td>
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

  {{-- reset password --}}
  <div class="modal fade" id="reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            × 
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('ListResellerPassword-update') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="userid" id="userid" value="">
            <input type="password" class="form-control" name="password" placeholder="Password" value="" required/>
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes submit-data">Reset Password</button>
          <button type="button" class="button_example-no" data-dismiss="modal">No</button>
        </div>
          </form>
      </div>
    </div>
  </div>


{{-- end reset password --}}
 
  
<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete Data</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i> 
        </button>
      </div>
      <div class="modal-body">
        Are You Sure Want To Delete It
        <form action="{{ route('ListReseller-delete') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="id" id="id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data"><i class="fa fa-check"></i> Yes</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
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
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete all selected data</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        Are You Sure Want To Delete all selected data?
        <form action="{{ route('ListReseller-deleteAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="userIdAll" id="idDeleteAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success submit-data submit-data"><i class="fa fa-check"></i> Yes</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- End Modal -->


<script type="text/javascript">
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


          $('.rank').editable({
            mode:'inline',
  				  value: '',
  				  source: [
                {value:"", text: "Choose Rank" },
                @php
                foreach($rank as $rk) {
                  echo '{value:"'.$rk->id.'", text: "'.$rk->name.'" },';
                }
                @endphp
  				  ],
            validate: function(value) {
              if($.trim(value) == '') {
                return 'This field is required';
              }
            }
          });
    
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

          @php 
              foreach($reseller as $rsl) {            
              echo'$(".password'.$rsl->reseller_id.'").click(function(e) {';
                echo'e.preventDefault();';
    
                echo"var id = $(this).attr('data-pk');";
                echo'var test = $("#userid").val(id);';
              echo'});';
            }
          @endphp

      @php
        foreach($reseller as $rsl) {
          echo'$(".delete'.$rsl->reseller_id.'").hide();';
          echo'$(".deletepermission'.$rsl->reseller_id.'").on("click", function() {';
            echo 'if($( ".deletepermission'.$rsl->reseller_id.':checked" ).length > 0)';
            echo '{';
              echo '$(".delete'.$rsl->reseller_id.'").show();';
            echo'}';
            echo'else';
            echo'{';
              echo'$(".delete'.$rsl->reseller_id.'").hide();';
            echo'}';

          echo '});';
        
          echo'$(".delete'.$rsl->reseller_id.'").click(function(e) {';
            echo'e.preventDefault();';

            echo"var id = $(this).attr('data-pk');";
            echo'var test = $("#id").val(id);';
          echo'});';
        }
      @endphp

    },
    responsive: false
  });

</script>  
@endsection