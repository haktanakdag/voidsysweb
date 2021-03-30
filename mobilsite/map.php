<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Multiple Markers Google Maps</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBy6yZ7Rm4QtCZ4nNqP-b0z0k_8NRWiQCo&v=3.exp'></script>
        <div id="map" style="width: 500px; height: 400px;"></div>
      <script type="text/javascript">
    var locations = [
      ['Koçarlı', 37.760177, 27.706331, 1],
      ['Nazilli', 37.915271, 28.328066, 2],
      ['İncirliova', 37.8535843,27.7233486, 3],
      ['Söke', 37.750468, 27.407007, 4],
      ['Kuşadası', 37.859883, 27.264413, 5],
      ['Didim', 37.376527, 27.267777, 6],
      ['Germencik', 37.870312, 27.602024, 7],
      ['Çine', 37.614843, 28.060787, 8],
      ['Kurtuluş', 37.842602, 27.841886, 9],
      ['Köşk', 37.853891, 28.051978, 10],
      ['Mimar Sinan', 37.851861, 27.812313, 11],
      ['Balık Hali', 37.848699, 27.847052, 12],
      ['Çarşamba', 0,0, 11]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: new google.maps.LatLng(37.844428, 27.841660),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
</html>