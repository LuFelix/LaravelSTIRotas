<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 	crossorigin="anonymous">

</script>
   
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
   
    <style type="text/css">
     
      #right-panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #right-panel select, #right-panel input {
        font-size: 15px;
      }

      #right-panel select {
        width: 100%;
      }

      #right-panel i {
        font-size: 12px;
      }
      #map {
        height: 100%;
        width: 50%;
      }
      #right-panel {
        float: right;
        width: 48%;
        padding-left: 2%;
      }
      #output {
        font-size: 14px;
      }
      html { 
      			height: 100% 
      }
      body {	
      			height: 80%; 
      			width: 100%;
      			margin: 10px; 
      			padding: 10px; 
      }
      #map_canvas { 
      			height: 40%;
      			width: 30%;
      			border-top:50px solid #fff;
    				border-bottom:20px solid #fff; 
      }
      header {
    				height:10%;
			}
			footer {
 				   height:50%;
			}
    </style>
    
    <!--
	<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCse9kMY-wgS14Gcg2ed_I6ximvKf5hhII&sensor=false">
    </script>
	-->
	
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWJg_ZhdeqYJC4FAJISHTa3zPdSLOlqL8&callback=initMap"
		type="text/javascript">
	</script>
 
 <script>
  $(document).ready(function () {
    $('#dropNavega a').on('click', function () {
      var loja=($(this).text());
      navega(converteLocalLatLong(loja));
      
     	});
	});
		
$	(document).ready(function () {
		$('#dropPartida a').on('click', function () {
		var partida= ($(this).text());
		$("#txtPartida").val(partida);
	});
});

$(document).ready(function () {
	$('#dropChegada a').on('click', function () {
      var chegada = ($(this).text());
			$("#txtChegada").val(chegada);
	});
});
      
     
</script>

<script type="text/javascript">
/*

	Alguns endereços para teste
	-9.6629845,-35.7041467 Edf Pratagy
	-9.6629792,-35.7041467
	-9.6665713,-35.7399049 Edf Delmiro Gouveia
	-9.6620082, -35.7483829 Sti Magazine Maceió
	-9.6619401,-35.749736
	-9.6620029,-35.7505769
	-9.6620029,-35.7505769
	-9.6620082,-35.7483829
	-9.6451775,-35.708607 Illa Sorvetes Mangabeiras	
	-9.611526,-35.718795 Illa Sorvetes Serraria
	-9.54805,-35.724596 Illa Sorvetes Benedito Bentes I
	
*/ 

var map;
var poligono;
var marker;

function initialize() {
	//carrega o mapa no endereço recebido
  alert('Bem vindo ao SIR - Sistema Illa Rotas\n\n               Illa Sorvetes LTDA.\n\n Desenvolvido por: SCTech \n\nZAP 82 99323-1684\n       82 99631-0360');
  var myLatLng = new google.maps.LatLng(-9.6619952,-35.7487448);
  var mapOptions = {
    zoom: 20,	
    center: myLatLng,
		disableDoubleClickZoom: true,
    //mapTypeId: google.maps.MapTypeId.HYBRID
  };
  map = new google.maps.Map(document.getElementById("map_canvas"),
      mapOptions);
  poligono = new google.maps.Polygon({    
    strokeColor: "#FF0000",
    strokeOpacity: 0.8,
    strokeWeight: 3,
    fillColor: "#FF0000",
    fillOpacity: 0.35
  });
  poligono.setMap(map);
  google.maps.event.addListener(map, 'click', addLatLng);
  google.maps.event.addListener(map, 'rightclick', verificaPonto);
  google.maps.event.addListener(poligono, 'rightclick', verificaPonto);
}

function converteLocalLatLong(loja){
	var myLatLng;
	if(loja == "Illa Mangabeiras"){
  	myLatLng = new google.maps.LatLng(-9.6451775,-35.708607);
	}else if(loja == "Illa Serraria"){
  	myLatLng = new google.maps.LatLng(-9.611526,-35.718795);
	}else{
		myLatLng = new google.maps.LatLng(-9.54805,-35.724596);
	}
	return myLatLng;
}

