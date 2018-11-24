var pos ='null';
var circles=[];
var koordinat = 'null';
var server = "http://localhost/Basisdatalanjut/";
var markers = [];
var markersDua = [];
var infoDua = [];
var directionsDisplay;
var rute = [];  //NAVIGASI
var angkot = [];
var centerBaru;
var fotosrc = server+'data/foto/';
var pos ='null';
var jalurAngkot=[];
var centerLokasi; //untuk fungsi CallRoute()


window.onload = function() {
  basemap();
  kecelakaan();
  //kecamatanTampil();
};

function kecelakaan() //tampil digitasi 
{
    kecelakaan = new google.maps.Data();
    kecelakaan.loadGeoJson(server+'data/kecelakaan.php');
    kecelakaan.setStyle(function(feature){
        return({
            fillColor: '#42cb6f',
            strokeColor: '#42cb6f',
            strokeWeight: 1,
            fillOpacity: 7
        });
    });
    kecelakaan.setMap(map);
}


function basemap(){
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: new google.maps.LatLng(-0.940891,100.4035583),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  });
}

function aktifkanRadius(){ //fungsi radius
  if (pos == 'null'){
    alert ('Click button current position or manual position first !');
  }
  else {
    hapusRadius();
    var inputradiusmes=document.getElementById("inputradiusmes").value;
    console.log(inputradiusmes);
    var circle = new google.maps.Circle({
      center: pos,
      radius: parseFloat(inputradiusmes*100),      
      map: map,
      strokeColor: "blue",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "blue",
      fillOpacity: 0.35
    });        
    map.setZoom(14);       
    map.setCenter(pos);
    circles.push(circle);     
  }   
  cekRadiusStatus = 'on';
  kecelakaanradius();
}

function cekRadius(){
  rad = inputradiusmes.value*100;
  console.log(rad);
}



function hapusRadius(){
  for(var i=0;i<circles.length;i++){
    circles[i].setMap(null);
  }
  circles=[];
  cekRadiusStatus = 'off';
}

// function kecamatanTampil(){
//   kecamatan = new google.maps.Data();
//   kecamatan.loadGeoJson(server+'data/kecamatan.php');
//   kecamatan.setStyle(function(feature){
//     var gid = feature.getProperty('id');
//     if (gid == 'K001'){
//       color = '#ff3300' 
//       return({
//         fillColor:color,
//         strokeWeight:2.0,
//         strokeColor:'black',
//         fillOpacity:0.3,
//         clickable: false
//       }); 
//     }
//     else if(gid == 'K002'){ color = '#ffd777' 
//       return({
//       fillColor:color,
//         strokeWeight:2.0,
//         strokeColor:'black',
//         fillOpacity:0.3,
//         clickable: false
//       });
//     }
//     else if(gid == 'K003'){ color = '#ec87ec' 
//       return({
//       fillColor:color,
//         strokeWeight:2.0,
//         strokeColor:'black',
//         fillOpacity:0.3,
//         clickable: false
//       });
//     }         
//   });
//   kecamatan.setMap(map);
// }

function cek(){
 document.getElementById('km').innerHTML=document.getElementById('inputradiusmes').value*100
}


function aktifkanGeolocation(){ //posisi saat ini
  navigator.geolocation.getCurrentPosition(function(position) {
    hapusMarkerInfowindow();
    hapusInfo();
    pos = {
      lat: position.coords.latitude,
      lng: position.coords.longitude
    };

    console.log("longitude : " + pos.lng);
    console.log("latitude : " + pos.lat);
    marker = new google.maps.Marker({
      position: pos,
      map: map,
      animation: google.maps.Animation.DROP,
    });

    centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);
    markers.push(marker);
    infowindow = new google.maps.InfoWindow({
      position: pos,
      content: "<a style='color:black;'>You Are Here</a> "
    });

    infowindow.open(map, marker);
    map.setCenter(pos);
  });   
}

function hapusMarkerInfowindow(){
 setMapOnAll(null);
 hapusMarkerTerdekat();
 pos = 'null';
}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

function hapusMarkerTerdekat() {
  for (var i = 0; i < markersDua.length; i++) {
    markersDua[i].setMap(null);
  }
}

function hapusInfo() {
  for (var i = 0; i < infoDua.length; i++) {
    infoDua[i].setMap(null);
  }
}

function hapusInfo() {
  for (var i = 0; i < infoDua.length; i++) {
    infoDua[i].setMap(null);
  }
}

