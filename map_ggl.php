<form action="" method="post">
    Enter place: <input type="text" name="place">
    <input type="submit" name="submit" value="search">
</form>
<?php  

  if(isset($_POST['submit'])){
            //include 'connect.php';
 $con= mysqli_connect("localhost","root","","sample");
$place = $_POST['place'];
$apikey="AIzaSyAA2fBTrIbS0Cu1XDxVsnirupN_QRhXDEU";

  //$lat = 0;
  //$long = 0;
  $zoom = 8;
 
  $findmap = "SELECT pointLat, pointLong, pointText  FROM mappoints1 where pointText='$place'";
 
  if(!$result = $con->query($findmap)){
     die('There was an error running the query [' . $con->error . ']');
  } 
  
  else {  
    
    while ($row = $result->fetch_assoc()) {
     $lat = $row['pointLat'];
    $long = $row['pointLong'];
    $ptext = $row['pointText'];
    }
  }
  }
?>
<style>
    #map {
  height: 100%;
  width: 100%;
 }
</style>
<body>
<div class="container-fluid">
 <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">

 	<div class="col-lg-12 col-md-12 col-xs-12">
    	<div id="map" class="img-responsive"></div>
 </div>
    
  </div>  
</div> 
<script type="text/javascript"  async defer
      src="https://maps.googleapis.com/maps/api/js?key=
          <?php echo $apikey; ?>&callback=initialize">
</script>

<script>
 function initialize() {
        var mapOptions = {            
          center: new google.maps.LatLng(<?php echo $lat.','.$long; ?>),         
          zoom: <?php echo $zoom; ?>          
        };           
       var map = new google.maps.Map(document.getElementById("map"),
            mapOptions);
       var marker = new google.maps.Marker({ 
            
         position:new google.maps.LatLng(<?php echo $lat.','.$long; ?>),
         map: map,
         title:'<?php echo $ptext; ?>'                       
      });             
} google.maps.event.addDomListener(window, 'load', initialize);

</script>
</body>





   
