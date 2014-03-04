<?php
$address	=	urlencode("Kovilpatti");
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

	//$lat = "13.051908321556306";
	//$long = "80.24925827980042";
	//echo $lat."=====".$long;
	$lat = "13.04583735";
	$long = "80.2552475";
	//exit;
} else {
	echo "<script type='text/javascript'>alert('Google Map Lookup Failed');</script>";
	//die();
}
?>
<!DOCTYPE html >
 <head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Map Simple</title>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var marker;
var infowindow;

function initialize(latval,longval) {
	alert(latval);
	alert(longval);
  var latlng = new google.maps.LatLng(latval, longval);
  var options = {
    zoom: 13,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById("map-canvas"), options);
  var html = "<table>" +
             "<tr><td>Name:</td> <td><input type='text' id='name'/> </td> </tr>" +
             "<tr><td>Address:</td> <td><input type='text' id='address'/></td> </tr>" +
             "<tr><td>Type:</td> <td><select id='type'>" +
             "<option value='bar' SELECTED>bar</option>" +
             "<option value='restaurant'>restaurant</option>" +
             "</select> </td></tr>" +
             "<tr><td></td><td><input type='button' value='Save & Close'     onclick='saveData()'/></td></tr>";
infowindow = new google.maps.InfoWindow({
 content: html
});

google.maps.event.addListener(map, "click", function(event) {
    marker = new google.maps.Marker({
      position: event.latLng,
      map: map
    });
    google.maps.event.addListener(marker, "click", function() {
      infowindow.open(map, marker);
    });
});
}

function saveData() {
  var name = escape(document.getElementById("name").value);
  var address = escape(document.getElementById("address").value);
  var type = document.getElementById("type").value;
  var latlng = marker.getPosition();

  var url = "geomap.php?name=" + name + "&address=" + address +
            "&type=" + type + "&lat=" + latlng.lat() + "&lng=" + latlng.lng();
  downloadUrl(url, function(data, responseCode) {
    if (responseCode == 200 && data.length <= 1) {
      infowindow.close();
      document.getElementById("message").innerHTML = "Location added.";
    }
  });
}

function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request.responseText, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
}

function doNothing() {}
</script>
</head>

<body style="margin:0px; padding:0px;" onload="initialize('<?php echo $lat; ?>','<?php echo $long; ?>')">
<div id="map-canvas" style="width: 500px; height: 300px"></div>
<div id="message"></div>
</body>

</html>
<?php
//require("phpsqlinfo_dbinfo.php");

// Gets data from URL parameters
$name = $_GET['name'];
$address = $_GET['address'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];
$type = $_GET['type'];

$username		=		'root';
$password		=		'hari';
$database		=		'fmcl';

// Opens a connection to a MySQL server
$connection=mysql_connect ("localhost", $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Insert new row with user data
$query = sprintf("INSERT INTO markers " .
     " (id, name, address, lat, lng, type ) " .
     " VALUES (NULL, '%s', '%s', '%s', '%s', '%s');",
     mysql_real_escape_string($name),
     mysql_real_escape_string($address),
     mysql_real_escape_string($lat),
     mysql_real_escape_string($lng),
     mysql_real_escape_string($type));

//$result = mysql_query($query);

if (!$result) {
  die('Invalid query: ' . mysql_error());
}

?>