
<?php
include ($_SERVER['DOCUMENT_ROOT']."/Basisdatalanjut/value/location.php");
require $action.'/connect.php';

// $cari_nama = $_GET["cari_nama"];
$querysearch	="SELECT DISTINCT kecelakaan.id_kecelakaan, kecelakaan.total_kerugian,kecelakaan.keterangan_lokasi, jenis_kendaraan.nama,user_polisi.name as pelapor,kecelakaan.waktu_kejadian,ST_X(ST_Centroid(kecelakaan.geom)) AS longitude, ST_Y(ST_CENTROID(kecelakaan.geom)) 
AS latitude,kendaraan.id_detail FROM kecelakaan join kendaraan on kecelakaan.id_kecelakaan=kendaraan.id_kecelakaan 
join jenis_kendaraan on kendaraan.id_detail=jenis_kendaraan.id  
join user_polisi on kecelakaan.id_pelapor=user_polisi.id where jenis_kendaraan.nama='sepeda_motor'";
			   
$hasil=pg_query($querysearch);
while($row = pg_fetch_array($hasil))
    {
          $id_kecelakaan=$row['id_kecelakaan'];
          $total_kerugian=$row['total_kerugian'];
          $keterangan_lokasi=$row['keterangan_lokasi'];
          $waktu = $row['waktu_kejadian'];
          $pelapor=$row['pelapor'];
          $longitude=$row['longitude']; 
          $latitude=$row['latitude'];
          $dataarray[]=array('id_kecelakaan'=>$id_kecelakaan,'petugas'=>$pelapor,'waktu'=>$waktu,'total_kerugian'=>$total_kerugian, 'keterangan_lokasi'=>$keterangan_lokasi, 'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);

?>