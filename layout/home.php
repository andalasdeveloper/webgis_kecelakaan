<?php include 'template/base.php' ?>
<?php startblock('title') ?>DASHBOARD<?php endblock() ?>
<?php startblock('css') ?>
  <style type="text/css">
    #legend {
      background:white;
      padding: 10px;
      margin: 5px;
      font-size: 12px;
      font-color: blue;
      font-family: Arial, sans-serif;
      opacity: 2.5;
    }
    .color {
      border: 1px solid;
      height: 12px;
      width: 12px;
      margin-right: 3px;
      float: left;
    }
    .a { background: #f58d6f; }
    .b { background: #f58d6f; }
    .c { background: #fce8b7; }
    .d { background: #ec87ec; }
    .e { background: #42cb6f; }
    .f { background: #5c9ded; }
    .g { background: #373435; }
    .h { background: #d51e5a; }
    .i { background: #9398ec; }
    .j { background: #f9695d; }
    .k { bckground: #ec87bf; }
    .l { background: navy; }
  </style>
<?php endblock() ?>
<?php startblock('body') ?>
<div class="row mt">
  <div class="col-sm-8" id="hide2">
    <section class="panel">
      <header class="panel-heading">
        <label style="color: black">Google Map with Location List</label>
        <a class="btn btn-default" role="button" data-toggle="collapse" onclick="aktifkanGeolocation()" title="Current Position"><i class="fa fa-map-marker" style="color:black;"></i></a>
        <a class="btn btn-default" role="button" data-toggle="collapse" onclick="manualLocation()" title=" Manual Position"><i class="fa fa-location-arrow" style="color:black;"></i></a>
        <a class="btn btn-default" role="button" data-toggle="collapse" href="#terdekat" title="Nearby" aria-controls="terdekat"><i class="fa fa-road" style="color:black;"></i></a>
        <label id="tombol"><a class="btn btn-default" role="button" id="showlegenda" data-toggle="collapse" onclick="legenda()" title="Legend"   ><i class="fa fa-eye" style="color:black;"></i></a></label>
        <label></label>         
        <div class="collapse" id="terdekat">
          <div class="well">
            <label><b>Radius&nbsp</b></label><label style="color:black" id="km"><b>0</b></label>&nbsp<label><b>m</b></label><br>
            <input  type="range" onclick="cek();aktifkanRadius();resultt()" id="inputradiusmes" name="inputradiusmes" data-highlight="true" min="1" max="20" value="1" >
          </div>
        </div>
      </header>
      <div class="panel-body">
        <div id="map" style="width:100%;height:400px; z-index:60"></div>
      </div>
    </section>
  </div>
  
  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="result">
    <section class="panel">
      <div class="panel-body">
        <h3>Result s</h3>
          <div class="box-body" style="max-height:400px;overflow:auto;">
            <div class="form-group" id="hasilcari1" style="display:none;">
              <table class="table table-bordered" id='hasilcari'></table>
          </div>                   
        </div>
      </div>
    </section>
  </div>

 

  <div class="col-sm-8" style="display:none;" id="infoo">
    <section class="panel">
      <div class="panel-body">
        <a class="btn btn-compose">Information</a>
        <div class="box-body" style="max-height:350px;overflow:auto;">
          <div class="form-group">
            <table class="table" id='info'>
              <tbody  style='vertical-align:top;'>
              </tbody> 
            </table>
          </div> 
        </div>
      </div>
    </section>
  </div>

  <div class="col-sm-8" style="display:none;" id="infoev">
    <section class="panel">
      <div class="panel-body">
        <a class="btn btn-compose">Information of Event</a>
        <div class="box-body" style="max-height:350px;overflow:auto;">
          <div class="form-group">
            <table class="table" id='infoevent'>
              <tbody  style='vertical-align:top;'>
              </tbody> 
            </table>          
          </div> 
        </div>
      </div>
    </section>
  </div>

  <div class="col-sm-8" style="display:none;" id="infoo1">
    <section class="panel">
      <div class="panel-body">
        <a class="btn btn-compose">Route Public Transportation</a>
        <div class="box-body" style="max-height:350px;overflow:auto;">
          <div class="form-group">
            <table class="table table-bordered" id='infoak'>
            </table>            
          </div>       
        </div>
      </div>
    </section>
  </div>
     
  <div class="col-sm-4" style="display:none;" id="resultaround">
    <section class="panel">
      <div class="panel-body">
        <a class="btn btn-compose">Attraction Around</a>
        <div class="box-body" style="max-height:400px;overflow:auto;">
          <div class="form-group" id="hasilcari2" style="display:none;">
            <table class="table table-bordered" id='hasilcariaround'>
            </table>  
          </div>                   
        </div>
      </div>
    </section>
  </div>

  <div class="col-sm-8" style="display:none;" id="att1">  
    <section class="panel">
      <div class="panel-body" >
        <a class="btn btn-compose">Attraction Around Mosque</a>
        <div class="box-body" style="max-height:350px;overflow:auto;">
          <div class="form-group">
            <table class="table table-bordered" id='info1'>
            </table>   
          </div>                  
        </div>
      </div>
    </section>
  </div>
    
  <div class="col-sm-4" style="display:none;" id="att2">
    <section class="panel">
      <div class="panel-body">
        <a class="btn btn-compose">Route</a>
      </div>
      <div id="rute" class='box-body'></div>
    </section>
  </div>
</div>
<?php endblock() ?>