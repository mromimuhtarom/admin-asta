@extends('index')

@section('pages')
<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
<li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">Settings</a></li> 
    <li class="breadcrumb-item"><a href="{{ route('General_Setting') }}">General Setting</a></li>
@endsection


@section('content')
<div class="settings-table">
    <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                    <h2><strong>Android</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                    <div class="custom-scroll table-responsive" style="height:350px;">
                        
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Type</th>
                                    <th>Link</th>
                                    <th>Version</th>
                                </thead>
                                <tbody>
                                @foreach ($xml_andro->children() as $xl)
                                    <tr>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->ver }}</a></td>
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
                    <h2><strong>IOS</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                    <div class="custom-scroll table-responsive" style="height:350px">
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Type</td>
                                        <td>Link</td>
                                        <td>Version</td>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($xml_ios->children() as $xl_ios)
                                    <tr>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->ver }}</a></td>
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