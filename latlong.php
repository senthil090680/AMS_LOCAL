<?php
extract($_REQUEST);
$address	=	urlencode($cityval);
$zoom		=	30;
$type = 'ROADMAP';
$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=true");
//echo $json;

$data = json_decode($json,true);

//pre($data);

//echo $data['results'][0]['geometry']['location']['lat']."<br>"; echo $data['results'][0]['geometry']['location']['lng']."<br>";

$map_status = $data['status'];
//exit(0);
//$data = file_get_contents("http://maps.google.com/maps/geo?output=csv&q=".urlencode($address));

if ($map_status == 'OK') {
	$lat = $data['results'][0]['geometry']['location']['lat'];
	$long = $data['results'][0]['geometry']['location']['lng'];
	echo $lat."~".$long;
	//$lat = "13.051908321556306";
	//$long = "80.24925827980042";
	//echo $lat."=====".$long;
	//exit;
} else {
	echo "fail";
	//die();
}
?>