@extends('index')


@section('content')
    <link rel="shortcut icon" href="/game/asta_poker/TemplateData/favicon.ico">
    <link rel="stylesheet" href="/game/asta_poker/TemplateData/style.css">
    <script src="/game/asta_poker/TemplateData/UnityProgress.js"></script>
    <script src="/game/asta_poker/Build/UnityLoader.js"></script>

    <style> /*wew*/
      #gameContainer{
          float: left;
      }
      #main{
          float: right;
      }
    </style>
    <script>
        var gameInstance = UnityLoader.instantiate("gameContainer", "/game/asta_poker/Build/13.json", {onProgress: UnityProgress});
       
        function OnAppReady(){
            console.log("### application is loaded");
            var nametable = '{{ $name_table}}';
            var idtable = '{{ $idtable }}';
                
            console.log("========== ini PARAM 1.1");
            var param = {id: idtable, name: nametable};
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
      
      <div class="widget-body">
        <div class="widget-body-toolbar">
          <div class="row">
            <!-- Button tambah data baru -->
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">

            </div>
            <!-- End Button tambah data baru -->
          </div>
        </div>

        
        
        <div class="custom-scroll table-responsive" style="height:800px;">
          <div class="table-outer">
            <div class="webgl-content">
                <div id="gameContainer" style="width: 960px; height: 600px"></div>
                <div class="footer">
                    <div class="webgl-logo"></div>
                    <div class="fullscreen" onclick="gameInstance.SetFullscreen(1)"></div>
                    <div class="title">TPKAstaGame</div>
                </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>
@endsection