function manualLocation(){ //posisi manual
  hapusRadius();
  alert('Click the map');
  map.addListener('click', function(event){
    addMarker(event.latLng);
    

  });
}

function addMarker(location){
  hapusposisi();
  marker = new google.maps.Marker({
    position : location,
    map: map,
    animation: google.maps.Animation.DROP,
    });
  pos = {
    lat: location.lat(), lng: location.lng()
  }
  centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);
  markers.push(marker);
  infowindow = new google.maps.InfoWindow();
  infowindow.setContent('Current Position');
  infowindow.open(map, marker);
  usegeolocation=true;
  google.maps.event.clearListeners(map, 'click');
  console.log(pos);
}

function hapusposisi(){
  for (var i = 0; i < markers.length; i++){
    markers[i].setMap(null);
  }
  markers = [];
}

function resultt(){
  $("#result").show();
  $("#resultaround").hide();
  $("#eventt").hide();
  $("#infoo").hide();
  $("#att1").hide();
  $("#hide2").show();
  $("#showlist").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#att2").hide();
  $("#infoev").hide(); 
  $('#info').empty();
  $('#infocieklai').empty();
  $('#infocieklai1').empty();
}

function tampilsemua(){ //menampilkan semua 
  $.ajax({ url: server+'data/carikecelakaan.php', data: "", dataType: 'json', success: function (rows){
    cari_kecelakaan(rows);
  }});
}

function kecelakaan_mobil(){ //menampilkan 
  $.ajax({ url: server+'data/kecelakaan_mobil.php', data: "", dataType: 'json', success: function (rows){
    cari_kecelakaan(rows);
  }});
}

function kecelakaan_motor(){ //menampilkan 
  $.ajax({ url: server+'data/find_kecelakaan.php', data: "", dataType: 'json', success: function (rows){
    cari_kecelakaan(rows);
  }});
}

function find_korban(){  
  if(nama_korban=='')
  {
    alert("Isi kolom pencarian terlebih dahulu !");
  }
  else
  {
    $('#hasilcari').append("<thead><th>Name</th><th colspan='3'>Action</th></thead>");
    var nama_korban = document.getElementById('nama_korban').value;

    $.ajax
    ({ 
      url: server+'data/find_korban.php?cari_nama='+nama_korban, data: "", dataType: 'json', success: function(rows)
      { 
        if(rows==null)
        {
          alert('Data Did Not Exist !');
        }
        for (var i in rows)
        {   
          var row     = rows[i];
          var id  = row.id;
          console.log(id);
         // $('#hasilcari').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-success' onclick='detculi(\""+id+"\");detailinfokul(\""+id+"\");'>Show</a></td><td><a role='button' class='btn btn-danger fa fa-taxi' onclick='kulAngkot(\""+id+"\")'></a></td></tr>");
        }   
        detailmes_infow(id);
        //$('#hasilpencarian').append("<h5 class='box-title' id='hasilpencarian'>Result :</h5>"+rows.length);
      }

    }); 
  }
}

function cari_kecelakaan(rows){ 
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  clearroute();
 
  hapusRadius();
  hapusMarkerTerdekat();
  if(rows==null){
    alert('Kecelakaan not found');
  }
  for (var i in rows) 
  {
    var row = rows[i];
    var id = row.id_kecelakaan;
    var no_laporan = row.id_kecelakaan;
    var latitude = row.latitude ;
    var longitude = row.longitude ;
    centerBaru = new google.maps.LatLng(latitude, longitude);
    marker = new google.maps.Marker({
      position: centerBaru,
      icon:'/Basisdatalanjut/assets/ico/massage-therapy.png',
      map: map,
      animation: google.maps.Animation.DROP,
    });
    // console.log(id);
    // console.log(latitude);
    // console.log(longitude);
    markersDua.push(marker);
    map.setCenter(centerBaru);
    klikInfoWindow(id);
    map.setZoom(14);
    $('#hasilcari').append("<tr>"+
      "<td>"+no_laporan+"</td>"+
      "<td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailkecelakaan(\""+id+"\");info1();'></a></td>"+
     "</tr>");
  }
}

function klikInfoWindow(id){
  google.maps.event.addListener(marker, "click", function(){
    detailmes_infow(id);     
  });
}

