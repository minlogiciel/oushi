var geocoder;
var map;
var infowindow = new google.maps.InfoWindow({ maxWidth: 320 });
var marker;
function initializemaps() {        
	//var address = "<font size=1>欧洲时报文化中心<br>110 bis, Avenue de Paris<br>94800 Villejuif</font>";
	//var lat = 48.7992706;
	//var lng = 2.3654536;
	var address = "<div class=infoWindow><h4>欧洲时报文化中心</h4><br>48-50 Rue Benoît Malon<br>94250 Gentilly<div>";
	var lat = 48.81576;
	var lng = 2.34146;
	
	geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat,  lng);

   
 	var mapOptions = { 
		center: latlng,       
		zoom: 15,          
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};        
	map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions); 

	geocoder.geocode( 
		{ 'latLng': latlng}, 
		function(results, status) {      
			map.setCenter(results[0].geometry.location);        
			marker = new google.maps.Marker({            
				map: map,           
				position: latlng       
			});      
	        //infowindow.setContent(results[1].formatted_address);
			infowindow.setContent(address);
            infowindow.open(map, marker);
		}
	);    	
}    
