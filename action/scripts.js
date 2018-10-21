var pos ='null';
var circles=[];
var server = "http://localhost/ta_pariwisata/";
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
  kecamatanTampil();
};

function basemap(){
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: new google.maps.LatLng(-0.304820, 100.381421),
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

function masjidradius(){ //menampilkan spa berdasarkan radius
  console.log("fungsi radius");
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  cekRadius();
  console.log(pos.lat);
  console.log(pos.lng);
    console.log(rad);

  $.ajax({ 
    url: server+'data/masjidradius.php?lat='+pos.lat+'&lng='+pos.lng+'&rad='+rad, data: "", dataType: 'json', success: function(rows){
      console.log("data ditemukan");
      for (var i in rows){
        var row = rows[i];
        var id = row.id;
        var nama = row.name;
        var latitude = row.latitude;
        var longitude = row.longitude;
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/massage-therapy.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        klikInfoWindow(id);
        map.setZoom(14);
        $('#hasilcari').append("<tr><td>"+nama+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailmasjid(\""+id+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotmesjid(\""+id+"\",\""+latitude+"\",\""+longitude+"\");info12();'></a></td></tr>");
      } 
    }    
  });
}

function hapusRadius(){
  for(var i=0;i<circles.length;i++){
    circles[i].setMap(null);
  }
  circles=[];
  cekRadiusStatus = 'off';
}

function kecamatanTampil(){
  kecamatan = new google.maps.Data();
  kecamatan.loadGeoJson(server+'data/kecamatan.php');
  kecamatan.setStyle(function(feature){
    var gid = feature.getProperty('id');
    if (gid == 'K001'){
      color = '#ff3300' 
      return({
        fillColor:color,
        strokeWeight:2.0,
        strokeColor:'black',
        fillOpacity:0.3,
        clickable: false
      }); 
    }
    else if(gid == 'K002'){ color = '#ffd777' 
      return({
      fillColor:color,
        strokeWeight:2.0,
        strokeColor:'black',
        fillOpacity:0.3,
        clickable: false
      });
    }
    else if(gid == 'K003'){ color = '#ec87ec' 
      return({
      fillColor:color,
        strokeWeight:2.0,
        strokeColor:'black',
        fillOpacity:0.3,
        clickable: false
      });
    }         
  });
  kecamatan.setMap(map);
}

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
  $.ajax({ url: server+'data/carimasjid.php', data: "", dataType: 'json', success: function (rows){
    cari_masjid(rows);
  }});
}

function cari_masjid(rows){ //fungsi cari mesjid berdasarkan nama
  $('#hasilcari1').show();
  $('#hasilcari').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusRadius();
  hapusMarkerTerdekat();
  if(rows==null){
    alert('Mosque Not found');
  }
  for (var i in rows) 
  {
    var row = rows[i];
    var id = row.id;
    var nama = row.name;
    var latitude = row.latitude ;
    var longitude = row.longitude ;
    centerBaru = new google.maps.LatLng(latitude, longitude);
    marker = new google.maps.Marker({
      position: centerBaru,
      icon:'/ta_pariwisata/assets/ico/massage-therapy.png',
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
      "<td>"+nama+"</td>"+
      "<td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailmasjid(\""+id+"\");info1();'></a></td>"+
      "<td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotmesjid(\""+id+"\",\""+latitude+"\",\""+longitude+"\");info12();'></a></td>"+
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
      console.log("Fungsi Detil Spa : Ketika Marker diklik");
      console.log("id : "+id);
      for (var i in rows) {
        console.log('data ditampilkan');
        var row = rows[i];
        var id = row.id;
        var nama = row.spa_name;
        var alamat=row.$address;
        var image = row.image;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/massage-therapy.png',
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
          content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' alt='image in infowindow' width='150'></center><br><i class='fa fa-home'></i> "+nama+"<br><i class='fa fa-map-marker'></i> "+alamat+"<br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
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

function detailmasjid(id1){  //menampilkan informasi masjid
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  clearangkot();
  console.log("FUNGSI DETAIL MASJID => id : "+ id1);
  $.ajax({ 
    url: server+'data/detailmasjid.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log("data ditemukan");
      for (var i in rows) {
        // console.log('dd');
        var row = rows[i];
        var id = row.id;
        var nama = row.name;
        var alamat=row.address;
        var diskon = row.diskon;
        var image = row.image;
        var latitude  = row.latitude;
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/massage-therapy.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        console.log(fotosrc+image);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+nama+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+alamat+"</td></tr><tr><td><b>Diskon</b></td><td>:</td><td> "+diskon+" %</sup></td></tr><tr><td><a class='btn btn-default' role=button' data-toggle='collapse' href='#terdekat1' onclick='tampil_sekitar(\""+latitude+"\",\""+longitude+"\",\""+nama+"\")' title='Nearby' aria-controls='Nearby'><i class='fa fa-compass' style='color:black;''></i><label>&nbsp Attraction Nearby</label></a><div class='collapse' id='terdekat1'><div class='well' style='width: 150%'><div class='checkbox'><label><input id='check_t' type='checkbox'>Tourism</label></div><div class='checkbox'><label><input id='check_i' type='checkbox'>Small Industry</label></div><div class='checkbox'><label><input id='check_oo' type='checkbox' value=''>Souvenir</label></div><div class='checkbox'><label><input id='check_k' type='checkbox' value=''>Culinary</label></div><div class='checkbox'><label><input id='check_h' type='checkbox' value='5'>Hotel</label></div><div class='checkbox'><label><input id='check_r' type='checkbox' value=''>Restaurant</label></div><label><b>Radius&nbsp</b></label><label style='color:black' id='km1'><b>0</b></label>&nbsp<label><b>m</b></label><br><input type='range' onchange='cek1();aktifkanRadiusSekitar();resultt1();info1();' id='inputradius1' name='inputradius1' data-highlight='true' min='1' max='15' value='1' ></div></div></td></tr>")
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br><img src='"+fotosrc+image+"' al='image in infowindow' width='150'></center><br><i class='fa fa-home'></i> "+nama+"<br><i class='fa fa-map-marker'></i> "+alamat+"<br><a role='button' title='tracking' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
        //FASILITAS MASJID
        var isi="<br><b style='margin-left:20px'>Facility</b> <br><ol>";
        for (var i in rows.fasilitas){ 
          var row = rows.fasilitas[i];
          var id_fas = row.id_fas;
          var name = row.name;
          console.log(name);
          isi = isi+"<li>"+name+"</li>";
        }//end for
        isi = isi + "</ol>";
        $('#info').append(isi);
        //KEGIATAN MASJID
        var isi="<b style='margin-left:20px'>Event</b> <br><ol>";
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
          icon:'/ta_pariwisata/assets/ico/marker_tw.png',
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
  icon:'/ta_pariwisata/assets/ico/massage-therapy.png',
  animation: google.maps.Animation.DROP,
  clickable: true});                       
}

function industrisekitar(latitude,longitude,rad){ // INDUSTRI SEKITAR MASJID
  $('#hasilcari2').show();
  $('#hasilcariaround').empty();
  cekRadius1();
  console.log("ini industri");
  $.ajax({url: server+'data/cariindustri.php?lat='+latitude+'&long='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
    console.log("ini juga");
    for (var i in rows){ 
      var row = rows[i];
      var id_industri = row.id;
      var nama_industri = row.name;
      var cp = row.cp;
      var pemilik = row.owner;
      var alamat = row.address;
      var id_status_tempat = row.id_industry_type;
      var jumlah_karyawan = row.employee;
      var lat=row.latitude;
      var lon = row.longitude;
      console.log(name);

      centerBaru = new google.maps.LatLng(lat, lon);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon:'/ta_pariwisata/assets/ico/industries.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      console.log(id_industri);
      console.log(lat);
      console.log(lon);
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindow_industri(id_industri);
      map.setZoom(14);
      $('#hasilcariaround').append("<tr><td>"+nama_industri+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailik(\""+id_industri+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotindustri(\""+id_industri+"\",\""+lat+"\",\""+lon+"\");info12();'></a></td><td><a role='button' title='Route from mosque' class='btn btn-default fa fa-male' value='Route' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'></a></td></tr>");
    }//end for
  }});//end ajax  
}

function klikInfoWindow_ow(id){
  google.maps.event.addListener(marker, "click", function(){
    detailow_infow(id);
  });
}

function hotelsekitar(latitude,longitude,rad){ // HOTEL SEKITAR MASJID
  $('#hasilcari2').show();
  $('#hasilcariaround').empty();
  cekRadius1();
  $.ajax({url: server+'data/carihotel.php?lat='+latitude+'&long='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
    for (var i in rows){ 
      var row = rows[i];
      var id_hotel = row.id;
      var nama = row.name;
      var alamat = row.address;
      var cp = row.cp;
      var ktp = row.ktp;
      var marriage_book = row.marriage_book;
      var mushalla = row.mushalla;
      var star = row.star;
      var id_type = row.id_type;
      var lat=row.latitude;
      var lon = row.longitude;
      console.log(name);
      centerBaru = new google.maps.LatLng(lat, lon);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon:'/ta_pariwisata/assets/ico/marker_hotel.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      console.log(id_hotel);
      console.log(lat);
      console.log(lon);
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindow_hotel(id_hotel);
      map.setZoom(14);
      $('#hasilcariaround').append("<tr><td>"+nama+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailhotel(\""+id_hotel+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkothotel(\""+id_hotel+"\",\""+lat+"\",\""+lon+"\");info12();'></a></td><td><a role='button' title='Route from mosque' class='btn btn-default fa fa-male' value='Route' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'></a></td></tr>");
    }//end for
  }});//end ajax  
}

function detailow_infow(id){  //menampilkan Information ow  
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  $.ajax({ 
    url: server+'data/detailow.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
      console.log(id);
      for (var i in rows){
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name   = row.name;
        var address = row.address;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/marker_tw.png',
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
          content: "<span style=color:black><center><b>Information</b><br></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);            
      }           
    }
  }); 
}

function oleholehsekitar(latitude,longitude,rad){ // SOUVENIR SEKITAR MASJID
  $('#hasilcari2').show();
  $('#hasilcariaround').empty();
  cekRadius1();
  $.ajax({url: server+'data/carioleholeh.php?lat='+latitude+'&long='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
    for (var i in rows){ 
      var row = rows[i];
      var id_oleh_oleh = row.id;
      var nama_oleh_oleh = row.name;
      var cp = row.cp;
      var pemilik = row.owner;
      var alamat = row.address;
      var id_status_tempat = row.id_souvenir_type;
      var jumlah_karyawan = row.employee;
      var lat=row.latitude;
      var lon = row.longitude;
      console.log(nama_oleh_oleh);

      centerBaru = new google.maps.LatLng(lat, lon);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon:'/ta_pariwisata/assets/ico/shopping.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      console.log(id_oleh_oleh);
      console.log(lat);
      console.log(lon);
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindow_oleh(id_oleh_oleh);
      map.setZoom(14);        
      $('#hasilcariaround').append("<tr><td>"+nama_oleh_oleh+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailoleh(\""+id_oleh_oleh+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotsouvenir(\""+id_oleh_oleh+"\",\""+lat+"\",\""+lon+"\");info12();'></a></td><td><a role='button' title='Route from mosque' class='btn btn-default fa fa-male' value='Route' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'></a></td></tr>");
    }//end for
  }});//end ajax 
}

function kulinersekitar(latitude,longitude,rad){ // KULINER SEKITAR MASJID
  $('#hasilcari2').show();
  $('#hasilcariaround').empty();
  cekRadius1();
  $.ajax({url: server+'data/carikuline.php?lat='+latitude+'&long='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
    for (var i in rows){ 
      var row = rows[i];
      var id = row.id;
      var name = row.name;
      var address = row.address;
      var cp = row.cp;
      var capacity = row.capacity;
      var jam_buka = row.open;
      var jam_tutup = row.close;
      var employee = row.employee;
      var lat=row.latitude;
      var lon = row.longitude;
      console.log(name);
      centerBaru = new google.maps.LatLng(lat, lon);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon:'/ta_pariwisata/assets/ico/food.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      console.log(id);
      console.log(lat);
      console.log(lon);
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindow_kuliner(id);
      map.setZoom(14);
      $('#hasilcariaround').append("<tr><td>"+name+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailculinary(\""+id+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotkuliner(\""+id+"\",\""+lat+"\",\""+lon+"\");info12();'></a></td><td><a role='button' title='Route from mosque' class='btn btn-default fa fa-male' value='Route' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'></a></td></tr>");
    }
  }});
}

function restaurantsekitar(latitude,longitude,rad){ // restaurant SEKITAR MASJID
  $('#hasilcari2').show();
  $('#hasilcariaround').empty();
  cekRadius1();
  console.log(server+'data/carirestaurant.php?lat='+latitude+'&long='+longitude+'&rad='+rad)
  $.ajax({url: server+'data/carirestaurant.php?lat='+latitude+'&long='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
    for (var i in rows){ 
      var row = rows[i];
      var id = row.id;
      var nama = row.name;
      var lokasi = row.address;
      var lat = row.latitude;
      var lon = row.longitude;
      console.log(name);
      centerBaru = new google.maps.LatLng(lat, lon);
      marker = new google.maps.Marker({
        position: centerBaru,
        icon:'/ta_pariwisata/assets/ico/restaurants.png',
        map: map,
        animation: google.maps.Animation.DROP,
      });
      console.log(id);
      console.log(lat);
      console.log(lon);
      markersDua.push(marker);
      map.setCenter(centerBaru);
      klikInfoWindow_res(id);
      map.setZoom(14);
      
      $('#hasilcariaround').append("<tr><td>"+nama+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailrestaurant(\""+id+"\");info1();'></a></td><td><a role='button' class='btn btn-default fa fa-car' title='jalur angkot' onclick='angkotrestaurant(\""+id+"\",\""+lat+"\",\""+lon+"\");info12();'></a></td><td><a role='button' title='Route from mosque' class='btn btn-default fa fa-male' value='Route' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'></a></td></tr>");
    }//end for
  }});//end ajax  
}

function detailow(id1){  //menampilkan Information ow
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  $.ajax({ 
    url: server+'data/detailow.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log(id1);
      for (var i in rows) { 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name   = row.name;
        var address = row.address;
        var open = row.open;
        var close = row.close;
        var ticket = row.ticket;
        var fasilitas = row.fasilitas;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/marker_tw.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+name+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+address+"</td></tr><tr><td><b>Open</b></td><td>:</td><td>"+open+"</td></tr><tr><td><b>Close</b></td><td>:</td><td> "+close+"</td></tr><tr><td><b>Price</b></td><td>:</td><td> "+ticket+"</td></tr>")
        // <a class='btn btn-default fa fa-compass' title='Attraction Nearby' onclick='owsekitar("+latitude+","+longitude+",200);ow();owtampil();'></a></td></tr> ");
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }  
    }
  }); 
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

function angkotmesjid(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log("fungsi angkot mesjid : running");
  console.log("id angkot : "+id_angkot);
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Info</th></thead>");
  $.ajax({ 
    url: server+'data/angkotmesjid.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows) {   
        var row = rows[i];
        var id_angkot   = row.id_angkot;
        var jurusan   = row.destination;
        var route_color = row.route_color;
        var latitude  = row.latitude ;
        var longitude = row.longitude ;
        var lat = row.lat;
        var lng = row.lng;
        console.log(latitude);
        console.log(longitude);
        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/massage-therapy.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(13);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
      } 
    }
  });
}

function listgeom(id_angkot){
  hapusInfo();
  $.ajax({ 
    url: server+'data/tampilrute.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows) { 
      arraylatlngangkot=[];
      var count=0;
      for (var i in rows.features[0].geometry.coordinates) { 
        for (var n in rows.features[0].geometry.coordinates[i]){
          var latlng=rows.features[0].geometry.coordinates[i][n];
          // var latlng=rows.features[0].geometry.coordinates[i][n][0];
          count++;
          arraylatlngangkot.push(latlng);
        }
        console.log("a");
      } 
      console.log(count);
      if(count%2==1){
        count++;
      }
      console.log(mid);
      var mid=count/2;
      // arraylatlngangkot[mid];
      var lat=arraylatlngangkot[mid][1];
      var lon=arraylatlngangkot[mid][0];
      var id_angkot=rows.features[0].properties.id;
      var jalur_angkot=rows.features[0].properties.track;
      var jurusan=rows.features[0].properties.destination;
    }
  });
}

function tampilrute(id_angkot, route_color, latitude, longitude){
  console.log("ini rute");
  console.log(route_color);
  ja = new google.maps.Data();
  ja.loadGeoJson(server+'data/tampilrute.php?id_angkot='+id_angkot);
  ja.setStyle(function(features){
    return({
      fillColor : 'yellow',
      strokeColor: route_color,
      strokeWeight : 2,
      fillOpacity : 0.5,
    });
  });
  ja.setMap(map);
  angkot.push(ja);
  map.setZoom(14);
}

function detailangkot(id_angkot, lat, lng, lat1, lng1){  
  clearangkot();
  hapusRadius();
  console.log("D");
  $.ajax({
    url: server+'data/tampilrute.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){
      console.log("Dii");
      for (var i in rows.features){
        console.log("Diii");
        var id_angkot=rows.features[i].properties.id;
        var route_color=rows.features[i].properties.route_color;
        var latitude=rows.features[i].properties.latitude;
        var longitude=rows.features[i].properties.longitude;
        var jalur_angkot=rows.features[i].properties.track;
        var jurusan=rows.features[i].properties.destination;
        console.log(id_angkot);
        tampilrute(id_angkot, route_color,latitude, longitude);
        var centerBaru = new google.maps.LatLng(latitude, longitude);
        map.setCenter(centerBaru);
        var marker = new google.maps.Marker({
          position: centerBaru,
          animation: google.maps.Animation.DROP,              
          // icon:'assets/ico/marker_angkot.png',
          map: map
        });
        var infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<b><u>Information</u></b><br>Route Code: "+id_angkot+"<br>Destination: "+jurusan+"<br>Track: "+jalur_angkot+"",
        });
        infowindow.open(map);
        infoDua.push(infowindow); 
        infowindow.open(map);  
        route_sekitar(lat,lng,lat1,lng1);
      }
      jalurAngkot.push(ja);
    }
  });
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

function resetangkot(){
  $("#eventt").hide();
  $("#infoo").show();
  $("#att1").hide();
  $("#showlist").hide();
  $("#radiuss").hide();
  $("#infoo1").hide();
  $("#infoev").hide();
}

function klikInfoWindow_oleh(id){
  google.maps.event.addListener(marker, "click", function(){
    detailoleh_infow(id);
  });
}

function klikInfoWindow_res(id){
  google.maps.event.addListener(marker, "click", function(){
    detailres_infow(id);
  });
}

function klikInfoWindow_industri(id){
  google.maps.event.addListener(marker, "click", function(){
    detailindustri_infow(id);
  });
}

function klikInfoWindow_hotel(id)
{
  google.maps.event.addListener(marker, "click", function(){
    detailhotel_infow(id);
  });
}

function klikInfoWindow_kuliner(id)
{
  google.maps.event.addListener(marker, "click", function(){
    detailkuliner_infow(id);
  });
}

function angkotwisata(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log(id_angkot);
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Action</th></thead>");
  $.ajax({ 
    url: server+'data/angkotwisata.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows) {   
        var row = rows[i];
        var id_angkot = row.id_angkot;
        var jurusan = row.destination;
        var route_color = row.route_color;
        var latitude = row.latitude;
        var longitude = row.longitude;
        var lat = row.lat;
        var lng = row.lng;
        var description = row.description;
        console.log(latitude);
        console.log(longitude);
        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/hotels.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(14);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
        /* route_sekitar(lat,lng,lat1,lng1); */
      } 
    }
  });  
}

function angkotsouvenir(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log("d");
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Info</th></thead>");
  $.ajax({ 
    url: server+'data/angkotsouvenir.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){             
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows) {   
        var row     = rows[i];
        var id_angkot   = row.id_angkot;
        var jurusan   = row.destination;
        var route_color = row.route_color;
        var latitude  = row.latitude ;
        var longitude = row.longitude ;
        var lat  = row.lat ;
        var lng = row.lng ;

        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/shopping.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(13);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
      } 
    }
  });  
}