function detailmes_infow(id){  //menampilkan informasi 
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  $.ajax({ 
    url: server+'data/detailkecelakaan1.php?cari='+id, data: "", dataType: 'json', success: function(rows){
      console.log("Fungsi Detil kecelakaan : Ketika Marker diklik");
      console.log("id_kecelakaan : "+id);
      for (var i in rows) {
        console.log('data ditampilkan');
        var row = rows[i];
        var id = row.id_kecelakaan;
        var nama = row.total_kerugian;
        var alamat=row.$address;
        var image = row.image;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/Basisdatalanjut/assets/ico/massage-therapy.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' alt='image in infowindow' width='150'></center><br><i class='fa fa-info'></i> "+id+"<br><i class='fa fa-map-marker'></i> "+alamat+"<br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }  
    }
  }); 
}

function clearroute2(){      
  if(typeof(directionsDisplay) != "undefined" && directionsDisplay.getMap() != undefined){
    directionsDisplay.setMap(null);
    $("#detailrute").remove();
  }     
}

function clearroute(){
  for (i in rute){
    rute[i].setMap(null);
  } 
  rute=[]; 
}



//Fungsi Aktifkan Radius
function aktifkanRadiuss()
{
  if (pos == 'null')
  {
    alert ('Click the Button of Your Position Beforehand');
  }
  else 
  {
    hapusRadius();
    var inputradiuss=document.getElementById("inputradiuss").value;
    var circle = new google.maps.Circle
    ({
      center: pos,
      radius: parseFloat(inputradiuss*100),      
      map: map,
      strokeColor: "blue",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "blue",
      fillOpacity: 0.35
    });        
    map.setZoom(12);       
    map.setCenter(pos);
    circles.push(circle);     
  }
  cekRadiusStatus = 'on';
  tampilradiuss();
  kecelakaanradius();

}

function cekRadiuss()
{
  rad = inputradiuss.value*100;
}

function tampilradiuss()
{
  //hapusawal1();
  console.log("tampilradiuss")
  cekRadiuss();
  $('#hasilcari').append("<thead><th>Name</th><th colspan='2'>Action</th></thead>");
  $.ajax
  ({ 
    url: server+'data/kecelakaanradius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+rad, data: "", dataType: 'json', success: function(rows)
    { 
      for (var i in rows) 
      {   
        var row     = rows[i];
        var id  = row.id;
        var name   = row.name;
        var latitude  = row.latitude; ;
        var longitude = row.longitude ;
        centerBaru      = new google.maps.LatLng(latitude, longitude);
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker
        ({
          position: centerBaru,
          map: map,
          icon: "assets/img/aaa.png",
        });
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(14);
        console.log(latitude);
        console.log(longitude);
        console.log(rad);
        clickMarker(centerBaru, id);
      //  $('#hasilcari1').append("<tr><td>"+id+"</td><td><a role='button' class='btn btn-success' onclick='detailkecelakaan(\""+id+"\");'>Info</a></td></tr>");     
       }
       
    }

  });   
}

function clickMarker(centerBaru, id)
{
  
  var marker = new google.maps.Marker
    ({
      icon: "assets/ico/aaa.png",
      position: centerBaru,
      map: map
    });
    markersDua.push(marker);
    
    google.maps.event.addListener(marker, "click", function(){
        detailmes_infow(id);
       
      });

}







function detailkecelakaan(id1){  //menampilkan informasi kecelakaan
  $('#info').empty();
  $('#infocieklai').empty();
   $('#infocieklai1').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  console.log("FUNGSI DETAIL Kecelakaan => id : "+ id1);
  $.ajax({ 
    url: server+'data/detailkecelakaan.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      
      console.log(rows.korban);
      
      for (var i in rows.data) {
        // console.log('dd');
        var row = rows.data[i];
        var id = row.id_kecelakaan;
        var nama = row.total_kerugian;
        var alamat=row.keterangan_lokasi;
        var latitude  = row.latitude;
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/Basisdatalanjut/assets/ico/massage-therapy.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
       
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 

        $('#info').append("<tr><td><b>No Laporan</b></td><td>:</td><td> "+id1+"</td></tr><tr><td><b>Keterangan Lokasi </b></td><td>:</td><td> "+alamat+"</td></tr><tr><td><b>total_kerugian</b></td><td>:</td><td> "+nama+" </sup></td></tr><tr><td><a class='btn btn-default' role=button' data-toggle='collapse' href='#terdekat1' onclick='tampil_sekitar(\""+latitude+"\",\""+longitude+"\",\""+nama+"\")' title='Nearby' aria-controls='Nearby'><i class='fa fa-compass' style='color:black;''></i><label>&nbsp Attraction Nearby</label></a><div class='collapse' id='terdekat1'><div class='well' style='width: 150%'><div class='checkbox'><label><input id='check_t' type='checkbox'>Rumah Sakit</label></div><div class='checkbox'><label><input id='check_i' type='checkbox'>Pos Polisi</label></div><label><b>Radius&nbsp</b></label><label style='color:black' id='km1'><b>0</b></label>&nbsp<label><b>m</b></label><br><input type='range' onchange='cek1();aktifkanRadiusSekitar();resultt1();info1();' id='inputradius1' name='inputradius1' data-highlight='true' min='1' max='15' value='1' ></div></div></td></tr>")
        
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
         content: "<span style=color:black><center><b>Information</b><br></center><br><i class='fa fa-home'></i> "+nama+"<br><i class='fa fa-map-marker'></i> "+alamat+"<br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });

        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);

        //Korban Kecelakaan

        // var isi="<br><b style='margin-left:20px'>Korban Kecelakaan</b><br><ol>";
       // var judul_ktp="<br>No Ktp<br>";
       
       $('#infocieklai').append("<thead><th>Nama</th><th>Nomor KTP</th><th>Jenis Kelamin</th><th>Kondisi</th></thead>");
       for (var i in rows.korban){ 
          var row = rows.korban[i];
          var no_ktp = row.no_ktp;
          var nama = row.nama;
          var jenis_k = row.jenis_kelamin;
          var kondisi = row.kondisi;
          console.log(nama);
          // isi = isi+"<tr><td>"+no_ktp+"</td>&nbsp<td>"+nama+"</td><td></td>&nbsp<td>"+kondisi+"</td>&nbsp</tr><br>";
          $('#infocieklai').append("<tr><td>"+nama+"</td><td>"+no_ktp+"</td><td>"+jenis_k+"</td><td>"+kondisi+"</td></tr>");
        }//end for
        $('#infocieklai').append("</tbody>");

         //Kendaraan
       $('#infocieklai1').append("<thead><th>Nomor Polisi</th><th>Nama Pemilik</th><th>Jenis Kendaraan</th><th>Kondisi</th></thead>"); 
        for (var i in rows.kendaraan){ 
          var row = rows.kendaraan[i];
          var no_plat = row.no_plat;
          var nama_pemilik = row.nama_pemilik;
          var jenis_kendaraan = row.jenis_kendaraan;
          var kondisi1 = row.kondisi;
          
          $('#infocieklai1').append("<tr><td>"+no_plat+"</td><td>"+nama_pemilik+"</td><td>"+jenis_kendaraan+"</td><td>"+kondisi1+"</td></tr>");
        }//end for
      
        $('#infocieklai1').append("</tbody>");

      }
    }
  }); 
}

function info1(){
  $("#infoo").show();
  $("#att2").hide();
  $("#radiuss").hide()
  $("#infoo1").hide();;  
  $("#infoev").hide();   
}

function cek1(){
  document.getElementById('km1').innerHTML=document.getElementById('inputradius1').value*100
}

function resultt1(){
  $("#result").show();
  $("#resultaround").show();
  $("#eventt").hide();
  $("#infoo").hide();
  $("#att1").hide();
  $("#hide2").show();
  $("#showlist").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#att2").hide();
  $("#infoev").hide(); 
}

function info1(){
  $("#infoo").show();
  $("#att2").hide();
  $("#radiuss").hide()
  $("#infoo1").hide();; 
  $("#infoev").hide();   
}

function aktifkanRadiussekitar(){
  console.log("FUNGSI aktifkanRadiusSekitar()");
  hapusRadius();
  hapusMarkerTerdekat();
  var pos = new google.maps.LatLng(rad_lat, rad_lng);
  map.setCenter(pos);
  map.setZoom(16);   
  console.log(pos);
  console.log(rad_lat);
  console.log(rad_lng);
  var inputradius1 = document.getElementById('inputradius1').value;
  var a=document.getElementById('check_h').value;
  console.log(inputradius1);
  var rad = parseFloat(inputradius1*100);
  var circle = new google.maps.Circle({
    center: pos,
    radius: rad,      
    map: map,
    strokeColor: "blue",
    strokeOpacity: 0.5,
    strokeWeight: 1,
    fillColor: "blue",
    fillOpacity: 0.35
  });        
  circles.push(circle); 
  console.log("FUNGSI aktifkanRadiusSekitar()");

  if (document.getElementById('check_t').checked) {
    owsekitar(rad_lat,rad_lng,rad);
  } 
  if (document.getElementById('check_h').checked) {
    hotelsekitar(rad_lat,rad_lng,rad);
  }
 
}

