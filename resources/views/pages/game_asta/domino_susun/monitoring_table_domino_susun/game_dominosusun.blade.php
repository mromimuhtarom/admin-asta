@extends('index')

@section('content')
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="#">
    <script src="#"></script>
    <script src="#"></script>

    <style>
        #gameContainer{
            float: left;
        }
        #main{
            float: right;
        }
    </style>

    <script>
        var gameInstance = UnityLoader.instantiate("gameContainer", "", {onProgress: UnityProgress});

        function OnAppReady(){
            console.log('### application is loaded');
            var nametable   = '{{ $name_table }}';
            var idtable     = '{{ $id_table }}';
            var user        = '{{ $username }}';
            var pass        = '{{ $password }}';

            console.log("======= ini PARAM 1.1");
            var param = {id: idtable, name: nametable, username: user, password: pass};
            console.log(param);
            console.log("====== ini PARAM 2", param);
            console.log("====== ini PARAM 2 str ; " + JSON.stringify(param));
            gameInstance.SendMessage("GameNetwork", "GetDataFromWeb", JSON.stringify(param));   
        }
    </script>

    <div class="jarviswidget jarviswidget-color-blue-dark no-padding" id="wid-id-18" data-widget-colorbutton="false" data-widget-editbutton="false">
        <header>
            <div class="widget-header">
                <h2><strong><i class="fa fa-puzzle-piece">Asta Domino Susun</i></strong></h2>
            </div>
        </header>
        
        <div>
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
                            <div id="gameContainer" style="width: 960px; height: 600px"></div>
                            <div class="footer">
                                <div class="webgl-logo"></div>
                                <div class="fullscreen" onclick="gameInstance.setFullscreen(1)"></div>
                                <div class="title">Asta Domino Susun</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection