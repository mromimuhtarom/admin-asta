<!DOCTYPE html>

<html lang="en" class="smart-style-0">
<head>
  <title>Game Asta Poker</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,500,700">
  <link rel="shortcut icon" href="/assets/img/favicon/asta.png" type="image/x-icon">
  <link rel="icon" href="/assets/img/favicon/asta.png" type="image/x-icon">
  <link rel="stylesheet" media="screen, print" href="/assets/vendors/vendors.bundle.css">
  <link rel="stylesheet" media="screen, print" href="/assets/app/app.bundle.css">
	<link rel="stylesheet" type="text/css" href="/assets/pages/homepage.css">
  <link rel="stylesheet" type="text/css" href="/assets/pages/datatables.css">
  <link rel="stylesheet" href="/css/style1.css">
  <link rel="stylesheet" href="/css/versionasset.css">
  <script src="/assets/vendors/vendors.bundle.js"></script>
	<script src="/assets/app/app.bundle.js"></script>
	<script src="/js/sceditor/minified/sceditor.min.js"></script>
	<link rel="stylesheet" href="/js/sceditor/minified/themes/default.min.css" />
	<link rel="stylesheet" href="/css/loader.css">

	
   <!-- bootstrap -->

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
						<button class="btn btn-default sa-btn-icon sa-sidebar-hidden-toggle d-block d-md-block d-lg-block d-xl-none" onclick="SAtoggleClass(this, 'body', 'sa-hidden-menu')" type="button"><span class="fa fa-reorder"></span></button>
          
        </header>
        <!-- END .sa-page-header -->
    <div class="sa-page-body">
    
      
      <!-- BEGIN .sa-aside-left -->
      
      <div class="sa-aside-left">
      
          <a href="javascript:void(0)" class="sa-sidebar-shortcut-toggle" style="color:white;">
							<p id="waktu" align="center"></p>
							<script>
									var myVar = setInterval(myTimer ,1000);
									function myTimer() {
										var d = new Date();
										document.getElementById("waktu").innerHTML = d.toLocaleTimeString();
									}
							</script>
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
						&nbsp;
						<a href="" style="color:white;margin-left:30%;">
									Hi
								@php
								$operator_id = Session::get('userId');
								$username = DB::table('asta_db.operator')->where('op_id', '=', $operator_id)->first();		
								@endphp
								<span>{{ ucwords($username->fullname) }} Welcome To Our Website</span>
						</a>
						&nbsp;
						<a href="javascript:void(0)"  onclick="SAtoggleClass(this, 'body', 'sa-shortcuts-expanded')" class="sa-sidebar-shortcut-toggle" style="color:white;">
							<span class="fa fa-user"></span><span class="fa fa-cogs"></span><span class="fa fa-angle-down"></span>
						</a>
          </ol>
          
					{{-- untuk layout bsa di ganti theme --}}
          
          <!-- END .sa-page-breadcrumb -->
        <div>
        <div class="sa-content">
					<div class="d-flex w-100 home-header">
						<div>
							@yield('namepages')				
            </div>
					</div>
					<div class="reloadpage">
							<div class="loaderpagecontent"></div>
					</div>
        	<div class="contentreload">
						@yield('content')
						<script>
						  $('form').submit(function() {
    						$(this).find(".submit-data").prop('disabled',true);
							});
						</script>
					</div>
					<script>
							$(function() {
								$(".reloadpage").fadeOut(2000, function() {
									$(".contentreload").fadeIn(1000);
								});
							});
					</script>
        </div>


          <!-- BEGIN .sa-page-footer -->
          <footer class="sa-page-footer">
              <div class="d-flex align-items-center w-100 h-100">
                <div class="footer-left">
                  Asta Team - <span class="footer-txt">Web Application Admin Asta Game</span> &copy; 2019            
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
	<script>$.fn.slider = null</script>
	<script src="/assets/vendors/vendors.bundle.js"></script>
	<script src="/assets/app/app.bundle.js"></script>  
	<script>
			$(function () {
				$('#menu1').metisMenu();
			});
	</script>
	<script>
			$(document).ready(function() {
			
			//                                                                                                                                                                    pageSetUp();

			/*
			 * SUMMERNOTE EDITOR
			 */
			
			$('.summernote').summernote({
				height: 200,
				toolbar: [
			    ['style', ['style']],
			    ['font', ['bold', 'italic', 'underline', 'clear']],
			    ['fontname', ['fontname']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']],
			    ['height', ['height']],
			    ['table', ['table']],
			    ['insert', ['link', 'picture', 'hr']],
			    ['view', ['fullscreen', 'codeview', 'help']]
			  ]
			});
		
			/*
			 * MARKDOWN EDITOR
			 */

			$("#mymarkdown").markdown({
				autofocus:false,
				savable:true,
				iconlibrary: "fa"
			})
						
		
		})
	</script>
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

		$(document).ready(function() {

			$('#technig').summernote({

  			height:300,

			});

		});
	</script>

</body>
</html>