function navega(myLatLng) {
	var mapOptions = {
    	zoom: 20,	
    	center: myLatLng,
			disableDoubleClickZoom: true,
    	mapTypeId: google.maps.MapTypeId.HYBRID
  };
  map = new google.maps.Map(document.getElementById("map_canvas"),
      mapOptions);
 	poligono = new google.maps.Polygon({    
   strokeColor: "#FF0000",
   strokeOpacity: 0.8,
   strokeWeight: 3,
   fillColor: "#FF0000",
   fillOpacity: 0.35
 	});
 	
	poligono.setMap(map);
	google.maps.event.addListener(map, 'click', addLatLng);
  google.maps.event.addListener(map, 'rightclick', verificaPonto);
	google.maps.event.addListener(poligono, 'rightclick', verificaPonto);
}

function calcula() {
        
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];
				var localPartida = document.getElementById("txtPartida").value;
				var localChegada = document.getElementById("txtChegada").value;
								
        var myLatLngPart = converteLocalLatLong(localPartida);
        var myLatLngCheg = converteLocalLatLong(localChegada);
				// Há possibilidade de calcular mais de um destino no mesmo mapa
        //var origin1 = {lat: -9.6451775, lng: -35.708607};
        //var origin1 = {lat: -9.6451775, lng: -35.708607};
        
        var mapOptions = {
					zoom: 20,	
					center: myLatLngPart,
					disableDoubleClickZoom: true,
					mapTypeId: google.maps.MapTypeId.HYBRID
				};
        
        // Há possibilidade de calcular mais de um destino no mesmo mapa
        //var destinationA = {lat: -9.54805, lng: -35.724596};
        //var destinationB = 'Stockholm, Sweden';
        //var destinationC = {lat: -9.54805, lng: -35.724596};

        var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';
        
        var map = new google.maps.Map(document.getElementById('map'), mapOptions); 
        
        // As opções do mapa podem ser passadas na sequencia ou criada uma variável à parte
        /*{
          center: {lat: 55.53, lng: 9.4},
          zoom: 10
        });
        */
        var geocoder = new google.maps.Geocoder;

        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix({
          origins: [myLatLngPart],
          destinations: [myLatLngCheg],
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
        }, function(response, status) {
          if (status !== 'OK') {
            alert('Error was: ' + status);
          } else {
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;
            var outputDiv = document.getElementById('output');
            outputDiv.innerHTML = '';
            deleteMarkers(markersArray);

            var showGeocodedAddressOnMap = function(asDestination) {
              var icon = asDestination ? destinationIcon : originIcon;
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  markersArray.push(new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                  }));
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };

            for (var i = 0; i < originList.length; i++) {
              var results = response.rows[i].elements;
              geocoder.geocode({'address': originList[i]},
                  showGeocodedAddressOnMap(false));
              for (var j = 0; j < results.length; j++) {
                geocoder.geocode({'address': destinationList[j]},
                    showGeocodedAddressOnMap(true));
                outputDiv.innerHTML += '<strong>De:</strong> '+ originList[i] + '<br>' + '<strong>Para:</strong> ' + destinationList[j] +'<br><strong>Distância:  </strong>' + results[j].distance.text +'<br><strong>Tempo:</strong>  ' + results[j].duration.text;
              }
            }
          }
        });
      }

      function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
      }


	</script>
  </head>
  <body onload="initialize()">
		
		<div class="container">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
  				<strong>SIRotas - Seja bem vindo!</strong> 
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
  			</button>
			</div>
			
			<div class="row">
				
				<div class="col-sm-4">
					<div class="row">				
						<h5>Navegar no Mapa: </h5>
					</div>
					<!-- <select id="selNavega" onchange="navega();">
						<option value="illaMang">Illa Mangabeiras</option>
						<option value="illaSerr">Illa Serraria</option>
						<option value="illaBBent">Illa B. Bentes</option>
					</select> -->
					
					<div class="row">
						<div class="dropdown" id="dropNavega">
						  <button class="btn btn-primary dropdown-toggle" type="button" 		
						  			id="dropMenuBtn" data-toggle="dropdown" aria-haspopup="true" aria-
						  			expanded="false">
							Carregar Mapa
						  </button>
						  	<div class="dropdown-menu" aria-labelledby="dropMenuBtn">
								<a class="dropdown-item" value="illaMang" href="#">Illa Mangabeiras</a>
								<a class="dropdown-item" value="illaSerr" href="#">Illa Serraria</a>
								<a class="dropdown-item" value="illaBBen" href="#">Illa B. Bentes</a>
						  </div>
						</div>
					</div>
					
					
				</div>
								
				<div class="col-sm-4">
					<div class="row">
						<h5>Cadastrar Entregador </h5>
					</div>		
					<div class="form-group">
						<label for="usr">Nome:</label>
						<input type="text" class="form-control" id="usr">
					</div>
					<div class="form-group">
						<label for="cpf">CPF:</label>
						<input type="text" class="form-control" id="cpf">
					</div>
					
					<!--<div class="form-group">
						<label for="pwd">Password:</label>
						<input type="password" class="form-control" id="pwd">
					</div>-->
				</div>
							
				<div class="col-sm-4">
					
					<div class="row">
						<h5>Medir Distância:</h5>
					</div>
					
					<div class="row">
						<div class="dropdown" id="dropPartida">
						  <button class="btn btn-secondary dropdown-toggle" type="button" 		
						  			id="dropMenuBtn" data-toggle="dropdown" aria-haspopup="true" aria-
						  			expanded="false">
							Partida
						  </button>
						  	<div class="dropdown-menu" aria-labelledby="dropMenuBtn">
								<a class="dropdown-item" value="illaMang" href="#">Illa Mangabeiras</a>
								<a class="dropdown-item" value="illaSerr" href="#">Illa Serraria</a>
								<a class="dropdown-item" value="illaBBen" href="#">Illa B. Bentes</a>
						  </div>
						</div>
						
					</div>
					<div class="row">
						<input type="text" class="form-control" id="txtPartida" placeholder="Partida">
					</div>
					
					<div class="row">
						<div class="dropdown" id="dropChegada">
						  <button class="btn btn-secondary dropdown-toggle" type="button" 		
						  			id="dropMenuBtn" data-toggle="dropdown" aria-haspopup="true" aria-
						  			expanded="false">
							Chegada
						  </button>
						  	<div class="dropdown-menu" aria-labelledby="dropMenuBtn">
								<a class="dropdown-item" value="illaMang" href="#">Illa Mangabeiras</a>
								<a class="dropdown-item" value="illaSerr" href="#">Illa Serraria</a>
								<a class="dropdown-item" value="illaBBen" href="#">Illa B. Bentes</a>
						  </div>
						</div>
					</div>
					<div class="row">
						<input type="text" class="form-control" id="txtChegada" placeholder="Chegada">
					</div>
					<div class="row">
						<button type="button" class="btn btn-primary btn-sm btn-block" value="Calcula" onclick="calcula();">Calcula</button>
					</div>
					
				</div>
	
		</div>
		
	</div>
		
			<div id="map_canvas" style="width:100%; height:60%"></div>
		
	</body>
	
	<footer>
	
	<div id="right-panel">
      
	  <div id="inputs">
		<div>
			<strong>Resultados</strong>
		</div>
	  <div id="output"></div>
	  <pre align="center">
      Dentre as opções do sistema há a possibilidade do mapa:
       * visualizar em modo satélite ou formato mapa;
       * saber o tempo de percurso em diversos meios de transporte;
       * saber o trânsito na região;
       * fazer uma rota com vários pontos.
        </pre>
      </div>
      
      
    </div>
    
    <div id="map"></div>
	
	</footer>
</html>
