@extends('index')

@section('content')
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
    </style>

    <script>
        var gameInstance = UnityLoader.instance("gameContainer", "", {onProgress: UnityProgress});

        function OnAppReady(){
            console.log("### application is loaded");
            var nametable = '{{ $name_table }}';
            var idtable = '{{ $idtable }}';
            var user = '{{ $username }}';
            var pass = '{{ $password }}';

            console.log("========= ini PARAM 1.1");
            var param = {id: idtable, name: nametable, username: user, password: pass};
            console.log(param);
            console.log("========= ini PARAM 2", param);
            console.log("========= ini PARAM 2str ; " +JSON.stringify(param));
            gameInstance.SendMessage("GameNetwork", "GetDataFromWeb", JSON.stringify(param));
        }
    </script>

<div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
    <header>
        <div>
            <h2><strong><i class="fa fa-puzzle-piece"></i> Big two </strong></h2>
        </div>
    </header>
</div>

<div class="widget-body">
    <div class="widget-body-toolbar">
        <div class="row">
            <div class="col-9 col-sm-5 col-md-5 col-lg-5">

            </div>
        </div>
    </div>

    <div class="custom-scroll table-responsive" style="height:800px;">
        <div class="table-outer">
            <div class="webgl-content">
                <div id="gameContainer" style="width: 960px; height:600px;"></div>
                <div class="footer">
                    <div class="webgl-logo"></div>
                    <div class="fullscreen" onclick="gameInstance.setFullscreen(1)"></div>
                    <div class="title">Asta Big Two</div>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection