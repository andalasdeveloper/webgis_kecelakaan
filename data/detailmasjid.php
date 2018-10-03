<?php
require '../controller/connect.php';
$cari = $_GET["cari"];

$querysearch = "SELECT spa.id AS id, spa.name AS name, spa.address AS address, spa.diskon AS diskon, spa.image AS image, ST_X(ST_Centroid(spa.geom)) AS lng, ST_Y(ST_CENTROID(spa.geom)) AS lat FROM spa WHERE id='$cari'";
// $querysearch ="select worship_place.id, worship_place.name as name_mesjid, address, land_size, building_size, park_area_size, capacity, est, last_renovation, imam, jamaah, teenager, category_worship_place.name as name_category, image, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from worship_place join category_worship_place on category_worship_place.id=worship_place.id_category where worship_place.id='$cari'";   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
	{
		  $id=$row['id'];
		  $name=$row['name'];
		  $address=$row['address'];
		  $diskon=$row['diskon'];
		  $image=$row['image'];
		  // $building_size=$row['building_size'];
		  // $park_area_size=$row['park_area_size'];
		  // $capacity=$row['capacity'];
		  // $est=$row['est'];
		  // $last_renovation=$row['last_renovation'];
		  // $imam=$row['imam'];
		  // $jamaah=$row['jamaah'];
		  // $teenager=$row['teenager'];
		  // $name_category=$row['name_category'];
		  // $image=$row['image'];
		  $longitude=$row['lng'];
		  $latitude=$row['lat'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address, 'diskon'=>$diskon, 'image'=>$image, 'longitude'=>$longitude,'latitude'=>$latitude);
		  echo json_encode($dataarray);

		 //  if ($image=='null' || $image=='' || $image==null){
			// $image='foto/foto.jpg';
		 //  }
	}
	
	 //DATA FASILITAS
    /*$query_fasilitas="SELECT facility.id, facility.name FROM facility left join detail_facility on detail_facility.id_facility = facility.id left join worship_place on worship_place.id = detail_facility.id_worship_place where worship_place.id = '".$cari."' "; 
    $hasil3=pg_query($query_fasilitas);
    while($baris = pg_fetch_array($hasil3)){
        $id_fas=$baris['id'];
        $name=$baris['name'];
        $data_fasilitas[]=array('id'=>$id_fas,'name'=>$name);
    }
	//DATA KEGIATAN
    $query_keg="SELECT event.name as event_name, detail_event.id_worship_place,worship_place.name as worship_place_name, detail_event.date, 
 ustad.name as ustad_name, detail_event.description, detail_event.time FROM detail_event join event on detail_event.id_event=event.id 
 join worship_place on detail_event.id_worship_place=worship_place.id join ustad on detail_event.id_ustad=ustad.id  where detail_event.id_worship_place='".$cari."'"; 
    $hasil4=pg_query($query_keg);
    while($baris = pg_fetch_array($hasil4)){
        $event_name=$baris['event_name'];
        $date=$baris['date'];
        $time=$baris['time'];
        $data_keg[]=array('event_name'=>$event_name,'date'=>$date, 'time'=>$time);
    }
	$arr=array("data"=>$dataarray, "fasilitas"=>$data_fasilitas, "keg"=>$data_keg);
    echo json_encode($arr);*/
?>
