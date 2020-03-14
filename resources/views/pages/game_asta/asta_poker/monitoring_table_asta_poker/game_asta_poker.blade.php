
    <link rel="shortcut icon" href="/game/asta_poker/TemplateData/favicon.ico">
    <link rel="stylesheet" href="/game/asta_poker/TemplateData/style.css">
    <script src="/game/asta_poker/TemplateData/UnityProgress.js"></script>
    <script src="/game/asta_poker/Build/UnityLoader.js"></script>
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
        var gameInstance = UnityLoader.instantiate("gameContainer", "/game/asta_poker/Build/TPK.json", {onProgress: UnityProgress});
       
        function OnAppReady(){
            console.log("### application is loaded");
            var nametable = '{{ $name_table}}';
            var idtable = '{{ $idtable }}';
            var user = '{{ $username }}';
            var pass = '{{ $password }}';
                
            console.log("========== ini PARAM 1.1");
            var param = {id: idtable, name: nametable, username: user, password: pass};
            console.log(param);
            console.log("========== ini PARAM 2", param);
            console.log("========== ini PARAM 2 str ; " + JSON.stringify(param));
            gameInstance.SendMessage("GameNetwork", "GetDataFromWeb", JSON.stringify(param)); 
        }
        // function f1(value){
        //       console.log("========== ini PARAM 1");
        //       var nametable = value.options[value.selectedIndex].text;
        //       var idtable = value.options[value.selectedIndex].value;
        //       console.log("========== ini PARAM 1.1");
        //       var param = {id: idtable, name: nametable};
        //       console.log("========== ini PARAM 2", param);
        //       console.log("========== ini PARAM 2 str ; " + JSON.stringify(param));
        //       gameInstance.SendMessage("GameNetwork", "GetDataFromWeb", JSON.stringify(param)); 
        // } /*wew*/
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
                    <div class="title">TPKAstaGame</div>
                </div>
            </div>
                        
         
    </div>

  </div>