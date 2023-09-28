<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="Maps for record" />
    <meta name = "viewport" content = "initial-scale=1.0, user-scalable=no">
    <title>Map</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <?php
    $id = $_GET["id"];
    require_once "inc/dbconn.inc.php";  
    $sql = "SELECT * FROM recordgreen where id = '{$id}'";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0)
        {                
            $studentL = $row['studentL'];
            $date = $row['date'];
            $date = str_replace("-", "", $date);
            $startTime = $row['startTime'];
            $startTime = str_replace(":", "", $startTime);                            
        }
    }
    $folder = $studentL;
    $filename = $date.$startTime.".TXT";
    $file_path = "MAPS/".$studentL."/".$filename;

    $data = array();

    if(file_exists($file_path))
    {
        $file_dat = file($file_path);
        for($i = 0; $i < count($file_dat); $i++)
        {
            $data[$i] = $file_dat[$i];
        }
        /*
        $data[0] = "-35.010258, 138.572807";
        $data[1] = "-35.010248, 138.572699";
        $data[2] = "-35.010172, 138.572712";
        $data[3] = "-35.010100, 138.572730";
        $data[4] = "-35.010033, 138.572737";
        $data[5] = "-35.009965, 138.572764";
        $data[6] = "-35.009895, 138.572778";
        $data[7] = "-35.009819, 138.572794";
        $data[8] = "-35.009747, 138.572812";
        $data[9] = "-35.009710, 138.572821";
        $data[10] = "-35.009643, 138.572834";
        $data[11] = "-35.009547, 138.572859";
        $data[12] = "-35.009464, 138.572884";
        $data[13] = "-35.009368, 138.572904";
        $data[14] = "-35.009253, 138.572932";
        $data[15] = "-35.009178, 138.572953";
        $data[16] = "-35.009086, 138.572958";
        $data[17] = "-35.009021, 138.572928";
        $data[18] = "-35.008983, 138.572865";
        $data[19] = "-35.008960, 138.572771";
        $data[20] = "-35.008943, 138.572668";
        $data[21] = "-35.008927, 138.572551";
        $data[22] = "-35.008906, 138.572431";
        $data[23] = "-35.008903, 138.572351";
        $data[24] = "-35.008940, 138.572293";
        $data[25] = "-35.008990, 138.572266";
        $data[26] = "-35.009058, 138.572241";
        $data[27] = "-35.009111, 138.572224";
        $data[28] = "-35.009189, 138.572203";
        $data[29] = "-35.009231, 138.572197";
        $data[30] = "-35.009322, 138.572177";
        $data[31] = "-35.009348, 138.572220";
        $data[32] = "-35.009353, 138.572269";
        $data[33] = "-35.009358, 138.572335";
        $data[34] = "-35.009376, 138.572370";
        $data[35] = "-35.009410, 138.572366";*/
    }
    
    ?>
    <script>
        function initialize()
        {
            
            var mapOptions = {
                zoom:18,
                center: new google.maps.LatLng(-35.010258, 138.572807),
                mapTypeId: google.maps.MapTypeId.hybrid
            };
            var startMarker, finishMarker;
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var data = <?php echo json_encode($data); ?>;
            
            if(data.length != 0)
            {
                var driveCoordinates = [];            
            
                for(var i = 0; i < data.length; i++){
                    var strlatlng = data[i].split(",",2);
                    var lat = parseFloat(strlatlng[0]);
                    var lng = parseFloat(strlatlng[1]);
                    driveCoordinates[i] = new google.maps.LatLng(lat,lng);
                }
            
                var drivePath = new google.maps.Polyline({
                    path: driveCoordinates,
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 4
                });            

                var strlatlng1 = data[0].split(",",2);
                var beginLat = parseFloat(strlatlng1[0]);
                var beginLng = parseFloat(strlatlng1[1]);
                strlatlng1 = data[data.length-1].split(",",2);
                var endLat = parseFloat(strlatlng1[0]);
                var endLng = parseFloat(strlatlng1[1]);
            
                var myStart = new google.maps.LatLng(beginLat,beginLng);
                var myEnd = new google.maps.LatLng(endLat, endLng);
                startMarker = new google.maps.Marker({
                    position: myStart,
                    title: "Start",
                    icon:{
                        path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
                        fillColor: '#fec000',
                        fillOpacity: 1,
                        strokeColor: '#fec000',
                        strokeOpacity: 1,
                        stockeWeight: 1,
                        scale:5
                    }
                });
                finishMarker = new google.maps.Marker({
                    position: myEnd,
                    title: "End",
                    icon:{
                        path: google.maps.SymbolPath.CIRCLE,
                        fillColor: '#00F',
                        fillOpacity: 1,
                        strokeColor: '#00F',
                        strokeOpacity: 1,
                        stockeWeight: 1,
                        scale:5
                    }
                });
                startMarker.setMap(map);
                finishMarker.setMap(map);

                drivePath.setMap(map);
            }
            else
            {
                alert("No any records in the map!");
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>        
  </head>
  <body>

    <div id = "map-canvas" style = "position:absolute; width:78%; height:98vh; margin:0px; padding:0px; float:left; border:solid 2px chartreuse">
    </div>

    <?php
        $id = $_GET["id"];
        require_once "inc/dbconn.inc.php";  
        $sql = "SELECT * FROM recordgreen where id = '{$id}'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            if(mysqli_num_rows($result) > 0)
            {                
                $date = $row['date'];
                $startTime = $row['startTime'];
                $finishTime = $row['finishTime'];
                $duration = $row['duration'];
                $formLocation = $row['fromLocation'];
                $toLocation = $row['toLocation'];
                $road = $row['road'];
                $weather = $row['weather'];
                $traffic = $row['traffic'];
                $qsdName = $row['qsdName'];
                $qsdLicence = $row['qsdLicence'];                
            }
        }
        mysqli_free_result($result);
        mysqli_close($conn);          
    ?>
    <div style = "font-family:'Courier New', Courier, monospace; float:right; margin:0px; padding:0px; border:solid 2px red; width:20%; height:98vh; position:relative">
        <p style = "margin-left:10px">Date: <?=$date?></p>
        <p style = "margin-left:10px">Start : <?=$startTime?></p>
        <p style = "margin-left:10px">Finish: <?=$finishTime?></p>
        <p style = "margin-left:10px">Form:</p>
        <p style = "margin-left:10px">&nbsp<?=$formLocation?></p>
        <p style = "margin-left:10px">To:</p>
        <p style = "margin-left:10px">&nbsp<?=$toLocation?></p>
        <p style = "margin-left:10px">Condition</p>
        <p style = "margin-left:10px">&nbsp&nbspRoad: <?=$road?></p>
        <p style = "margin-left:10px">&nbsp&nbspWeather: <?=$weather?></p>
        <p style = "margin-left:10px">&nbsp&nbspTraffic: <?=$traffic?></p>
        <p style = "margin-left:10px">QSD: <?=$qsdName?></p>
        <p style = "margin-left:10px">QSD Licence: <?=$qsdLicence?></p>
    </div>
  </body>
</html>



