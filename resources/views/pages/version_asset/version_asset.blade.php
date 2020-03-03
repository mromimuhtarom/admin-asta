@extends('index')

@section('pages')
  <li class="breadcrumb-item"><a href="{{ route('Version_Asset_Apk') }}">{{ translate_menu('L_VERSION_ASSET_APK')}}</a></li> 
@endsection

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

@section('content')
<link rel="stylesheet" href="/css/admin.css">

@if (\Session::has('alert'))
      <div class="alert alert-danger">
        <div>{{Session::get('alert')}}</div>
      </div>

@endif

@if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{{\Session::get('success')}}</p>
  </div>
@endif
<div class="settings-table">
    <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" style="width:800px;" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                    <h2><strong>Android</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                        <div class="widget-body-toolbar">

                                <div class="row">
                        
                                  <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                      @if($menu)
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalAssetAdr">
                                        <i class="fa fa-plus"></i> {{ TranslateReseller('Create new asset')}}
                                      </button>
                                      @endif
                                    </div>
                                  </div>
                                  <!-- End Button tambah bot baru -->
                        
                                </div>
                        
                              </div>
                    <div class="custom-scroll table-responsive" style="height:420px;">
                        
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    @if($menu)
                                    <th><input id="checkAll" type="checkbox" name="deletepermission" class="deletepermission"></th>
                                    <th>File</th>
                                    @endif
                                    <th>{{ TranslateMenuGame('Name')}}</th>
                                    <th>{{ translate_menuTransaction('Type')}}</th>
                                    <th>Operating System</th>
                                    <th>{{ TranslateReseller('Link')}}</th>
                                    <th>{{ TranslateReseller('Version')}}</th>
                                    @if($menu)
                                      <th style="width:10px;">
                                        <a  href="#" style="color:red;font-weight:bold;" 
                                            class="delete" 
                                            id="trash" 
                                            data-toggle="modal" 
                                            data-target="#deleteAll"><i class="fa fa-trash-o"></i>
                                        </a>
                                      </th>
                                    @endif
                                </thead>
                                <tbody>
                                @foreach ($xml_andro->children() as $key => $xl)
                                    @if ($menu)
                                    @php 
                                    $ckbox = str_replace('.','_', $xl['name']);
                                    @endphp
                                    <tr>
                                        <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $xl['name'] }}" data-link="{{ $xl->link }}" data-name="{{ $key }}" class="deletepermission{{ $ckbox.'1' }} deleteIdAll"></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#ModalAssetAndro{{ $ckbox }}" style="width: 100%"><i class="fa fa-edit"></i>{{ TranslateReseller('Edit Asset')}}</button></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="name" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl['name'] }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="os" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->os }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApk-update')}}">{{ $xl->ver }}</a></td>
                                        <td>
                                          
                                          <a href="#" style="color:red;" class="delete{{ $ckbox.'1' }}" 
                                              id="delete"
                                              data-pk="{{ $xl['name'] }}"
                                              data-name="{{ $key }}"
                                              data-link1="{{ $xl->link }}"
                                              data-toggle="modal"
                                              data-target="#delete-modal">
                                                <i class="fa fa-times"></i>
                                          </a>
                                      </td>
                                    </tr>
                                    @else 
                                    <tr>
                                        <td>{{ $xl['name'] }}</td>
                                        <td>{{ $xl->type }}</td>
                                        <td>{{ $xl->link }}</td>
                                        <td>{{ $xl->ver }}</td>
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
    </div>

    <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" style="width:800px;" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                    <h2><strong>IOS</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                        <div class="widget-body-toolbar">

                                <div class="row">
                        
                                  <!-- Button tambah asset baru -->
                                  <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                      @if($menu)
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalAssetIos">
                                        <i class="fa fa-plus"></i> {{ TranslateReseller('Create new asset')}}
                                      </button>
                                      @endif
                                    </div>
                                  </div>
                                  <!-- End Button tambah asset baru -->
                        
                                </div>
                        
                              </div>
                    <div class="custom-scroll table-responsive" style="height:420px">
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        @if($menu)
                                        <td><input id="checkAll2" type="checkbox" name="deletepermission" class="deletepermission"></td>
                                        <td>File</td>
                                        @endif
                                        <td>{{ TranslateMenuGame('Name')}}</td>
                                        <td>{{ translate_menuTransaction('Type')}}</td>
                                        <td>{{ TranslateReseller('Link')}}</td>
                                        <td>{{ TranslateReseller('Version')}}</td>
                                        @if($menu)
                                          <td align="center" style="width:10px;">
                                            <a  href="#" style="color:red;font-weight:bold;" 
                                                class="delete2" 
                                                id="trash2" 
                                                data-toggle="modal" 
                                                data-target="#deleteAll2"><i class="fa fa-trash-o"></i>
                                            </a>
                                          </td>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($xml_ios->children() as $key => $xl_ios)
                                    @php 
                                    $ckbox = str_replace('.','_', $xl_ios['name']);
                                    @endphp
                                    @if ($menu)
                                    <tr>
                                        <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $xl_ios['name'] }}" data-link="{{ $xl_ios->link }}" data-name="{{ $key }}" class="deletepermission{{ $ckbox.'2'}} deleteIdAll2"></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#ModalAssetIos{{ $ckbox }}"><i class="fa fa-edit"></i>{{ TranslateReseller('Edit Asset')}}</button></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="name" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios['name'] }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl_ios['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkIos-update')}}">{{ $xl_ios->ver }}</a></td>
                                        <td>
                                          <a href="#" style="color:red;" class="delete{{ $ckbox.'2' }}" 
                                              id="delete"
                                              data-pk="{{ $xl_ios['name']}}"
                                              data-name="{{ $key }}"
                                              data-link="{{ $xl_ios->link }}"
                                              data-toggle="modal"
                                              data-target="#deleteIOS">
                                                <i class="fa fa-times"></i>
                                          </a>
                                      </td>
                                      </tr>
                                    @else 
                                    <tr>
                                        <td>{{ $xl_ios['name'] }}</td>
                                        <td>{{ $xl_ios->type }}</td>
                                        <td>{{ $xl_ios->link }}</td>
                                        <td>{{ $xl_ios->ver }}</td>
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
    </div>
</div>
<div class="settings-table" style="margin-top:10px;">
    <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" style="width:800px;" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                    <h2><strong>Windows</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                        <div class="widget-body-toolbar">

                                <div class="row">
                        
                                  <!-- Button tambah bot baru -->
                                  <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                      @if($menu)
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalAssetWindows">
                                        <i class="fa fa-plus"></i> {{ TranslateReseller('Create new asset')}}
                                      </button>
                                      @endif
                                    </div>
                                  </div>
                                  <!-- End Button tambah bot baru -->
                        
                                </div>
                        
                              </div>
                    <div class="custom-scroll table-responsive" style="height:420px;">
                        
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    @if($menu)
                                    <th><input id="checkAll3" type="checkbox" name="deletepermission" class="deletepermission"></th>
                                    <th>File</th>
                                    @endif
                                    <th>{{ TranslateMenuGame('Name')}}</th>
                                    <th>{{ translate_menuTransaction('Type')}}</th>
                                    <th>{{ TranslateReseller('Link')}}</th>
                                    <th>{{ TranslateReseller('Version')}}</th>
                                    @if($menu)
                                      <th style="width:10px;">
                                        <a  href="#" style="color:red;font-weight:bold;" 
                                            class="delete3" 
                                            id="trash3" 
                                            data-toggle="modal" 
                                            data-target="#deleteAll3"><i class="fa fa-trash-o"></i>
                                        </a>
                                      </th>
                                    @endif
                                </thead>
                                <tbody>
                                @foreach ($xml_windows->children() as $key => $xl)
                                    @php 
                                    $ckbox = str_replace('.','_', $xl['name']);
                                    @endphp
                                    @if ($menu)
                                    <tr>
                                        <td align="center"><input type="checkbox" name="deletepermission[]" data-pk="{{ $xl['name'] }}" data-link="{{ $xl->link }}" data-name="{{ $key }}" class="deletepermission{{ $ckbox }}3 deleteIdAll3"></td>
                                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#ModalAssetWindows{{ $ckbox }}" style="width: 100%"><i class="fa fa-edit"></i>{{ TranslateReseller('Edit Asset')}}</button></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="name" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkWindows-update')}}">{{ $xl['name'] }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="type_ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkWindows-update')}}">{{ $xl->type }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="link" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkWindows-update')}}">{{ $xl->link }}</a></td>
                                        <td><a href="#" class="inlineSetting" data-title="Twitter" data-name="ver" data-pk="{{ $xl['name'] }}" data-type="text" data-url="{{ route('VersionAssetApkWindows-update')}}">{{ $xl->ver }}</a></td>
                                        <td>
                                          <a href="#" style="color:red;" class="delete{{ $ckbox }}3" 
                                              id="delete"
                                              data-pk3="{{ $xl['name'] }}"
                                              data-name3="{{ $key }}"
                                              data-link3="{{ $xl->link }}"
                                              data-toggle="modal"
                                              data-target="#deletewindows">
                                                <i class="fa fa-times"></i>
                                          </a>
                                      </td>
                                    </tr>
                                    @else 
                                    <tr>
                                        <td>{{ $xl['name'] }}</td>
                                        <td>{{ $xl->type }}</td>
                                        <td>{{ $xl->link }}</td>
                                        <td>{{ $xl->ver }}</td>
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
    </div>

        <div>
        <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <div class="widget-header">
                  <h2><strong>{{ TranslateMenuGame('Language')}}</strong></h2>
                </div>
            </header>

            <div>
                <div class="widget-body">
                        <div class="widget-body-toolbar">

                                <div class="row">
                        
                                  <!-- Button tambah bot baru -->
                                  <div class="col-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                      {{-- @if($menu)
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalAssetWindows">
                                        <i class="fa fa-plus"></i> {{ TranslateReseller('Create new asset')}}
                                      </button>
                                      @endif --}}
                                    </div>
                                  </div>
                                  <!-- End Button tambah bot baru -->
                        
                                </div>
                        
                              </div>
                    <div class="custom-scroll table-responsive" style="height:420px;">
                        
                        <div class="table-outer">
                            <table class="table table-bordered">
                                <thead>
                                    <th>{{ TranslateMenuGame("Language") }}</th>
                                    <th>{{ TranslateMenuGame("Upload File") }}</th>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>{{ TranslateMenuGame('Indonesia') }}</td>
                                    <td>
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalLanguageIndo">
                                        <i class="fa fa-plus"></i> {{ TranslateMenuGame('Upload File Language')}}
                                      </button>
                                    </td>
                                  </tr> 
                                  <tr>
                                    <td>{{ TranslateMenuGame('English') }}</td>
                                    <td>
                                      <button class="btn sa-btn-primary" data-toggle="modal" data-target="#ModalLanguageEnglish">
                                        <i class="fa fa-plus"></i> {{ TranslateMenuGame('Upload File Language')}}
                                      </button>
                                    </td>
                                  </tr>                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================================================================== Modal Upload FIle Language  ======================================================================= -->
