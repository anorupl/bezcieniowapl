
var element =  document.getElementById('section-directions-map');

if (typeof(element) != 'undefined' && element != null) {

	var input   = document.getElementById('contact-latlng').value,
		array_input = input.split(",");

	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(array_input[0], array_input[1]),
		map: map
	});

	var directionsService = new google.maps.DirectionsService(),
		directionsDisplay;

	var map;

	google.maps.event.addDomListener(window, 'load', initMap);
	google.maps.event.addDomListener(window, "resize", function() {
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center);
	});

	document.getElementById('show_road').addEventListener('click',  showRoute, false);
	document.getElementById('hide_road').addEventListener('click',  hideRoute, false);
	document.getElementById('start').addEventListener('keypress', function (e) {
		var key = e.which || e.keyCode;
		if (key === 13) { // 13 is enter
			showRoute();
		}
	});
}



function initMap() {

	directionsDisplay = new google.maps.DirectionsRenderer();

	var BWmap = new google.maps.StyledMapType( [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"administrative.country","elementType":"geometry.fill","stylers":[{"visibility":"on"}]},{"featureType":"administrative.province","elementType":"labels.icon","stylers":[{"hue":"#ff0000"},{"visibility":"on"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}], {
		name: 'BW Style'
	});

	var BWmapId = 'bw_map';

	var mapOptions = {
		zoom: 11,
		scrollwheel: false,
		center: new google.maps.LatLng(array_input[0], array_input[1]),
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP,google.maps.MapTypeId.HYBRID, BWmapId]
		}

	};

	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	map.mapTypes.set(BWmapId, BWmap);
	map.setMapTypeId(BWmapId);
	marker.setMap(map);
}

function showRoute() {
	marker.setMap(null);
	map.setOptions({draggable: true});

	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById('directions-panel'));

	var request = {
		origin: document.getElementById('start').value,
		destination: new google.maps.LatLng(array_input[0], array_input[1]),
		travelMode: google.maps.TravelMode.DRIVING
	};
	directionsService.route(request, function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
		}
	});
}

function hideRoute() {
	directionsDisplay.setMap(null);
	directionsDisplay.setPanel(null);
	map.setOptions(
		{
			center: new google.maps.LatLng(array_input[0], array_input[1]),
		}
	);
	marker.setMap(map);
}
