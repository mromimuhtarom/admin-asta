@extends('index')

@section('sidebarmenu')
    @include('menu.menuadmin')
@endsection

@section('content')
<!-- Widget ID (each widget will need unique ID)-->
<div class="jarviswidget jarviswidget-color-darken" id="wid-id-2" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false">
        <!-- widget options:
            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
            
            data-widget-colorbutton="false"	
            data-widget-editbutton="false"
            data-widget-togglebutton="false"
            data-widget-deletebutton="false"
            data-widget-fullscreenbutton="false"
            data-widget-custombutton="false"
            data-widget-collapsed="true" 
            data-widget-sortable="false"
            
        -->
        <header>
            <div class="widget-header">	
                <span class="widget-icon"> <i class="fa fa-arrows-v"></i> </span>
                <h2 class="font-md"><strong>Collapsable</strong> <i>Widget</i></h2>				
            </div>
        </header>

        <!-- widget div-->
        <div>
            
            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->
            
            <!-- widget content -->
            <div class="widget-body">
                
                <h2 class="alert alert-warning"> This widget is opened by default </h2>
                <code>data-widget-togglebutton</code>
                <br><br>
                <p>Notice the header text size slightly larger than other widget headers</p>
                
            </div>
            <!-- end widget content -->
            
        </div>
        <!-- end widget div -->
        
    </div>
    <!-- end widget -->
@endsection