<!-- Modal Upload File Indonesia -->
<div class="modal fade" id="ModalLanguageIndo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuGame('Upload File Language')}}</h4>
              <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-remove"></i>
              </button>
            </div>
            <form action="{{ route('VersionAssetApkLangId-update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group"><br>
                        <div class="form-group">
                            <input type="file" name="fileLanguageId" id="file9" class="input-file">
                            <label for="file9" class="btn btn-tertiary js-labelFile">
                              <i class="icon fa fa-check"></i>
                              <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                            </label>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn sa-btn-primary submit-data" >
                  <i class="fa fa-save"></i>{{ TranslateMenuItem('Save')}}
                </button>
                <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                  <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel')}}
              </div>
            </form>
          </div>
        </div>
      </div>


      <!-- Modal Upload File English -->
      <div class="modal fade" id="ModalLanguageEnglish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateMenuGame('Upload File Language')}}</h4>
              <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-remove"></i>
              </button>
            </div>
            <form action="{{ route('VersionAssetApkLangEn-update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group"><br>
                      <div class="form-group">
                        <input type="file" name="fileLanguageEn" id="file6" class="input-file">
                        <label for="file6" class="btn btn-tertiary js-labelFile">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn sa-btn-primary submit-data" >
                  <i class="fa fa-save"></i>{{ TranslateMenuItem('Save')}}
                </button>
                <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                  <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel')}}
              </div>
            </form>
          </div>
        </div>
      </div>



<!-- ==================================================================== MODAL CREATE ASSET ======================================================================== -->
<!-- Modal create new asset android -->
<div class="modal fade" id="ModalAssetAdr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateReseller('Create new asset')}}</h4>
              <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-remove"></i>
              </button>
            </div>
            <form action="{{ route('VersionAssetApkAndroid-create') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group"><br>
                        <div class="form-group">
                            <input type="file" name="fileAdr" id="file" onchange="document.getElementById('namefileadr').value = this.value.split('\\').pop().split('/').pop()" class="input-file">
                            <label for="file" class="btn btn-tertiary js-labelFile">
                              <i class="icon fa fa-check"></i>
                              <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                            </label>
                          </div>
                        <br>
                        <br>
                        <input class="form-control" name="Name" id="namefileadr" placeholder="Name"><br>
                          <select name="Type" class="form-control">
                            <option>{{ translate_menuTransaction('Type')}}</option>
                            <option value="Audio">{{ TranslateVersionAsetApk('L_AUDIO')}}</option>
                            <option value="Image">{{ TranslateVersionAsetApk('L_IMAGE')}}</option>
                            <option value="Scene">{{ TranslateVersionAsetApk('L_SCENE')}}</option>
                          </select>
                        <br>
                          <select name="os" class="form-control">
                            <option>Operating System</option>
                            <option value="Android">Android</option>
                            <option value="Ios">Ios</option>
                            <option value="Windows">Windows</option>
                          </select>
                        <br>
                          <input class="form-control" name="Link" placeholder="Link"><br>
                          <input class="form-control" name="Version" placeholder="Version"><br>
                          <input class="form-control" name="FolderName" placeholder="Folder name"><br>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn sa-btn-primary submit-data" >
                  <i class="fa fa-save"></i>{{ TranslateMenuItem('Save')}}
                </button>
                <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
                  <i class="fa fa-remove"></i>{{ TranslateMenuItem('Cancel')}}
              </div>
            </form>
          </div>
        </div>
      </div>


