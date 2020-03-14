
    <link rel="shortcut icon" href="/game/bgt/TemplateData/favicon.ico">
    <link rel="stylesheet" href="/game/bgt/TemplateData/style.css">
    <script src="/game/bgt/TemplateData/UnityProgress.js"></script>
    <script src="/game/bgt/Build/UnityLoader.js"></script>
    <link rel="stylesheet" media="screen, print" href="/assets/vendors/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/assets/app/app.bundle.css">
    <script src="/assets/vendors/vendors.bundle.js"></script>
	  <script src="/assets/app/app.bundle.js"></script>

    <style>
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
        var gameInstance = UnityLoader.instantiate("gameContainer", "/game/bgt/Build/BGT Webgl_7.json", {onProgress: UnityProgress});

        function OnAppReady(){
            console.log("### application is loaded");
            var nametable = '{{ $name_table }}';
            var idtable   = '{{ $idtable }}';
            var user      = '{{ $username }}';
            var pass      = '{{ $password }}';

            console.log("========= ini PARAM 1.1");
            var param = {id: idtable, name: nametable, username: user, password: pass};
            console.log(param);
            console.log("========= ini PARAM 2", param);
            console.log("========= ini PARAM 2str ; " +JSON.stringify(param));
            gameInstance.SendMessage("SystemNetwork", "GetDataFromWeb", JSON.stringify(param));
        }
    </script>

  <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
      <div class="widget-header">	
        <h2><strong><i class="fa fa-puzzle-piece"></i>{{ TranslateMenuGame('Asta Big Two Table') }}</strong></h2>				
      </div>
    </header>

    <div>

            <div class="webgl-content" style="width: 70%; height: 80%;margin-top:5%;">
                <div id="gameContainer" style="width: 100%; height:auto;margin-right:1%"></div>
                <div class="footer">
                    <div class="webgl-logo"></div>
                    <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>
                    <div class="title">BGTAstaGame</div>
                </div>
            </div>

    </div>

  </div>