function galeri(a){
  console.log(a);
  window.open(server+'gallery.php?idgallery='+a);    
}

function info12(){
  $("#infoo1").show();
  $("#radiuss").hide();
  $("#infoo").hide();
  $("#att2").hide();
  $("#infoev").hide();   
}



function route_sekitar(lat1,lng1,lat,lng) {
  var start = new google.maps.LatLng(lat1, lng1);
  var end = new google.maps.LatLng(lat, lng);
  if(directionsDisplay){
    clearroute();  
    hapusInfo();
  }
  directionsService = new google.maps.DirectionsService();
  var request = {
    origin:start,
    destination:end,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC,
    provideRouteAlternatives: true
  };

  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
  
  directionsDisplay = new google.maps.DirectionsRenderer({
    draggable: false,
    polylineOptions: {
      strokeColor: "darkorange"
    }
  });

  directionsDisplay.setMap(map);
  rute.push(directionsDisplay);          
}

function cekRadius1(){
  rad = inputradius1.value*100;
  console.log(rad);
}

var rad_lat=0;
var rad_lng=0;
function tampil_sekitar(latitude,longitude,nama){
  rad_lat = latitude;
  rad_lng = longitude;
  console.log(rad_lat);
  console.log(rad_lng);
  document.getElementById("inputradius1").style.display = "inline";

  // POSISI MARKER
  centerBaru = new google.maps.LatLng(latitude, longitude);
  var marker = new google.maps.Marker({map: map, position: centerBaru, 
  icon:'/Basisdatalanjut/assets/ico/massage-therapy.png',
  animation: google.maps.Animation.DROP,
  clickable: true});                       
}



function callRoute(start, end) {
  if (pos == 'null' || typeof(pos) == "undefined"){
    alert ('Please click button current position or button manual position first');
  }
  else{
    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;
         
    directionsService.route({
      origin: start,
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING
    }, 
    function(response, status) {
      if (status === google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      } 
      else {
        window.alert('Directions request failed due to ' + status);
      }
    });
    directionsDisplay.setMap(map);
    map.setZoom(16);
    $('#rute').append("<div class='box-body' style='max-height:350px;overflow:auto;'><div class='form-group' id='detailrute'></div></div></div>");
    directionsDisplay.setPanel(document.getElementById('detailrute'));
  }
}


function rutetampil(){
  $("#att2").show();
  $("#att1").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#infoev").hide();
  $("#infoo").show();
  $('#detailrute').html('');
}



function hideLegenda() {
  $('#legend').remove();
  $('#tombol').empty();
  $('#tombol').append('<a class="btn btn-default" role="button" id="showlegenda" data-toggle="tooltip" onclick="legenda()" title="Legend"><i class="fa fa-eye" style="color:black;"></i></a>');
}

function kecelakaanradius(){ //menampilkan kecelakaan berdasarkan radius
   
    $('#hasilcari1').show();
    $('#hasilcari').empty();
      hapusInfo();
      clearroute2();
    clearroute();
      hapusMarkerTerdekat();
      cekRadius();
    console.log(pos.lat);
      console.log(pos.lng);

        $.ajax({ 
        url: server+'data/kecelakaanradius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+rad, data: "", dataType: 'json', success: function(rows)
        {
            console.log("hy");
            for (var i in rows) 
            {   
              var row     = rows[i];
              var id   = row.id;
              var nama   = row.name;
              var latitude  = row.latitude ;
              var longitude = row.longitude ;
              centerBaru = new google.maps.LatLng(latitude, longitude);
              marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'assets/ico/aaa.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              console.log(latitude);
              console.log(longitude);
              markersDua.push(marker);
              map.setCenter(centerBaru);
        klikInfoWindow(id);
              map.setZoom(14);
              $('#hasilcari').append("<tr><td>"+nama+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailkecelakaan(\""+id+"\");info1();'></a></td></tr>");
            } 
            }    
          });
}
  