<!-- Modal create new asset IOS -->
<div class="modal fade" id="ModalAssetIos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateReseller('Create new asset')}}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkIos-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                  <div class="form-group">
                      <input type="file" name="fileIOS" id="file2" onchange="document.getElementById('namefileios').value = this.value.split('\\').pop().split('/').pop()" class="input-file">
                      <label for="file2" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-check"></i>
                        <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                      </label>
                    </div>
                  <br>
                  <br>
                  <input class="form-control" name="Name" id="namefileios" placeholder="Name"><br>
                    <select name="Type" class="form-control">
                      <option>Type</option>
                      <option value="Audio">{{ TranslateVersionAsetApk('L_AUDIO')}}</option>
                      <option value="Image">{{ TranslateVersionAsetApk('L_IMAGE')}}</option>
                      <option value="Scene">{{ TranslateVersionAsetApk('L_SCENE')}}</option>
                    </select>
                  <br>
                    <input class="form-control" name="Link" placeholder="Link"><br>
                    <input class="form-control" name="Version" placeholder="Version"><br>
                    <input class="form-control" name="FolderName" placeholder="Folder name"><br>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data" >
            <i class="fa fa-save"></i> {{ TranslateMenuItem('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuItem('Cancel')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal create new asset Windows -->
<div class="modal fade" id="ModalAssetWindows" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i>{{ TranslateReseller('Create new asset')}}</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkwindows-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                  <div class="form-group">
                      <input type="file" name="fileWindows" onchange="document.getElementById('namefilewindows').value = this.value.split('\\').pop().split('/').pop()" id="file10" class="input-file">
                      <label for="file10" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-check"></i>
                        <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                      </label>
                    </div>
                  <br>
                  <br>
                  <input class="form-control" name="Name" id="namefilewindows" placeholder="Name"><br>
                    <select name="Type" class="form-control">
                      <option>{{ translate_menuTransaction('Type')}}</option>
                      <option value="Audio">{{ TranslateVersionAsetApk('L_AUDIO')}}</option>
                      <option value="Image">{{ TranslateVersionAsetApk('L_IMAGE')}}</option>
                      <option value="Scene">{{ TranslateVersionAsetApk('L_SCENE')}}</option>
                    </select>
                  <br>
                    <input class="form-control" name="Link" placeholder="Link"><br>
                    <input class="form-control" name="Version" placeholder="Version"><br>
                    <input class="form-control" name="FolderName" placeholder="Folder name"><br>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data" >
            <i class="fa fa-save"></i> {{ TranslateMenuItem('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuItem('Cancel')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- ==================================================================== MODAL EDIT ASSET ======================================================================== -->
<!-- Modal edit asset android -->
@foreach ($xml_andro->children() as $xl)
@php 
$ckbox = str_replace('.','_', $xl['name']);
@endphp
<div class="modal fade" id="ModalAssetAndro{{ $ckbox  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> {{ TranslateReseller('Edit Asset')}} andorid</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkAndroid-updateAsset') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                  <input type="hidden" value="{{ $xl['name'] }}" name="pk">
                  <div class="form-group">
                      <input type="file" name="fileEditADR" onchange="document.getElementById('nameandro{{ $xl['name'] }}').value = this.value.split('\\').pop().split('/').pop()" id="file3{{ $xl['name'] }}" class="input-file">
                      <label for="file3{{ $xl['name'] }}" class="btn btn-tertiary js-labelFile">
                        <i class="icon fa fa-check"></i>
                        <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                      </label>
                    </div>
                  <br>
                  <br>
                  <input value="{{ $xl['name'] }}" class="form-control" id="nameandro{{ $xl['name'] }}" name="Name" placeholder="Name"><br>
                    <select disabled name="Type" class="form-control">
                      <option>Type</option>
                      <option @if( $xl->type == 'Audio' ) selected @endif value="Audio">{{ TranslateVersionAsetApk('L_AUDIO') }} </option>
                      <option @if( $xl->type == 'Image' ) selected @endif value="Image">{{ TranslateVersionAsetApk('L_IMAGE') }}</option>
                      <option @if( $xl->type == 'Scene' ) selected @endif value="Scene">{{ TranslateVersionAsetApk('L_SCENE') }}</option>
                    </select>
                  <br>
                    <select disabled name="os" class="form-control">
                      <option>Operating System</option>
                      <option @if( $xl->os == 'Android' ) selected @endif value="Android">Android</option>
                      <option @if( $xl->os == 'Ios' ) selected @endif value="Ios">Ios</option>
                      <option @if( $xl->os == 'Windows' ) selected @endif  value="Windows">Windows</option>
                    </select>
                  <br>
                  <input readonly value="{{ $xl->link }}" class="form-control" name="Link" placeholder="Link"><br>
                  <input value="{{ $xl->ver }}" class="form-control" name="Version" placeholder="Version"><br>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data" >
            <i class="fa fa-save"></i> {{ TranslateMenuItem('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuItem('Cancel')}}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach


<!-- Modal edit asset IOS -->
@foreach ($xml_ios->children() as $xl_ios)
@php 
$ckbox = str_replace('.','_', $xl_ios['name']);
@endphp
<div class="modal fade" id="ModalAssetIos{{ $ckbox  }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> {{ TranslateReseller('Edit Asset')}} IOS</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkIOS-updateAsset') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                <input type="hidden" value="{{ $xl_ios['name'] }}" name="pk">
                <div class="form-group">
                    <input type="file" name="fileEditIOS" id="file4{{ $xl_ios['name'] }}" onchange="document.getElementById('nameios{{ $xl_ios['name'] }}').value = this.value.split('\\').pop().split('/').pop()" id="file3{{ $xl['name'] }}" id="file4{{ $xl_ios['name'] }}" class="input-file">
                    <label for="file4{{ $xl_ios['name'] }}" class="btn btn-tertiary js-labelFile">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                    </label>
                  </div>
                  <br>
                  <br>
                  <input value="{{ $xl_ios['name'] }}" class="form-control" name="Name" id="nameios{{ $xl_ios['name'] }}" placeholder="Name"><br>
                    <select disabled name="Type" class="form-control">
                      <option>Type</option>
                      <option @if( $xl_ios->type == 'Audio' ) selected @endif value="Audio">{{ TranslateVersionAsetApk('L_AUDIO') }} </option>
                      <option @if( $xl_ios->type == 'Image' ) selected @endif value="Image">{{ TranslateVersionAsetApk('L_IMAGE') }}</option>
                      <option @if( $xl_ios->type == 'Scene' ) selected @endif value="Scene">{{ TranslateVersionAsetApk('L_SCENE') }}</option>
                    </select>
                  <br>
                  <input readonly value="{{ $xl_ios->link }}" class="form-control" name="Link" placeholder="Link"><br>
                  <input value="{{ $xl_ios->ver }}" class="form-control" name="Version" placeholder="Version"><br>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data" >
            <i class="fa fa-save"></i> {{ TranslateMenuItem('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuItem('Cancel')}}
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach



<!-- Modal edit asset Windows -->
@foreach ($xml_windows->children() as $xl_ios)
<div class="modal fade" id="ModalAssetWindows{{ $xl_ios['name'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square"></i> {{ TranslateReseller('Edit Asset')}} IOS</h4>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <form action="{{ route('VersionAssetApkWindows-updateAsset') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="row">
            <div class="col-12">
              <div class="form-group" align="center"><br>
                <input type="hidden" value="{{ $xl_ios['name'] }}" name="pk">
                <div class="form-group">
                    <input type="file" name="fileEditIOS" id="file7{{ $xl_ios['name'] }}" onchange="document.getElementById('namewindows{{ $xl_ios['name'] }}').value = this.value.split('\\').pop().split('/').pop()" id="file3{{ $xl['name'] }}" id="file4{{ $xl_ios['name'] }}" class="input-file">
                    <label for="file7{{ $xl_ios['name'] }}" class="btn btn-tertiary js-labelFile">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{ TranslateReseller('Choose a file')}}</span>
                    </label>
                  </div>
                  <br>
                  <br>
                  <input value="{{ $xl_ios['name'] }}" class="form-control" id="namewindows{{ $xl_ios['name'] }}" name="Name" placeholder="Name"><br>
                    <select disabled name="Type" class="form-control">
                      <option>Type</option>
                      <option @if( $xl_ios->type == 'Audio' ) selected @endif value="Audio">{{ TranslateVersionAsetApk('L_AUDIO') }} </option>
                      <option @if( $xl_ios->type == 'Image' ) selected @endif value="Image">{{ TranslateVersionAsetApk('L_IMAGE') }}</option>
                      <option @if( $xl_ios->type == 'Scene' ) selected @endif value="Image">{{ TranslateVersionAsetApk('L_SCENE') }}</option>
                    </select>
                  <br>
                  <input readonly value="{{ $xl_ios->link }}" class="form-control" name="Link" placeholder="Link"><br>
                  <input value="{{ $xl_ios->ver }}" class="form-control" name="Version" placeholder="Version"><br>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn sa-btn-primary submit-data" >
            <i class="fa fa-save"></i> {{ TranslateMenuItem('Save')}}
          </button>
          <button type="submit" class="btn sa-btn-danger" data-dismiss="modal">
            <i class="fa fa-remove"></i> {{ TranslateMenuItem('Cancel')}}
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach


{{-- ============================================ POP UP CONFIRMATION DELETE ASSET ANDROID ===================================================  --}}
 
<!-- Modal Pop up delete confirm Android -->
 <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('DeleteData')}}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuItem('Are you sure want to delete it')}}
          <form action="{{ route('VersionAssetApkAndroid-deleteAsset') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="name" id="id" value="">
            <input type="hidden" name="id" id="name" value="">
            <input type="hidden" name="Link" id="Link" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- Modal Pop up delete all selected data Android -->
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
        {{ TranslateMenuItem('Are U Sure')}}
        <form action="{{ route('VersionAssetApkAndroid-deleteAssetAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="names" id="ids" value="">
          <input type="hidden" name="ids" id="Names" value="">
          <input type="hidden" name="LinksAll" id="LinksAll" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
      </div>
        </form>
    </div>
  </div>
</div>


  <!-- Modal Pop up delete confirm IOS -->
 <div class="modal fade" id="deleteIOS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> {{ TranslateMenuItem('DeleteData')}}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuItem('Are you sure want to delete it')}}
          <form action="{{ route('VersionAssetApkIOS-deleteAsset') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="text" name="name" id="id1" value="">
            <input type="text" name="id" id="name1" value="">
            <input type="text" name="link" id="link1" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- Modal Pop up delete all selected data Ios -->
 <div class="modal fade" id="deleteAll2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('Delete all selected data')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are U Sure')}}
        <form action="{{ route('VersionAssetApkIOS-deleteAssetAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="names2" id="ids2" value="">
          <input type="hidden" name="ids2" id="Names2" value="">
          <input type="hidden" name="LinksAll2" id="LinksAll2" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
      </div>
        </form>
    </div>
  </div>
</div>



  <!-- Modal Pop up delete confirm Windows -->
 <div class="modal fade" id="deletewindows" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> {{ TranslateMenuItem('DeleteData')}}</h5>
          <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          {{ TranslateMenuItem('Are you sure want to delete it')}}
          <form action="{{ route('VersionAssetApkWindows-deleteAsset') }}" method="post">
            {{ method_field('delete')}}
            {{ csrf_field() }}
            <input type="hidden" name="name" id="id3" value="">
            <input type="hidden" name="id" id="name3" value="">
            <input type="hidden" name="link" id="link3" value="">
        </div>
        <div class="modal-footer">
          <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i>{{ TranslateMenuItem('Yes')}}</button>
          <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i>{{ TranslateMenuItem('No')}}</button>
        </div>
          </form>
      </div>
    </div>
  </div>

<!-- Modal Pop up delete all selected data Windows -->
 <div class="modal fade" id="deleteAll3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i>{{ TranslateMenuItem('Delete all selected data')}}</h5>
        <button style="color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-remove"></i>
        </button>
      </div>
      <div class="modal-body">
        {{ TranslateMenuItem('Are U Sure')}}
        <form action="{{ route('VersionAssetApkWindows-deleteAssetAllSelected') }}" method="post">
          {{ method_field('delete')}}
          {{ csrf_field() }}
          <input type="hidden" name="names2" id="ids3" value="">
          <input type="hidden" name="ids2" id="Names3" value="">
          <input type="hidden" name="LinksAll2" id="LinksAll3" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="button_example-yes btn sa-btn-success"><i class="fa fa-check"></i> Yes</button>
        <button type="button" class="button_example-no btn sa-btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> No</button>
      </div>
        </form>
    </div>
  </div>
</div>

<script>

// ==================== choose file button Android ======================= //
(function() {
  
  'use strict';

  $('.input-file').each(function() {
    var $input = $(this),
        $label = $input.next('.js-labelFile'),
        labelVal = $label.html();
    
   $input.on('change', function(element) {
      var fileName = '';
      if (element.target.value) fileName = element.target.value.split('\\').pop();
      fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
   });
  });

})();



</script>


<script>
    $(document).ready(function() {
      $('table.table').dataTable( {
        "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
        "ordering": false,
      });

      //=============================== delete check all IOS =====================================//
    //check all IOS
    $('#trash2').hide();
      //check all
      $('#checkAll2').on('click', function(e) {
        if($(this).is(":checked", true))
        {
          $(".deleteIdAll2").prop('checked', true);
          $("#trash2").show();
        }else{
          $(".deleteIdAll2").prop('checked', false);
          $("#trash2").hide();
        }
      })


    $('.delete2').click(function(e) {
      e.preventDefault();
      var allValsIOS = [];
      var alllinkIOS = [];
      var allnameIOS = [];
      $('.deleteIdAll2:checked').each(function() {
        allValsIOS.push($(this).attr('data-pk'));
        alllinkIOS.push($(this).attr('data-link'));
        allnameIOS.push($(this).attr('data-name'));

        var join_selected_valuesIOS = allValsIOS.join(",");
        var join_selected_linkIOS = alllinkIOS.join(",");
        var join_selected_nameIOS = allnameIOS.join(",");

        $('#ids2').val(join_selected_valuesIOS);
        $('#LinksAll2').val(join_selected_linkIOS);
        $('#Names2').val(join_selected_nameIOS);

      });
    });

    //hide and show icon delete all
    $('#trash2').hide();
    $(".deleteIdAll2").click(function(e) {
      
        if($(".deleteIdAll2:checked").length > 1) {
          $("#trash2").show();
        }else{
          $("#trash2").hide();
        }
    });

    //=============================== delete check all Windows =====================================//
    //check all Windows
    $('#trash3').hide();
      //check all
      $('#checkAll3').on('click', function(e) {
        if($(this).is(":checked", true))
        {
          $(".deleteIdAll3").prop('checked', true);
          $("#trash3").show();
        }else{
          $(".deleteIdAll3").prop('checked', false);
          $("#trash3").hide();
        }
      })


    $('.delete3').click(function(e) {
      e.preventDefault();
      var allValsIOS = [];
      var alllinkIOS = [];
      var allnameIOS = [];
      $('.deleteIdAll3:checked').each(function() {
        allValsIOS.push($(this).attr('data-pk'));
        alllinkIOS.push($(this).attr('data-link'));
        allnameIOS.push($(this).attr('data-name'));

        var join_selected_valuesIOS = allValsIOS.join(",");
        var join_selected_linkIOS = alllinkIOS.join(",");
        var join_selected_nameIOS = allnameIOS.join(",");

        $('#ids3').val(join_selected_valuesIOS);
        $('#LinksAll3').val(join_selected_linkIOS);
        $('#Names3').val(join_selected_nameIOS);

      });
    });

    //hide and show icon delete all
    $('#trash2').hide();
    $(".deleteIdAll2").click(function(e) {
      
        if($(".deleteIdAll2:checked").length > 1) {
          $("#trash2").show();
        }else{
          $("#trash2").hide();
        }
    });

      //=============================== delete check all Windows ====================================//
      //check all Windows
      $('#trash3').hide();
      $(".deleteIdAll3").click(function(e) {
        
          if($(".deleteIdAll3:checked").length > 1) {
            $("#trash3").show();
          }else{
            $("#trash3").hide();
          }
      });

      //=============================== delete check all android ====================================//
      //check all android
      $('#trash').hide();
      //check all
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

      //mengambil data
      $('.delete').click(function(e) {
      e.preventDefault();
      var allVals = [];
      var alllink = [];
      var allname = [];
        $(".deleteIdAll:checked").each(function() {
          allVals.push($(this).attr('data-pk'));
          alllink.push($(this).attr('data-link'));
          allname.push($(this).attr('data-name'));

          var join_selected_values = allVals.join(",");
          var join_selected_link = alllink.join(",");
          var join_selected_name = allname.join(",");
          
          $('#ids').val(join_selected_values);
          $('#LinksAll').val(join_selected_link);
          $('#Names').val(join_selected_name);
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



    });
  
    table = $('table.table').dataTable({
      "sDom": "t"+"<'dt-toolbar-footer d-flex test'>",
      "autoWidth" : true,
      "paging": false,
      "ordering": false,
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

    
    /* =========================== CHECK DELETE PERMISSION ============================== */
    // checkbox delete permission android
    @php
            $a = 1;
            foreach($xml_andro->children() as $xl) {
              $ckbox = str_replace('.','_', $xl['name']);
              echo'$(".delete'.$ckbox.$a.'").hide();';
              echo'$(".deletepermission'.$ckbox.$a.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$ckbox.$a.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$ckbox.$a.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$ckbox.$a.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$ckbox.$a.'").click(function(e) {';
                echo'e.preventDefault();';

                echo"var id    = $(this).attr('data-pk');";
                echo"var name  = $(this).attr('data-name');";
                echo"var link  = $(this).attr('data-link1');";
                echo'var test  = $("#id").val(id);';
                echo'var test2 = $("#name").val(name);';
                echo'var test3 = $("#Link").val(link);';
              echo'});';
            }
      @endphp
    
    //checkbox delete permission IoS
    @php
            $b = 2;
            foreach($xml_ios->children() as $xl_ios) {
              $ckbox = str_replace('.','_', $xl_ios['name']);
              echo'$(".delete'.$ckbox.$b.'").hide();';
              echo'$(".deletepermission'.$ckbox.$b.'").on("click", function() {';
              echo 'console.log("'.$ckbox.$b.'");';
                echo 'if($( ".deletepermission'.$ckbox.$b.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$ckbox.$b.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$ckbox.$b.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$ckbox.$b.'").click(function(e) {';
                echo'e.preventDefault();';
                  
                echo"var id   = $(this).attr('data-pk');";
                echo"var name = $(this).attr('data-name');";
                echo"var link = $(this).attr('data-link');";
                echo'var test = $("#id1").val(id);';
                echo'var test2= $("#name1").val(name);';
                echo'var test3= $("#link1").val(link);';
              echo'});';
            }

    @endphp


    //checkbox delete permission Windows
    @php
            $c = 3;
            foreach($xml_windows->children() as $xl_windows) {
              $ckbox = str_replace('.','_', $xl_windows['name']);
              echo'$(".delete'.$ckbox.$c.'").hide();';
              echo'$(".deletepermission'.$ckbox.$c.'").on("click", function() {';
                echo 'if($( ".deletepermission'.$ckbox.$c.':checked" ).length > 0)';
                echo '{';
                  echo '$(".delete'.$ckbox.$c.'").show();';
                echo'}';
                echo'else';
                echo'{';
                  echo'$(".delete'.$ckbox.$c.'").hide();';
                echo'}';

              echo '});';

              echo'$(".delete'.$ckbox.$c.'").click(function(e) {';
                echo'e.preventDefault();';
                  
                echo"var id   = $(this).attr('data-pk3');";
                echo"var name = $(this).attr('data-name3');";
                echo"var link = $(this).attr('data-link3');";
                echo'var test = $("#id3").val(id);';
                echo'var test2= $("#name3").val(name);';
                echo'var test3= $("#link3").val(link);';
              echo'});';
            }

    @endphp
    



    /* ========================= CREATE ASSET ============================== */

    // create asset adr upload file name
    var input = document.getElementById( 'inputFile' );
    var infoArea = document.getElementById( 'file-upload-filename' );

    input.addEventListener( 'change', showFileName );

    function showFileName( event ) {
  
          // the change event gives us the input it occurred in 
          var input = event.srcElement;
  
          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;
  
          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = ''+ fileName;
    }


    // create asset IOS upload file name
    var inputIOS = document.getElementById( 'inputFile2' );
    var infoAreaIOS = document.getElementById( 'uploadFilename2' );

    inputIOS.addEventListener( 'change', showFileName2 );

    function showFileName2( event ) {
  
          // the change event gives us the input it occurred in 
          var inputIOS = event.srcElement;
  
          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileNameIOS = inputIOS.files[0].name;
  
          // use fileName however fits your app best, i.e. add it into a div
          infoAreaIOS.textContent = ''+ fileNameIOS;
    }


    /* ======================== EDIT ASSET ============================== */

    // Edit asset adr upload file name
    var inputE = document.getElementById( 'inputGroupFile3' );
    var infoArea = document.getElementById( 'file-upload-filename3' );

    input.addEventListener( 'change', showFileName );

    function showFileName( event ) {
  
          // the change event gives us the input it occurred in 
          var input = event.srcElement;
  
          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;
  
          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = ''+ fileName;
    }

    

  </script>
@endsection