<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/app.css">
        <title>Settavut</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <style>
          #map {
            height: 100%;
          }
          /* Optional: Makes the sample page fill the window. */
          html {
            height: 100%;
            margin: 0;
            padding: 0;
            text-align: center;
          }

          #map {
            height: 500px;
            width: 600px;
          }
        </style>
    
    </head>
    <body>
    <div class="flex-center position-ref full-height">
      <div class="content">
        <div id="app">
          <search-box></search-box>
        </div>
      </div>
    </div>
    <div class="container" style="margin-top:50px">
      <div class="row">
        <div class="col-sm">
          <div id="listData">
          
          </div>
        </div>
        <div class="col-sm">
          <div id="map"></div> 
        </div>
      </div>
    </div>
    <script>
      function initMap() {
        var mapOptions = {
          center: {lat: 13.847860, lng: 100.604274},
          zoom: 18,
        }
        var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
      }
    </script>
    <script src="js/app.js" charset="utf-8"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCs41agvvNHRTct5q-YEVwKXvfstVa3Fl4&libraries=places&callback=initMap" async defer></script>
  </body>
</html>




