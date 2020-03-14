
    <link rel="shortcut icon" href="/game/dms/TemplateData/favicon.ico">
    <link rel="stylesheet" href="/game/dms/TemplateData/style.css">
    <script src="/game/dms/TemplateData/UnityProgress.js"></script>
    <script src="/game/dms/Build/UnityLoader.js"></script>
    <link rel="stylesheet" media="screen, print" href="/assets/vendors/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/assets/app/app.bundle.css">
    <script src="/assets/vendors/vendors.bundle.js"></script>
	<script src="/assets/app/app.bundle.js"></script>

    <style> /*wew*/
      #gameContainer{
          float: left;
      }
      #main{
          float: right;
      }
      canvas {
          width: 100% !important;
          height: auto !important;
      }
    </style>
  <script>
    var gameInstance = UnityLoader.instantiate("gameContainer", "/game/dms/Build/DMSWeb.json", {
      onProgress: UnityProgress
    });

    function OnAppReady() {
      console.log("### application is loaded");
      var _username = '{{ $username }}';
      var _password = '{{ $password }}';
      var _idtable = {{ $idtable }};

      var param = {
        username: _username,
        password: _password,
        roomid: _idtable
      };
      console.log("========== ini PARAM 2", param);
      console.log("========== ini PARAM 2 str ; " + JSON.stringify(param));
      gameInstance.SendMessage("NetworkManager", "GetDataFromWeb", JSON.stringify(param));
    }
  </script>

  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-puzzle-piece"></i>{{ TranslateMenuGame('Asta Poker Table') }}</strong></h2>				
      </div>
    </header>

    <div> 
      

            <div class="webgl-content" style="width: 70%; height: 80%;position:absolute;margin-top:5%;">
                <div id="gameContainer" class="border border-dark" style="width: 100%; height:auto;margin-right:1%;"></div>
                <div class="footer">
                    <div class="webgl-logo"></div>
                    <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>
                    <div class="title">DMSAstaGame</div>
                </div>
            </div>
                        
        
    </div>

  </div>