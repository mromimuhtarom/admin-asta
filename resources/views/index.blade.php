<!DOCTYPE html>

<html lang="en" class="smart-style-0">
<head>
  <title>Dashboard | Smart Admin 2.0</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,500,700">
  <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" media="screen, print" href="/assets/vendors/vendors.bundle.css">
  <link rel="stylesheet" media="screen, print" href="/assets/app/app.bundle.css">
	<link rel="stylesheet" type="text/css" href="/assets/pages/homepage.css">
  <link rel="stylesheet" type="text/css" href="/assets/pages/datatables.css">
  <link rel="stylesheet" href="/css/style1.css">
  <script src="/assets/vendors/vendors.bundle.js"></script>
	<script src="/assets/app/app.bundle.js"></script>
   <!-- bootstrap -->
	 {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"> --}}
	 {{-- <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>  --}}
	 {{-- <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>   --}}

	 <!-- x-editable (bootstrap version) -->
	 {{-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	 <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script> --}}

</head>
<body class="smart-style-0">
  
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
          {{-- <div class="sa-header-container h-100">
            <div class="d-table d-table-fixed h-100 w-100">
              <div class="sa-logo-space d-table-cell h-100">
                <div class="flex-row d-flex align-items-center h-100">
                  <a class="sa-logo-link" href="" title="Smart Admin 2.0"><img alt="Smart Admin 2.0" src="/assets/img/common/sa-logo.png" class="sa-logo"></a>
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
                            <img src="/assets/img/avatars/sunny.png" alt="John Doe">
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
            
          </div> --}}
        </header>
        <!-- END .sa-page-header -->
    <div class="sa-page-body">
    
      
      <!-- BEGIN .sa-aside-left -->
      
      <div class="sa-aside-left">
      
          <a href="javascript:void(0)"  onclick="SAtoggleClass(this, 'body', 'sa-shortcuts-expanded')" class="sa-sidebar-shortcut-toggle">
							<img src="/assets/img/avatars/sunny.png" alt="" class="online">
							@php
							$operator_id = Session::get('userId');
							$username = DB::table('asta_db.operator')->where('op_id', '=', $operator_id)->first();		
							@endphp
              <span>{{ ucwords($username->fullname) }} <span class="fa fa-angle-down"></span></span>
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
						@yield('page')        	
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
          		<a href="javascript:void(0);" id="smart-style-0" data-skinlogo="/assets/img/common/sa-logo.png" class="btn btn-block btn-xs text-white margin-right-5" style="background-color:#4E463F;">
          			<i class="fa fa-check fa-fw" id="skin-checked"></i>Smart Default
          		</a>
          		<a href="javascript:void(0);" id="smart-style-1" data-skinlogo="/assets/img/common/sa-logo-white.png" class="btn btn-block btn-xs text-white" style="background:#3A4558;">Dark Elegance</a>
          		<a href="javascript:void(0);" id="smart-style-2" data-skinlogo="/assets/img/common/sa-logo-blue.png" class="btn btn-xs btn-block text-darken margin-top-5" style="background:#fff;">Ultra Light</a>
          		<a href="javascript:void(0);" id="smart-style-3" data-skinlogo="/assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-5" style="background:#f78c40">Google Skin</a>
          		<a href="javascript:void(0);" id="smart-style-4" data-skinlogo="/assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-5" style="background: #bbc0cf; border: 1px solid #59779E; color: #17273D !important;">PixelSmash</a> <a href="javascript:void(0);" id="smart-style-5" data-skinlogo="/assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-5" style="background: rgba(153, 179, 204, 0.2); border: 1px solid rgba(121, 161, 221, 0.8); color: #17273D !important;">Glass </a><a href="javascript:void(0);" id="smart-style-6" data-skinlogo="assets/img/common/sa-logo-pale.png" class="btn btn-xs btn-block text-white margin-top-6" style="background: #2196F3; border: 1px solid rgba(0, 0, 0, 0.3); color: #FFF !important;">MaterialDesign <sup>beta</sup> </a>
          	</section>
          </div>
          
          <!-- END .sa-page-breadcrumb -->
        <div>
        <div class="sa-content">
					<div class="d-flex w-100 home-header">
						<div>
							@yield('namepages')				
            </div>
        	</div>
        	<div>
            @yield('content')
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

	// autoclose alert
	$(".alert").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert").slideUp(500);
	});