function angkotrestaurant(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log("d");
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Action</th></thead>");
  $.ajax({ 
    url: server+'data/angkotrestaurant.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows) {   
        var row     = rows[i];
        var id_angkot   = row.id_angkot;
        var jurusan   = row.destination;
        var route_color = row.route_color;
        var latitude  = row.latitude ;
        var longitude = row.longitude ;
        var lat = row.lat;
        var lng = row.lng;
        var description = row.description;

        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/restaurants.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(14);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
        /* route_sekitar(lat,lng,lat1,lng1); */
      } 
    }
  });
}

function angkothotel(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log("d");
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Action</th></thead>");
  $.ajax({ 
    url: server+'data/angkothotel.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows){
        var row = rows[i];
        var id_angkot   = row.id_angkot;
        var jurusan   = row.destination;
        var route_color = row.route_color;
        var latitude  = row.latitude;
        var longitude = row.longitude;
        var lat = row.lat;
        var lng = row.lng;
        var description = row.description;
        console.log(latitude);
        console.log(longitude);
        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/marker_hotel.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(14);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
        /* route_sekitar(lat,lng,lat1,lng1); */
      } 
    }
  });  
}

function legenda()
{
  $('#tombol').empty();
  $('#tombol').append('<a class="btn btn-default" role="button" id="hidelegenda" data-toggle="tooltip" onclick="hideLegenda()" title="Hide Legend"><i class="fa fa-eye-slash" style="color:black;"></i></a>');
  
  var layer = new google.maps.FusionTablesLayer({
    query: {
      select: 'Location',
      from: '1NIVOZxrr-uoXhpWSQH2YJzY5aWhkRZW0bWhfZw'
    },
    map: map
  });
  var legend = document.createElement('div');
  legend.id = 'legend';
  var content = [];
  content.push('<h4>Legend</h4>');
  content.push('<p><div class="color b"></div>District Mandiangin Koto Selayan</p>');
  content.push('<p><div class="color c"></div>District Guguak Panjang</p>');
  content.push('<p><div class="color d"></div>District Aur Birugo Tigo Baleh</p>');
  content.push('<p><div class="color e"></div>Place of Worship</p>');
  content.push('<p><div class="color f"></div>Tourism</p>');
  content.push('<p><div class="color g"></div>Small Industry</p>');
  content.push('<p><div class="color h"></div>Restaurant</p>');
  content.push('<p><div class="color i"></div>Hotel</p>');
  content.push('<p><div class="color j"></div>Culinary</p>');
  content.push('<p><div class="color k"></div>Souvenir</p>');
  content.push('<p><div class="color l"></div>Route Angkot</p>');
  legend.innerHTML = content.join('');
  legend.index = 1;
  map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
}

function hideLegenda() {
  $('#legend').remove();
  $('#tombol').empty();
  $('#tombol').append('<a class="btn btn-default" role="button" id="showlegenda" data-toggle="tooltip" onclick="legenda()" title="Legend"><i class="fa fa-eye" style="color:black;"></i></a>');
}

function detailik(id1){  //menampilkan Information rm
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
          icon:'/ta_pariwisata/assets/ico/industries.png',
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

function angkotindustri(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log("d");
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Info</th></thead>");

  $.ajax({ 
    url: server+'data/angkotindustri.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){             
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows) {   
        var row     = rows[i];
        var id_angkot   = row.id_angkot;
        var jurusan   = row.destination;
        var route_color = row.route_color;
        var latitude  = row.latitude ;
        var longitude = row.longitude ;
        var lat  = row.lat ;
        var lng = row.lng ;
        
        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/industries.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(13);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
      } 
    }
  });  
}

function detailoleh(id1){  //menampilkan Information oleh oleh  
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  console.log('ini souvenir');
  $.ajax({ 
    url: server+'data/detailoleh.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log(id1);
      for (var i in rows){ 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var owner=row.owner;
        var cp=row.cp;
        var employee=row.employee;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/shopping.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+name+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+address+"</td></tr><tr><td><b>Owner</b></td><td>:</td><td>"+owner+"</td></tr><tr><td><b>Contact Person</b></td><td>:</td><td> "+cp+"</td></tr><tr><td><b>Employee</b></td><td>:</td><td> "+employee+"</td></tr>")
        // <a class='btn btn-default fa fa-compass' title='Attraction Nearby' onclick='owsekitar("+latitude+","+longitude+",200);ow();owtampil();'></a></td></tr> ");
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a><a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }
    }
  }); 
}

function detailrestaurant(id1){  //menampilkan Information rm
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  $.ajax({ 
    url: server+'data/detailrestaurant.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log(id1);
      for (var i in rows){ 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var cp=row.cp;
        var open=row.open;
        var close=row.close;
        var capacity=row.capacity;
        var mushalla=row.mushalla;
        var park_area=row.park_area;
        var employee=row.employee;
        var bathroom = row.bathroom;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/restaurants.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+name+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+address+"</td></tr><tr><td><b>Contact Person</b></td><td>:</td><td>"+cp+"</td></tr><tr><td><b>Open</b></td><td>:</td><td> "+open+"</td></tr><tr><td><b>Close</b></td><td>:</td><td> "+close+"</td></tr><tr><td><b>Capacity</b></td><td>:</td><td> "+capacity+"</td></tr><tr><td><b>Employee</b></td><td>:</td><td> "+employee+"</td></tr>")
        // <a class='btn btn-default fa fa-compass' title='Attraction Nearby' onclick='owsekitar("+latitude+","+longitude+",200);ow();owtampil();'></a></td></tr> ");
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }
    }
  }); 
}

function detailhotel(id1){  //menampilkan Information hotel
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  $.ajax({ 
    url: server+'data/detailhotel.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log(id1);
      for (var i in rows) { 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var cp=row.cp;
        var ktp=row.ktp;
        var marriage_book=row.marriage_book;
        var mushalla=row.mushalla;
        var star=row.star;
        var lat  = row.latitude; 
        var lon = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/marker_hotel.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(lat);
        console.log(lon);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        var syarat="0";
        if (ktp == 1 && marriage_book == 1) {
          syarat = "KTP & Marriage Book";
        } else if (ktp == 1) {
          syarat = "KTP";
        } else if (marriage_book == 1) {
          syarat = "Marriage Book";
        }
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+name+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+address+"</td></tr><tr><td><b>Contact Person</b></td><td>:</td><td>"+cp+"</td></tr><tr><td><b>Stay Requirements</b></td><td>:</td><td> "+syarat+"</td></tr><tr><td><b>Star</b></td><td>:</td><td> "+star+"</td></tr>")
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

function detailculinary(id1){  //menampilkan Information culinary
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  hapusMarkerTerdekat();
  $.ajax({ 
    url: server+'data/detailrm.php?cari='+id1, data: "", dataType: 'json', success: function(rows){ 
      console.log(id1);
      for (var i in rows) { 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var cp=row.cp;
        var capacity=row.capacity;
        var jam_buka=row.open;
        var jam_tutup=row.close;
        var employee=row.employee;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/food.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
        $('#info').append("<tr><td><b>Name</b></td><td>:</td><td> "+name+"</td></tr><tr><td><b>Address </b></td><td>:</td><td> "+address+"</td></tr><tr><td><b>Contact Person</b></td><td>:</td><td>"+cp+"</td></tr><tr><td><b>Special Menu</b></td><td>:</td><td> "+capacity+"</td></tr><tr><td><b>Open</b></td><td>:</td><td> "+jam_buka+"</td></tr><tr><td><b>Close </b></td><td>:</td><td> "+jam_tutup+"</td></tr><tr><td><b>Capacity</b></td><td>:</td><td> "+employee+"</td></tr><tr><td><b>Facility</b></td></tr>")
        // <a class='btn btn-default fa fa-compass' title='Attraction Nearby' onclick='owsekitar("+latitude+","+longitude+",200);ow();owtampil();'></a></td></tr> ");
        infowindow = new google.maps.InfoWindow({
          position: centerBaru,
          content: "<span style=color:black><center><b>Information</b><br></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }           
    }
  }); 
}

function angkotkuliner(id_angkot, lat1, lng1){
  $('#infoak').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  clearangkot();
  hapusMarkerTerdekat();
  console.log("d");
  $('#infoak').append("<thead><th class='centered'>Destination</th><th class='centered'>Info</th></thead>");
  $.ajax({ 
    url: server+'data/angkotkuliner.php?id='+id_angkot, data: "", dataType: 'json', success: function(rows){             
      if(rows==null){
        alert('Urban transport route not found');
      }
      for (var i in rows) {   
        var row     = rows[i];
        var id_angkot   = row.id_angkot;
        var jurusan   = row.destination;
        var route_color = row.route_color;
        var latitude  = row.latitude ;
        var longitude = row.longitude ;
        var lat  = row.lat ;
        var lng = row.lng ;
        listgeom(id_angkot)
        tampilrute(id_angkot, route_color, latitude, longitude);
        centerBaru = new google.maps.LatLng(latitude, longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/food.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(id_angkot);
        console.log(latitude);
        console.log(longitude);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(13);
        $('#infoak').append("<tr><td>"+jurusan+"</td><td><a role='button' title='info' class='btn btn-default fa fa-info' onclick='detailangkot(\""+id_angkot+"\",\""+lat+"\",\""+lng+"\",\""+lat1+"\",\""+lng1+"\")'></a></td></tr> ");
      }
    }
  });
}

function detailhotel_infow(id){  //menampilkan Information hotel
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  $.ajax({ 
    url: server+'data/detailhotel.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
      console.log(id);
      for (var i in rows){ 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var lat  = row.latitude; 
        var lon = row.longitude;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/marker_hotel.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(lat);
        console.log(lon);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18);
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

function detailres_infow(id){  //menampilkan Information rm
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  $.ajax({ 
    url: server+'data/detailrestaurant.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
      console.log(id);
      for (var i in rows){ 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/restaurants.png',
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
          content: "<span style=color:black><center><b>Information</b></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a></a>&nbsp<a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }       
    }
  }); 
}

function detailindustri_infow(id){  //menampilkan Information rm
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  $.ajax({ 
    url: server+'data/detailik.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
      console.log(id);
      for (var i in rows) { 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/industries.png',
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

function detailhotel_infow(id){  //menampilkan Information hotel
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  $.ajax({ 
    url: server+'data/detailhotel.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
      console.log(id);
      for (var i in rows) { 
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var lat  = row.latitude; 
        var lon = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/marker_hotel.png',
          map: map,
          animation: google.maps.Animation.DROP,
        });
        console.log(lat);
        console.log(lon);
        markersDua.push(marker);
        map.setCenter(centerBaru);
        map.setZoom(18); 
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

function detailoleh_infow(id){  //menampilkan Information oleh oleh  
  $('#info').empty();
  hapusInfo();
  clearroute2();
  clearroute();
  console.log('ini souvenir');
  $.ajax({ 
    url: server+'data/detailoleh.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
      console.log(id);
      for (var i in rows){
        console.log('dd');
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var address=row.address;
        var latitude  = row.latitude; 
        var longitude = row.longitude ;
        centerBaru = new google.maps.LatLng(row.latitude, row.longitude);
        marker = new google.maps.Marker({
          position: centerBaru,
          icon:'/ta_pariwisata/assets/ico/shopping.png',
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
          content: "<span style=color:black><center><b>Information</b></center><br><i class='fa fa-home'></i> "+name+"<br><i class='fa fa-map-marker'></i> "+address+"<br><a role='button' title='Route from your position' class='btn btn-default fa fa-car' value='Route' onclick='callRoute(centerLokasi, centerBaru);rutetampil();resetangkot();'></a><a role='button' title='gallery' class='btn btn-default fa fa-picture-o' value='Gallery' onclick='galeri(\""+id+"\")'></a></span>",
          pixelOffset: new google.maps.Size(0, -33)
        });
        infoDua.push(infowindow); 
        hapusInfo();
        infowindow.open(map);
      }
    }
  }); 
}