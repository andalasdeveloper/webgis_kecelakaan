<?php
require '../action/connect.php';
$cari = $_GET["cari"];

$querysearch = "SELECT kecelakaan.id_kecelakaan AS id, kecelakaan.total_kerugian AS total_kerugian, kecelakaan.keterangan_lokasi AS keterangan_lokasi,kecelakaan.waktu_kejadian,jenis_kecelakaan.jenis_kecelakaan, kecelakaan.image AS image, ST_X(ST_Centroid(kecelakaan.geom)) AS lng, ST_Y(ST_CENTROID(kecelakaan.geom)) AS lat FROM kecelakaan 
    JOIN jenis_kecelakaan on kecelakaan.id_jeniskecelakaan=jenis_kecelakaan.id_jenis    
    WHERE id_kecelakaan='".$cari."'";
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    
	{
		  $id=$row['id'];
		  $total_kerugian=$row['total_kerugian'];
		  $keterangan_lokasi=$row['keterangan_lokasi'];
		  $image=$row['image'];
          $jenis=$row['jenis_kecelakaan'];
          $waktu=$row['waktu_kejadian'];
		  $longitude=$row['lng'];
		  $latitude=$row['lat'];
		  $dataarray[]=array('id'=>$id,'total_kerugian'=>$total_kerugian,'jenis'=>$jenis,'waktu'=>$waktu,'keterangan_lokasi'=>$keterangan_lokasi,
		  	'image'=>$image, 'longitude'=>$longitude,'latitude'=>$latitude);
	}

	 //KORBAN
    $query_korban="SELECT korban_kecelakaan.no_ktp,korban_kecelakaan.nama, korban_kecelakaan.jenis_kelamin,korban_kecelakaan.kondisi FROM korban_kecelakaan where id_kecelakaan = '$cari' 
    	UNION SELECT korban_kendaraan.no_ktp,korban_kendaraan.nama,korban_kendaraan.jenis_kelamin,korban_kendaraan.kondisi FROM korban_kendaraan where id_kecelakaan = '".$cari."' "; 

    $hasil3=pg_query($query_korban);
    while($baris = pg_fetch_array($hasil3)){
        $no_ktp=$baris['no_ktp'];
        $nama=$baris['nama'];
        $jenis_kelamin=$baris['jenis_kelamin'];
        $kondisi = $baris['kondisi'];
        $data_korban[]=array('no_ktp'=>$no_ktp,'nama'=>$nama,'jenis_kelamin'=>$jenis_kelamin,'kondisi'=>$kondisi);
    }

    //Kendaraan 
    
    $query_kendaraan="SELECT kendaraan.no_plat, kendaraan.nama_pemilik, jenis_kendaraan.nama as jenis_kendaraan,kendaraan.status_disita,kendaraan.kondisi from kendaraan join jenis_kendaraan on kendaraan.id_detail=jenis_kendaraan.id where id_kecelakaan='".$cari."'";


    $hasil4=pg_query($query_kendaraan);
    while($baris = pg_fetch_array($hasil4)){

        $no_plat=$baris['no_plat'];
        $nama_pemilik=$baris['nama_pemilik'];
        $jenis_kendaraan=$baris['jenis_kendaraan'];
        $status_disita=$baris['status_disita'];
        $kondisi=$baris['kondisi'];
        $data_kendaraan[]=array('no_plat'=>$no_plat,'nama_pemilik'=>$nama_pemilik, 'jenis_kendaraan'=>$jenis_kendaraan,'status_disita'=>$status_disita,'kondisi'=>$kondisi);
    }

	$arr=array("data"=>$dataarray, "korban"=>$data_korban, "kendaraan"=>$data_kendaraan);
    echo json_encode($arr);








	
?>
