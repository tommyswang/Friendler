var map;
var geocoder;

function loadMap() {
	var seattle = {lat:  47.608013, lng: -122.335167};
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: seattle
    });

    var marker = new google.maps.Marker({
      position: seattle,
      map: map
    });

    var cdata = JSON.parse(document.getElementById('data').innerHTML);
    geocoder = new google.maps.Geocoder();
    codeAddress(cdata);

    var allData = JSON.parse(document.getElementById('allData').innerHTML);
    showAll(allData)
}

function showAll(allData) {
	var infoWind = new google.maps.InfoWindow;
	Array.prototype.forEach.call(allData, function(data){
		var content = document.createElement('div');
		var name = document.createElement('strong');
    var address = document.createElement('P');
    var description = document.createElement('P');
    var type = document.createElement('P');
    var link = document.createElement('A');


		name.textContent = data.Event;
		name.setAttribute('class','event-name');
		content.appendChild(name);

    address.textContent = data.Address;
    content.appendChild(address);

    description.textContent = data.Event_Description_Agenda;
    content.appendChild(description);

    type.textContent = 'Type: ' + data.Classification;
		content.appendChild(type);

    link.textContent = "More Details";
    link.setAttribute('href', 'Main.php?EventID=' + data.id);
		link.setAttribute('class', 'text-btn form-title');
    content.appendChild(link);

		var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(data.Latitude, data.Longitude),
	      map: map
	  });

	    marker.addListener('mouseover', function(){
	    	infoWind.setContent(content);
	    	infoWind.open(map, marker);
	    });

			google.maps.event.addListener(map,'click',function(event) {
         document.getElementById('lat').value = event.latLng.lat()
         document.getElementById('lng').value =  event.latLng.lng()
      });

      // google.maps.event.addListener(map,'mousemove',function(event) {
      //    document.getElementById('latspan').innerHTML = event.latLng.lat()
      //    document.getElementById('lngspan').innerHTML = event.latLng.lng()
      // });
	})
}

function codeAddress(cdata) {
   Array.prototype.forEach.call(cdata, function(data){
    	var address = data.name + ' ' + data.address;
	    geocoder.geocode( { 'address': address}, function(results, status) {
	      if (status == 'OK') {
	        map.setCenter(results[0].geometry.location);
	        var points = {};
	        points.id = data.id;
	        points.lat = map.getCenter().lat();
	        points.lng = map.getCenter().lng();
	        updateLocWithLatLng(points);
	      } else {
	        alert('Geocode was not successful for the following reason: ' + status);
	      }
	    });
	});
}

function updateLocWithLatLng(points) {
	$.ajax({
		url:"action.php",
		method:"post",
		data: points,
		success: function(res) {
			console.log(res)
		}
	})

}
