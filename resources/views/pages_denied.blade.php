<!DOCTYPE html>

<html lang="en" class="smart-style-0">
<head>
  <title>Sunnyat Ahmed | Smart Admin 2.0</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,500,700">
  <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" media="screen, print" href="/assets/vendors/vendors.bundle.css">
  <link rel="stylesheet" media="screen, print" href="/assets/app/app.bundle.css">
	<link rel="stylesheet" type="text/css" href="/assets/pages/error.css">

</head>
<body class="   smart-style-0">
  
  <!-- BEGIN .sa-wrapper -->
  <div class="sa-wrapper">
        <!-- BEGIN .sa-shortcuts -->
        
        <div class="sa-shortcuts-section">
        	<ul>
						@include('menu.menutop')
        	</ul>
        </div>
        <!-- END .sa-shortcuts -->
        
        <header class="sa-page-header">
          <div class="sa-header-container h-100">
            <div class="d-table d-table-fixed h-100 w-100">
              <div class="sa-logo-space d-table-cell h-100">
                <div class="flex-row d-flex align-items-center h-100">
                  <a class="sa-logo-link" href="" title="Smart Admin 2.0"><img alt="Smart Admin 2.0" src="assets/img/common/sa-logo.png" class="sa-logo"></a>
                  <div class="dropdown ml-auto">
                    <button class="btn btn-default sa-btn-icon sa-activity-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user"></span><span class="badge bg-red">21</span></button>
                    <div class="dropdown-menu ml-auto ajax-dropdown" aria-labelledby="dropdownMenuButton">
                      <form class="btn-group btn-group-justified" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-default" onclick="loadNotifications(this)" data-url="ajax/mail.html">Msgs (21)</button>
                        <button type="button" class="btn btn-default" onclick="loadNotifications(this)" data-url="ajax/notifications.html">Notify (3)</button>
                        <button type="button" class="btn btn-default" onclick="loadNotifications(this)" data-url="ajax/tasks.html">Tasks (4)</button>
                      </form>
                      <div class="sa-ajax-notification-container">
                        <div class="alert sa-ajax-notification-alert">
                          <h4>Click a button to show messages here</h4>
                          This blank page message helps protect your privacy, or you can show the first message here automatically.
                        </div>
                        <span class="fa fa-lock fa-4x fa-border"></span>
                      </div>
        
                      <form role="group" class="flex-row d-flex align-items-center sa-ajax-notification-footer">
                        <span>Last updated on: 12/12/2013 9:43AM</span>
                        <button class="btn btn-xs btn-default ml-auto" type="button" onclick="toggleReloadButton(this, event)"><span class="fa fa-refresh"></span></button>
                      </form>
        
                    </div>
                  </div>
                </div>  
              </div>
              <div class="d-table-cell h-100 w-100 align-middle">
                <div class="sa-header-menu">
                  <div class="d-flex align-items-center w-100">
                    <div class="sa-header-left-area">
                      <span class="sa-project-label">Projects:</span>
                      <div class="dropdown sa-project-dropdown">
                        <a href=":;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Recent projects <span class="fa fa-angle-down"></span></a>
                        <div class="dropdown-menu ml-auto" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Online e-merchant management system - attaching integration with the iOS</a>
                          <a class="dropdown-item" href="#">Notes on pipeline upgradee</a>
                          <a class="dropdown-item" href="#">Assesment Report for merchant account</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#"><span class="fa fa-power-off"></span> Clear</a>
                        </div>
                      </div>
                    </div>
                    <div class="ml-auto sa-header-right-area">
                      <div class="form-inline">
                        <span class="dropdown sa-country-dropdown">
                          <a href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><em class="flag flag-us"></em> <span>English (US) <span class="fa fa-angle-down"></span></span></a>
                          <span class="dropdown-menu dropdown-menu-right ml-auto" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item active" href="javascript:void(0);"><span class="flag flag-us"></span> English (US)</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-fr"></span> Français</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-es"></span> Español</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-de"></span> Deutsch</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-jp"></span> 日本語</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-cn"></span> 中文</a> 
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-it"></span> Italiano</a> 
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-pt"></span> Portugal</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-ru"></span> Русский язык</a>
                            <a class="dropdown-item" href="javascript:void(0);"><span class="flag flag-kr"></span> 한국어</a>
                          </span>
                        </span>
                        <button class="btn btn-light sa-btn-icon sa-btn-micro d-none d-lg-block" type="button"><span class="fa fa-microphone"></span></button>
                        <button class="btn btn-light sa-btn-icon sa-toggle-full-screen d-none d-lg-block" type="button" onclick="toggleFullScreen()"><span class="fa fa-arrows-alt"></span></button>
                        <form class="sa-header-search-form">
                          <input type="text" class="form-control" placeholder="Find reports and more">
                          <button type="submit" class="sa-form-btn"><span class="fa fa-search"></span></button>
                        </form>
                        <button class="btn btn-default sa-logout-header-toggle sa-btn-icon" type="button"><span class="fa fa-sign-out"></span></button>
                        <span class="dropdown sa-user-dropdown">
                          <a href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="sa-user-dropdown-toggle">
                            <img src="assets/img/avatars/sunny.png" alt="John Doe">
                          </a>
                          <span class="dropdown-menu dropdown-menu-right ml-auto" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-cog"></i> Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0);"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item padding-10 padding-top-5 padding-bottom-5" href="javascript:void(0);" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                          </span>
                        </span>
                        
                        <button class="btn btn-default sa-btn-icon sa-sidebar-hidden-toggle" onclick="SAtoggleClass(this, 'body', 'sa-hidden-menu')" type="button"><span class="fa fa-reorder"></span></button>
        
                        
                      </div>
                    </div>
                  </div>          
                </div>
              </div>
            </div>
            
          </div>
        </header>
        <!-- END .sa-page-header -->
    <div class="sa-page-body">
    
      
      <!-- BEGIN .sa-aside-left -->
      
      <div class="sa-aside-left">
      
          <a href="javascript:void(0)"  onclick="SAtoggleClass(this, 'body', 'sa-shortcuts-expanded')" class="sa-sidebar-shortcut-toggle">
              <img src="assets/img/avatars/sunny.png" alt="" class="online">
              <span>John.Doe <span class="fa fa-angle-down"></span></span>
          </a>
          <div class="sa-left-menu-outer">
						@include('menu.sidebar_menu')
          </div>
          <a href="javascript:void(0)" class="minifyme" onclick="SAtoggleClass(this, 'body', 'minified')"> 
              <i class="fa fa-arrow-circle-left hit"></i> 
          </a>
      </div>

      

      <!-- BEGIN .sa-content-wrapper -->
      <div class="sa-content-wrapper">
        
          
          <!-- BEGIN .sa-page-breadcrumb -->
          <ol class="align-items-center sa-page-ribbon breadcrumb" aria-label="breadcrumb" role="navigation">
          	<li><span id="refresh" class="btn sa-ribbon-btn sa-theme-btn" data-action="resetWidgets"><i class="fa fa-refresh"></i></span></li>
          		<li class="breadcrumb-item"><a href="javascript:void(0)">Miscellaneous</a></li>
          				<li class="breadcrumb-item"><a href="error404.html">Error 404</a></li>
          	
          </ol>
          
          <div class="sa-theme-settings">
          	<a href="javascript:void(0)" class="sa-theme-settings-toggle" onclick="SAtoggleClass(this, '.sa-theme-settings', 'active')"><span class="fa fa-cogs fa-spin"></span></a>
          	<h4>Layout Options</h4>
          	<ul class="list-unstyled">
          		<li>
          			<label class="vcheck">
          				<input type="checkbox" id="SAFixedHeader" data-add-class="sa-fixed-header" data-remove-class="sa-fixed-header sa-fixed-navigation sa-fixed-ribbon " onchange="SASetClass(this)"> 
          				<span>Fixed Header</span>
          			</label>
          		</li>
          		<li>
          			<label class="vcheck">
          				<input type="checkbox" id="SAFixedNavigation" data-add-class="sa-fixed-navigation sa-fixed-header" data-remove-class="sa-fixed-navigation sa-fixed-ribbon" onchange="SASetClass(this)">
          				<span>Fixed Navigation</span>
          			</label>
          		</li>
          		<li><label class="vcheck"><input type="checkbox" id="SAFixedRibbon" data-add-class="sa-fixed-navigation sa-fixed-header sa-fixed-ribbon" data-remove-class="sa-fixed-ribbon" onchange="SASetClass(this)"> <span>Fixed Ribbon</span></label></li>
          		<li><label class="vcheck"><input type="checkbox" id="SAFixedFooter" data-add-class="sa-fixed-page-footer" data-remove-class="sa-fixed-page-footer" onchange="SASetClass(this)"> <span>Fixed Footer</span></label></li>
          		<li><label class="vcheck"><input type="checkbox" id="SAContainerInside" data-add-class="sa-inside-container" data-remove-class="sa-inside-container sa-fixed-ribbon" data-remove-class="sa-fixed-navigation" onchange="SASetClass(this)"> <span>Inside <strong>.container</strong></span></label></li>
          		<li><label class="vcheck"><input type="checkbox" id="SAMenuOnTop" data-add-class="sa-menu-on-top" data-remove-class="sa-menu-on-top" onchange="SASetClass(this)"> <span>Menu on <strong>top</strong></span></label></li>
          	</ul>
          	<h4>Clear Localstorage</h4>
          	<a href="javascript:void(0)" class="btn sa-btn-primary btn-block" data-action="resetWidgets"><span class="fa fa-refresh"></span> Factory Reset</a>
          
          	<h6 class="margin-top-10 text-medium margin-bottom-5">SmartAdmin Skins</h6>
          	<section id="smart-styles">
          		<a href="javascript:void(0);" id="smart-style-0" data-skinlogo="assets/img/common/sa-logo.png" class="btn btn-block btn-xs text-white margin-right-5" style="background-color:#4E463F;">
          			<i class="fa fa-check fa-fw" id="skin-checked"></i>Smart Default
          		</a>
          		<a href="javascript:void(0);" id="smart-style-1" data-skinlogo="assets/img/common/sa-logo-white.png" class="btn btn-block btn-xs text-white" style="background:#3A4558;">Dark Elegance</a>
          		<a href="javascript:void(0);" id="smart-style-2" data-skinlogo="assets/img/common/sa-logo-blue.png" class="btn btn-xs btn-block text-darken margin-top-5" style="background:#fff;">Ultra Light</a>
          		<a href="javascript:void(0);" id="smart-style-3" data-skinlogo="assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-5" style="background:#f78c40">Google Skin</a>
          		<a href="javascript:void(0);" id="smart-style-4" data-skinlogo="assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-5" style="background: #bbc0cf; border: 1px solid #59779E; color: #17273D !important;">PixelSmash</a> <a href="javascript:void(0);" id="smart-style-5" data-skinlogo="assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-5" style="background: rgba(153, 179, 204, 0.2); border: 1px solid rgba(121, 161, 221, 0.8); color: #17273D !important;">Glass </a><a href="javascript:void(0);" id="smart-style-6" data-skinlogo="assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-6" style="background: #2196F3; border: 1px solid rgba(0, 0, 0, 0.3); color: #FFF !important;">MaterialDesign <sup>beta</sup> </a>
          	</section>
          </div>
          
          <!-- END .sa-page-breadcrumb -->
        
        <div class="sa-content">
		<div class="d-flex w-100">
			<div class="text-center error-box">
				<h1 class="error-text-2 bounceInDown animated"> Error 404 <span class="particle particle--c"></span><span class="particle particle--a"></span><span class="particle particle--b"></span></h1>
				<h2 class="font-xl"><strong><i class="fa fa-fw fa-warning fa-lg text-warning"></i> Page <u>Not</u> Found</strong></h2>
				<br />
				<p class="lead">
					The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from
				</p>
				<p class="font-md">
					<b>... That didn't work on you? Dang. May we suggest to Click The Back link Below!!</b>
				</p>
				<br>
				<p class="font-md">
					<a href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Back</a>
				</p>


			</div>
		</div>
        </div>


          <!-- BEGIN .sa-page-footer -->
          <footer class="sa-page-footer">
              <div class="d-flex align-items-center w-100 h-100">
                <div class="footer-left">
                  SmartAdmin 1.9.X - <span class="footer-txt">Web Application Framework</span> &copy; 2017-2019            
                </div>
                <div class="ml-auto footer-right">
                  <i class="hidden-xs text-blue-light">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
                  <div class="btn-group dropup">
                    <button class="btn btn-xs dropdown-toggle sa-btn-blue" data-toggle="dropdown">
                      <i class="fa fa-link"></i> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li>
                        <div class="padding-5">
                          <p class="text-darken font-sm m-0">Download Progress</p>
                          <div class="progress progress-micro m-0">
                            <div class="progress-bar bg-success" style="width: 50%;"></div>
                          </div>
                        </div>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li>
                        <div class="padding-5">
                          <p class="text-darken font-sm m-0">Server Load</p>
                          <div class="progress progress-micro m-0">
                            <div class="progress-bar bg-success" style="width: 20%;"></div>
                          </div>
                        </div>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li>
                        <div class="padding-5">
                          <p class="text-darken font-sm m-0">Memory Load <span class="text-danger">*critical*</span></p>
                          <div class="progress progress-micro m-0">
                            <div class="progress-bar bg-danger" style="width: 70%;"></div>
                          </div>
                        </div>
                      </li>
                      <li class="dropdown-divider"></li>
                      <li>
                        <div class="padding-5">
                          <button class="btn btn-block btn-default">refresh</button>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

          </footer>
          <!-- END .sa-page-footer -->

      
      </div>
      <!-- END .sa-content-wrapper -->


    </div>

   

  </div>
  <!-- END .sa-wrapper -->

  <script src="/assets/vendors/vendors.bundle.js"></script>
  <script src="/assets/app/app.bundle.js"></script>
  
<script>
  $(function () {
      $('#menu1').metisMenu();
  });
</script>


</body>
</html>