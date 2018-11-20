<?php
include $_SERVER['DOCUMENT_ROOT'].'/ta_pariwisata/value/location.php';
include ($action.'/connect.php');

$id=$_GET['id'];
$querysearch = "SELECT row_to_json(fc) FROM (SELECT 'FeatureCollection' AS type, array_to_json(array_agg(f)) AS features FROM (SELECT 'Feature' AS type, ST_AsGeoJSON(a.geom)::json AS geometry , row_to_json((SELECT l FROM (SELECT id, name) AS l )) AS properties FROM spa AS a where id='$id') AS f ) AS fc";

$hasil=pg_query($querysearch);
while($data=pg_fetch_array($hasil))
{
    $load=$data['row_to_json'];
}
echo $load;
?>