<?php include 'template/base.php' ?>
<?php startblock('title') ?>DASHBOARD<?php endblock() ?>
<?php startblock('body') ?>
  <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 main-chart">  -->         
  <div class="row mt">
    <div class="col-md-8 col-sm-8 col-lg-8 col-xs-8 mb" id="hide2">
      <section class="panel">
        <header class="panel-heading">
          <label style="color: black">Google Map with Location List  </label>
          <a class="btn btn-default" role="button" data-toggle="collapse" onclick="aktifkanGeolocation()" title="Current Position"><i class="fa fa-map-marker" style="color:black;"></i></a>
          <a class="btn btn-default" role="button" data-toggle="collapse" onclick="manualLocation()" title=" Manual Position"><i class="fa fa-location-arrow" style="color:black;"></i></a>
          <a class="btn btn-default" role="button" data-toggle="collapse" href="#terdekat" title="Nearby" aria-controls="terdekat"><i class="fa fa-road" style="color:black;"></i></a>
          <a class="btn btn-default" role="button" data-toggle="collapse" onclick="tampilsemua();resultt()" title="All Mosque" aria-controls="terdekat"><i class="fa fa-map-marker" style="color:black;"></i></a>
          <label id="tombol"><a class="btn btn-default" role="button" id="showlegenda" data-toggle="collapse" onclick="legenda()" title="Legend"><i class="fa fa-eye" style="color:black;"></i></a></label>
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
                        
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ds" id="result">
      <!--COMPLETED ACTIONS DONUTS CHART-->
      <section class="panel">
        <div class="panel-body">
          <a class="btn btn-compose">Result</a>
            <div class="box-body" style="max-height:400px;overflow:auto;">
              <div class="form-group" id="hasilcari1" style="display:none;">
                <table class="table table-bordered" id='hasilcari'>
              </table>  
            </div>                   
          </div>
        </div>
      </section>
    </div>

    <div class="col-sm-4" style="display:none;" id="eventt">
      <section class="panel">
        <div class="panel-body">
          <a class="btn btn-compose">Event</a>
          <div class="box-body" style="max-height:350px;overflow:auto;">
            <div class="form-group" id="hasilcari1">
              <table id="example1" class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Event Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include ("/ta_pariwisata/action/connect.php");
                    $sql = pg_query("SELECT * FROM event order by id asc");
                    while($data =  pg_fetch_array($sql)){
                      $id = $data['id'];
                      $name = $data['name'];
                  ?>
                  <tr>
                    <td><?php echo "$id"; ?></td>
                    <td><?php echo "$name"; ?></td>
                    </div>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table> 
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

    <!-- Info Event -->
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

  <div class="row mt" style="display:none;" id="showlist">  
    <?php 
    include '/ta_pariwisata/action/connect.php';
    $sql = pg_query("SELECT * FROM worship_place");
    ?>
    <?php
    $jml_kolom=3;
    $cnt = 1;
    while($data =  pg_fetch_assoc($sql)){
      if ($cnt >= $jml_kolom) {
        echo "<div class='row mt mb'>";
      }
      ?>
    <div class="row-mt">
      <div class="col-lg-4 col-md-4 col-sm-8 col-xs-6 desc">
        <div class="project-wrapper">
          <div class="project">
            <div class="photo-wrapper">
              <div class="photo">
                <a class="fancybox" href="foto/<?php echo $data['image']; ?>"><img class="img-responsive" src="foto/<?php echo $data['image']; ?>" alt=""></a>
              </div>
              <div class="overlay"></div>
              <p style="color: #f3fff4"><?php echo $data['name']; ?><br><?php echo $data['address']; ?></p>
            </div>
          </div>
        </div>
        <?php
        if ($cnt >= $jml_kolom){
          $cnt = 0;
          echo "</div>";
        }
        $cnt++;
      }
      ?>
      </div>
    </div>
  </div>

<?php endblock() ?>