</script>

	<script type="text/javascript">
		/*
		* RUN PAGE GRAPHS
		*/

		/* TAB 1: UPDATING CHART */
		// For the demo we use generated data, but normally it would be coming from the server

		var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');

		function getRandomData() {
			if (data.length > 0)
				data = data.slice(1);

			// do a random walk
			while (data.length < totalPoints) {
				var prev = data.length > 0 ? data[data.length - 1] : 50;
				var y = prev + Math.random() * 10 - 5;
				if (y < 0)
					y = 0;
				if (y > 100)
					y = 100;
				data.push(y);
			}

			// zip the generated y values with the x values
			var res = [];
			for (var i = 0; i < data.length; ++i)
				res.push([i, data[i]])
			return res;
		}

		// setup control widget
		var updateInterval = 1500;
		$("#updating-chart").val(updateInterval).change(function() {

			var v = $(this).val();
			if (v && !isNaN(+v)) {
				updateInterval = +v;
				$(this).val("" + updateInterval);
			}

		});

		// setup plot
		var options = {
			yaxis : {
				min : 0,
				max : 100
			},
			xaxis : {
				min : 0,
				max : 100
			},
			colors : [$UpdatingChartColors],
			series : {
				lines : {
					lineWidth : 1,
					fill : true,
					fillColor : {
						colors : [{
							opacity : 0.4
						}, {
							opacity : 0
						}]
					},
					steps : false

				}
			},
			grid: {
			    borderWidth: 0,
			    borderColor: "#ccc",
			    margin: {
				    top: 0,
				    right: 10,
				    bottom: 10,
				    left: 0

				}
			}
		};

		var plot = $.plot($("#updating-chart"), [getRandomData()], options);

		/* live switch */
		$('input[type="checkbox"]#start_interval').click(function() {
			if ($(this).prop('checked')) {
				$on = true;
				updateInterval = 1500;
				update();
			} else {
				clearInterval(updateInterval);
				$on = false;
			}
		});

		function update() {
			if ($on == true) {
				plot.setData([getRandomData()]);
				plot.draw();
				setTimeout(update, updateInterval);

			} else {
				clearInterval(updateInterval)
			}

		}

		var $on = false;

		/*end updating chart*/


		/* TAB 2: Social Network  */

		// jQuery Flot Chart
		var twitter = [[1, 27], [2, 34], [3, 51], [4, 48], [5, 55], [6, 65], [7, 61], [8, 70], [9, 65], [10, 75], [11, 57], [12, 59], [13, 62]], facebook = [[1, 25], [2, 31], [3, 45], [4, 37], [5, 38], [6, 40], [7, 47], [8, 55], [9, 43], [10, 50], [11, 47], [12, 39], [13, 47]], data3 = [{
			label : "Twitter",
			data : twitter,
			lines : {
				show : true,
				lineWidth : 1,
				fill : true,
				fillColor : {
					colors : [{
						opacity : 0.1
					}, {
						opacity : 0.13
					}]
				}
			},
			points : {
				show : true
			}
		}, {
			label : "Facebook",
			data : facebook,
			lines : {
				show : true,
				lineWidth : 1,
				fill : true,
				fillColor : {
					colors : [{
						opacity : 0.1
					}, {
						opacity : 0.13
					}]
				}
			},
			points : {
				show : true
			}
		}];

		var options3 = {
			grid : {
				hoverable : true,
			    borderWidth: 0,
			    borderColor: "#ccc"
			},
			colors : ["#568A89", "#3276B1"],
			tooltip : true,
			tooltipOpts : {
				//content : "Value <b>$x</b> Value <span>$y</span>",
				defaultTheme : false
			},
			xaxis : {
				ticks : [[1, "JAN"], [2, "FEB"], [3, "MAR"], [4, "APR"], [5, "MAY"], [6, "JUN"], [7, "JUL"], [8, "AUG"], [9, "SEP"], [10, "OCT"], [11, "NOV"], [12, "DEC"], [13, "JAN+1"]]
			},
			yaxes : {

			}
		};

		/*$('body').load(function(){
			var plot3 = $.plot($("#statsChart"), data, options3);
		})*/


		var plot3 = null;

		function applySoicalPlot() {
			if (plot3) {
				plot3.setData(data3);
				plot3.setupGrid();
				plot3.draw();
			} else {
				plot3 = $.plot($("#statsChart"), [], options3);
			}
		}

		applySoicalPlot();
		

		// END TAB 2

		// TAB THREE GRAPH //
		/* TAB 3: Revenew  */

		var trgt = [[1354586000000, 153], [1364587000000, 658], [1374588000000, 198], [1384589000000, 663], [1394590000000, 801], [1404591000000, 1080], [1414592000000, 353], [1424593000000, 749], [1434594000000, 523], [1444595000000, 258], [1454596000000, 688], [1464597000000, 364]], prft = [[1354586000000, 53], [1364587000000, 65], [1374588000000, 98], [1384589000000, 83], [1394590000000, 980], [1404591000000, 808], [1414592000000, 720], [1424593000000, 674], [1434594000000, 23], [1444595000000, 79], [1454596000000, 88], [1464597000000, 36]], sgnups = [[1354586000000, 647], [1364587000000, 435], [1374588000000, 784], [1384589000000, 346], [1394590000000, 487], [1404591000000, 463], [1414592000000, 479], [1424593000000, 236], [1434594000000, 843], [1444595000000, 657], [1454596000000, 241], [1464597000000, 341]], toggles = $("#rev-toggles"), target = $("#flotcontainer");

		var data2 = [{
			label : "Target Profit",
			data : trgt,
			bars : {
				show : true,
				align : "center",
				barWidth : 30 * 30 * 60 * 1000 * 80
			}
		}, {
			label : "Actual Profit",
			data : prft,
			color : '#3276B1',
			lines : {
				show : true,
				lineWidth : 3
			},
			points : {
				show : true
			}
		}, {
			label : "Actual Signups",
			data : sgnups,
			color : '#71843F',
			lines : {
				show : true,
				lineWidth : 1
			},
			points : {
				show : true
			}
		}]

		var options2 = {
			grid : {
				hoverable : true,
			    borderWidth: 0,
			    borderColor: "#ccc",
			},
			tooltip : true,
			tooltipOpts : {
				//content: '%x - %y',
				//dateFormat: '%b %y',
				defaultTheme : false
			},
			xaxis : {
				mode : "time"
			},
			yaxes : {
				tickFormatter : function(val, axis) {
					return "$" + val;
				},
				max : 1200
			}

		};

		plot2 = null;

		function plotNow() {
			var d = [];
			toggles.find(':checkbox').each(function() {
				if ($(this).is(':checked')) {
					d.push(data2[$(this).attr("name").substr(4, 1)]);
				}
			});
			if (d.length > 0) {
				if (plot2) {
					plot2.setData(d);
					plot2.draw();
				} else {
					plot2 = $.plot(target, d, options2);
				}
			}

		};

		toggles.find(':checkbox').on('change', function() {
			plotNow();
		});
		plotNow()



		/*
		 * VECTOR MAP
		 */

		data_array = {
			"US" : 4977,
			"AU" : 4873,
			"IN" : 3671,
			"BR" : 2476,
			"TR" : 1476,
			"CN" : 146,
			"CA" : 134,
			"BD" : 100
		};

		$('#vector-map').vectorMap({
			map : 'world_mill_en',
			backgroundColor : '#fff',
			regionStyle : {
				initial : {
					fill : '#c4c4c4'
				},
				hover : {
					"fill-opacity" : 1
				}
			},
			series : {
				regions : [{
					values : data_array,
					scale : ['#85a8b6', '#4d7686'],
					normalizeFunction : 'polynomial'
				}]
			},
			onRegionLabelShow : function(e, el, code) {
				if ( typeof data_array[code] == 'undefined') {
					e.preventDefault();
				} else {
					var countrylbl = data_array[code];
					el.html(el.html() + ': ' + countrylbl + ' visits');
				}
			}
		});

		/*
		 * PAGE RELATED SCRIPTS
		 */

		$(".js-status-update a").click(function() {
			var selText = $(this).text();
			var $this = $(this);
			$this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
			$this.parents('.dropdown-menu').find('li').removeClass('active');
			$this.parent().addClass('active');
		});

		/*
		 * FULL CALENDAR JS
		 */

		if ($("#calendar").length) {
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();

			var calendar = $('#calendar').fullCalendar({

				editable : true,
				draggable : true,
				selectable : false,
				selectHelper : true,
				unselectAuto : false,
				disableResizing : false,
				height: "auto",

				header : {
					left : 'title', //,today
					center : '',
					right : '' //month, agendaDay,
				},

				select : function(start, end, allDay) {
					var title = prompt('Event Title:');
					if (title) {
						calendar.fullCalendar('renderEvent', {
							title : title,
							start : start,
							end : end,
							allDay : allDay
						}, true // make the event "stick"
						);
					}
					calendar.fullCalendar('unselect');
				},

				events : [{
					title : 'All Day Event',
					start : new Date(y, m, 1),
					description : 'long description',
					className : ["event", "bg-green-light"],
					icon : 'fa-check'
				}, {
					title : 'Long Event',
					start : new Date(y, m, d - 5),
					end : new Date(y, m, d - 2),
					className : ["event", "bg-red"],
					icon : 'fa-lock'
				}, {
					id : 999,
					title : 'Repeating Event',
					start : new Date(y, m, d - 3, 16, 0),
					allDay : false,
					className : ["event", "bg-blue"],
					icon : 'fa-clock-o'
				}, {
					id : 999,
					title : 'Repeating Event',
					start : new Date(y, m, d + 4, 16, 0),
					allDay : false,
					className : ["event", "bg-blue"],
					icon : 'fa-clock-o'
				}, {
					title : 'Meeting',
					start : new Date(y, m, d, 10, 30),
					allDay : false,
					className : ["event", "bg-darken"]
				}, {
					title : 'Lunch',
					start : new Date(y, m, d, 12, 0),
					end : new Date(y, m, d, 14, 0),
					allDay : false,
					className : ["event", "bg-darken"]
				}, {
					title : 'Birthday Party',
					start : new Date(y, m, d + 1, 19, 0),
					end : new Date(y, m, d + 1, 22, 30),
					allDay : false,
					className : ["event", "bg-darken"]
				}, {
					title : 'Smartadmin Open Day',
					start : new Date(y, m, 28),
					end : new Date(y, m, 29),
					className : ["event", "bg-darken"]
				}],


				eventRender : function(event, element, icon) {
					if (!event.description == "") {
						element.find('.fc-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
					}
					if (!event.icon == "") {
						element.find('.fc-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
					}
				}
			});

		};

		/* hide default buttons */
		//$('.fc-toolbar .fc-right, .fc-toolbar .fc-center').hide();

		// calendar prev
		$('#calendar-buttons #btn-prev').click(function() {
			calendar.fullCalendar('prev');
			return false;
		});

		// calendar next
		$('#calendar-buttons #btn-next').click(function() {
			calendar.fullCalendar('next');
			return false;
		});

		// calendar today
		$('#calendar-buttons #btn-today').click(function() {
			calendar.fullCalendar('today');
			return false;
		});

		// calendar month
		$('#mt').click(function() {
			calendar.fullCalendar('changeView', 'month');
		});

		// calendar agenda week
		$('#ag').click(function() {
			calendar.fullCalendar('changeView', 'agendaWeek');
		});

		// calendar agenda day
		$('#td').click(function() {
			calendar.fullCalendar('changeView', 'agendaDay');
		});






		/*
		 * CHAT
		 */

		$.filter_input = $('#filter-chat-list');
		$.chat_users_container = $('#chat-container > .chat-list-body')
		$.chat_users = $('#chat-users')
		$.chat_body = $('#chat-body');

		/*
		* LIST FILTER (CHAT)
		*/

		// custom css expression for a case-insensitive contains()
		jQuery.expr[':'].Contains = function(a, i, m) {
			return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
		};

		function listFilter(list) {// header is any element, list is an unordered list
			// create and add the filter form to the header

			$.filter_input.change(function() {
				var filter = $(this).val();
				if (filter) {
					// this finds all links in a list that contain the input,
					// and hide the ones not containing the input while showing the ones that do
					$.chat_users.find("a:not(:Contains(" + filter + "))").parent().slideUp();
					$.chat_users.find("a:Contains(" + filter + ")").parent().slideDown();
				} else {
					$.chat_users.find("li").slideDown();
				}
				return false;
			}).keyup(function() {
				// fire the above change event after every letter
				$(this).change();

			});

		}

		// on dom ready
		listFilter($.chat_users);

		// open chat list
		
		$.chat_body.animate({
			scrollTop : $.chat_body[0].scrollHeight
		}, 500);




		/*
		* TODO: add a way to add more todo's to list
		*/

		// initialize sortable
		$(function() {
			$("#sortable1, #sortable2").sortable({
				handle : '.handle',
				connectWith : ".todo",
				update : countTasks
			}).disableSelection();
		});

		// check and uncheck
		$('.todo .checkbox > input[type="checkbox"]').click(function() {
			var $this = $(this).parent().parent().parent();

			if ($(this).prop('checked')) {
				$this.addClass("complete");

				// remove this if you want to undo a check list once checked
				//$(this).attr("disabled", true);
				$(this).parent().hide();

				// once clicked - add class, copy to memory then remove and add to sortable3
				$this.slideUp(500, function() {
					$this.clone().prependTo("#sortable3").effect("highlight", {}, 800);
					$this.remove();
					countTasks();
				});
			} else {
				// insert undo code here...
			}

		})
		// count tasks
		function countTasks() {

			$('.todo-group-title').each(function() {
				var $this = $(this);
				$this.find(".num-of-tasks").text($this.next().find("li").size());
			});

		}




	</script>

</body>
</html>