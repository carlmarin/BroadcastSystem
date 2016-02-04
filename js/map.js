function loadScript()
{
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDyK0a58Tzko3TwI9g7cm7u8aFP8mxFtkI&sensor=false&callback=initialize";
  document.body.appendChild(script);
}

window.onload = loadScript;

function initialize()
{
  var map;
  var center = new google.maps.LatLng(-34.397, 150.644);
  var geocoder = new google.maps.Geocoder();
  var infowindow = new google.maps.InfoWindow();        
  var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

  var data = makeRequest('../php/getuseragentlocation.php', function(data) {
             
      var data = JSON.parse(data.responseText);
       
      center = new google.maps.LatLng(data[0].latitude, data[0].longitude);

      displayMap(center);
  });

  google.maps.event.addListenerOnce(map, 'idle', function(){
      google.maps.event.trigger(map, 'resize');
      map.setCenter(location);
  });
}

function makeRequest(url, callback) {
  var request;
  if (window.XMLHttpRequest) {
      request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
  } else {
      request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
  }
  request.onreadystatechange = function() {
      if (request.readyState == 4 && request.status == 200) {
          callback(request);
      }
  }
  request.open("GET", url, true);
  request.send();
}

function displayMap(center){
  
  var mapOptions = {
      zoom: 16,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      disableDefaultUI: true
  }
   
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  var marker = new google.maps.Marker({
      map: map, 
      position: center,
      animation:google.maps.Animation.BOUNCE
  });

  loadMarker();
  refresh();
  
  var centerControlDiv = document.createElement('div');
  var centerControl = new CenterControl(center, centerControlDiv, map);

  centerControlDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);

  $(".centermap").click(function(){
    var string = 'asdadsasd';
    alert(string);
  });

}

function refresh() {
    setInterval(function () {loadMarker();}, 1000);
};

function loadMarker() {
    $.ajax({
        url: '../php/ajaxreportlocation.php',
        success:function(data){
            var obj = JSON.parse(data);
            var totalLocations = obj.length;

            for (var i = 0; i < totalLocations; i++) {

                var position = new google.maps.LatLng(parseFloat(obj[i].user_latitude), parseFloat(obj[i].user_longitude));
                var marker = new google.maps.Marker({
                    position: position,
                    map: map,
                });

            }
        }
    });  
};

function calculateAndDisplayRoute(directionsService, directionsDisplay, center, position) {
  directionsService.route({
    origin: center,
    destination: position,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}

function CenterControl(center, controlDiv, map) {

  // Set CSS for the control border.
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = 'rgb(52,52,52)';
  // controlUI.style.border = '2px solid #fff';
  controlUI.style.border = '0';
  // controlUI.style.borderRadius = '3px';
  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
  controlUI.style.cursor = 'pointer';
  controlUI.style.marginBottom = '22px';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Click to recenter the map';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  var controlText = document.createElement('div');
  controlText.style.color = 'white';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '16px';
  controlText.style.lineHeight = '38px';
  controlText.style.paddingLeft = '5px';
  controlText.style.paddingRight = '5px';
  controlText.innerHTML = 'Center Map';
  controlUI.appendChild(controlText);

  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener('click', function() {
    map.setCenter(center);
  });

}



