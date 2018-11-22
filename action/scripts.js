var pos ='null';
var circles=[];
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

function kecelakaan() //tampil digitasi spa
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
  masjidradius();
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
}

function tampilsemua(){ //menampilkan semua masjid
  $.ajax({ url: server+'data/carikecelakaan.php', data: "", dataType: 'json', success: function (rows){
    cari_kecelakaan(rows);
  }});
}

function cari_kecelakaan(rows){ 
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
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

function detailmes_infow(id){  //menampilkan informasi masjid
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  $.ajax({ 
    url: server+'data/detailmasjid1.php?cari='+id, data: "", dataType: 'json', success: function(rows){
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

function clearangkot(){
  //for (var i = 0; i < angkot.length; i++) {
  for (i in angkot){
    angkot[i].setMap(null);
  }
  angkot=[];
}

function detailkecelakaan(id1){  //menampilkan informasi kecelakaan
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  clearangkot();
  console.log("FUNGSI DETAIL Kecelakaan => id : "+ id1);
  $.ajax({ 
    url: server+'data/detailkecelakaan.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log("data ditemukan");
      for (var i in rows) {
        // console.log('dd');
        var row = rows[i];
        var id = row.id_kecelakaan;
        var nama = row.total_kerugian;
        var alamat=row.keterangan_lokasi;
        var diskon = row.diskon;
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
        console.log(fotosrc+image);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 

        $('#info').append("<tr><td><b>No Laporan</b></td><td>:</td><td> "+id1+"</td></tr><tr><td><b>Keterangan Lokasi </b></td><td>:</td><td> "+alamat+"</td></tr><tr><td><b>total_kerugian</b></td><td>:</td><td> "+nama+" </sup></td></tr><tr><td><a class='btn btn-default' role=button' data-toggle='collapse' href='#terdekat1' onclick='tampil_sekitar(\""+latitude+"\",\""+longitude+"\",\""+nama+"\")' title='Nearby' aria-controls='Nearby'><i class='fa fa-compass' style='color:black;''></i><label>&nbsp Attraction Nearby</label></a><div class='collapse' id='terdekat1'><div class='well' style='width: 150%'><div class='checkbox'><label><input id='check_t' type='checkbox'>Rumah Sakit</label></div><div class='checkbox'><label><input id='check_i' type='checkbox'>Pos Polisi</label></div><label><b>Radius&nbsp</b></label><label style='color:black' id='km1'><b>0</b></label>&nbsp<label><b>m</b></label><br><input type='range' onchange='cek1();aktifkanRadiusSekitar();resultt1();info1();' id='inputradius1' name='inputradius1' data-highlight='true' min='1' max='15' value='1' ></div></div></td></tr>")
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' al='image in infowindow' width='150'></center><br><i class='fa fa-home'></i> "+nama+"<br><i class='fa fa-map-marker'></i> "+alamat+"<br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });

        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);

        //Korban Kecelakaan
        var isi="<br><b style='margin-left:20px'>Korban Kecelakaan</b> <br><ol>";
        for (var i in rows.fasilitas){ 
          var row = rows.fasilitas[i];
          var id_fas = row.id_fas;
          var name = row.name;
          console.log(name);
          isi = isi+"<li>"+name+"</li>";
        }//end for
        isi = isi + "</ol>";
        $('#info').append(isi);

        //Kendaraan
        var isi="<b style='margin-left:20px'>Kendaraan</b> <br><ol>";
        for (var i in rows.keg){ 
          var row = rows.keg[i];
          var event_name = row.event_name;
          var date = row.date;
          var time = row.time;
          console.log(event_name);
          isi = isi+"<li><b>Event Name</b><b>:</b> &nbsp "+event_name+"<br><b>Date</b><b>:</b> &nbsp"+date+"<br><b>Time</b><b>:</b> &nbsp"+time+"</li>";
        }//end for
        isi = isi + "</ol>";
        $('#info').append(isi);

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

function aktifkanRadiusSekitar(){
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
  if (document.getElementById('check_i').checked) {
    industrisekitar(rad_lat,rad_lng,rad);
  }
  if (document.getElementById('check_oo').checked) {
    oleholehsekitar(rad_lat,rad_lng,rad);
  }
  if (document.getElementById('check_k').checked) {
    kulinersekitar(rad_lat,rad_lng,rad);
  }  
  if (document.getElementById('check_r').checked) {
    restaurantsekitar(rad_lat,rad_lng,rad);
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

function owsekitar(latitude,longitude,rad){ // OW SEKITAR MASJID
  $('#hasilcari2').show();
  $('#hasilcariaround').empty();
  cekRadius1();
  console.log(server+'data/cariow.php?lat='+latitude+'&long='+longitude+'&rad='+rad)
  $.ajax({
    url: server+'data/cariow.php?lat='+latitude+'&long='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){
      for (var i in rows){ 
        var row = rows[i];
        var id = row.id;
        var nama = row.name;
        var lokasi = row.address;
        var jam_buka = row.open;
        var jam_tutup = row.close;
        var fasilitas = row.ticket;
        var keterangan = row.id_type;
        var lat = row.latitude;
        var lon = row.longitude;
        console.log(name);
        centerBaru = new google.maps.LatLng(lat, lon);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/Basisdatalanjut/assets/ico/marker_tw.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id);
        console.log(lat);
        console.log(lon);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        klikInfoWindow_ow(id);
        map.setZoom(14); 
        $('#hasilcariaround').append("<tr><td>"+nama+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailow(\""+id+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotwisata(\""+id+"\",\""+lat+"\",\""+lon+"\");info12();'></a></td><td><a role='button' title='Route from mosque' class='btn btn-default fa fa-male' value='Route' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'></a></td></tr>");
      }//end for
    }
  });//end ajax  
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

function detailik(id1){  //menampilkan Information 
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  $.ajax({ 
    url: server+'data/detailik.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log(id1);
      for (var i in rows) { 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var cp=row.cp;
        var owner=row.owner;
        var employee=row.employee;
        var capacity=row.capacity;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/Basisdatalanjut/assets/ico/industries.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+name+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+address+"</td></tr><tr><td><b>Contact Person</b></td><td>:</td><td>"+cp+"</td></tr><tr><td><b>Owner</b></td><td>:</td><td> "+owner+"</td></tr><tr><td><b>Employee</b></td><td>:</td><td> "+employee+"</td></tr>")
        // <a class='btn btn-default fa fa-compass' title='Attraction Nearby' onclick='owsekitar("+latitude+","+longitude+",200);ow();owtampil();'></a></td></tr> ");
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }  
    }
  }); 
}



