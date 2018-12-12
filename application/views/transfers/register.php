<!DOCTYPE html>
<html>
	<head>
		<?= $meta ?>
	    <title>AppCI | User Create</title>
	    <?= $favicon ?>

	    <!-- Google Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

		<?= $css ?>

		<style>
	      /* Always set the map height explicitly to define the size of the div
	       * element that contains the map. */
	      #map {
	        height: 100%;
	      }
	      /* Optional: Makes the sample page fill the window. */
	      html, body {
	        height: 100%;
	        margin: 0;
	        padding: 0;
	      }
	    </style>

		<!-- modernizr JS -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js" ></script>
	</head>
	<body>
		<?= $sidebar ?>
		<div class="all-content-wrapper">
			<?= $container_fluid_header ?>
			<div class="header-advance-area">
				<?= $header_top_area ?>
				<?= $mobile_menu ?>
				<div class="breadcome-area">
	                <div class="container-fluid">
	                    <div class="row">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                            <div class="breadcome-list">
	                                <div class="row">
	                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                                        <ul class="breadcome-menu">
	                                            <li><a href="<?php echo base_url('transfers/index'); ?>">Transfers</a> <span class="bread-slash">/</span>
	                                            </li>
	                                            <li><span class="bread-blod">Register</span>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div>
			<div class="section-admin container-fluid">
				<div class="row admin">
					<div class="col-md-12">
	                    <div class="row">
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
	                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
	                            	<div id="error"></div>
			                    	<?php
										echo form_open('assign/register',array('method' => 'POST', 'id' => 'loginForm'));
									?>
									<div id="origin" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                    			Origen:
		                    			<span class="text-danger"><strong><?= str_replace("%20", " ", urldecode($place1)) ?></strong></span>
		                    		</div>
		                    		<div id="destination" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		                    			Destino:
		                    			<span class="text-danger"><strong><?= str_replace("%20", " ", urldecode($place2)) ?></strong></span>
		                    		</div>
		                    		<br/><br/>
									<div class="form-group col-lg-12" id="distance">
										<?php
											echo form_label('Distancia (Aproximada)', 'distance');
											echo form_input(array('type' => 'text', 'name' => 'distance', 'placeholder' => 'Ej. 1500km', 'class' => 'form-control', 'readonly' => '', 'value' => $distance.' '.$time));
										?>
										<span class="text-danger" style="display: none;"></span>
			                        </div>
			                        <div class="form-group col-lg-12" id="cobro">
										<?php
											echo form_label('Valor cobro', 'cobro');
											echo form_input(array('type' => 'text', 'name' => 'cobro', 'placeholder' => 'Ej. 50000', 'class' => 'form-control', 'value' => set_value('cobro')));
										?>
										<span class="text-danger" style="display: none;"></span>
			                        </div>
									<div class="text-center">
										<?php
											echo form_submit('submit', 'Guardar', array('class' => 'btn btn-lg btn-success loginbtn'));
										?>
									</div>
									<?php
										echo form_close();
									?>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	                        </div>
	                    </div>
	                </div>
				</div>
			</div>
			<br/>
		</div>
		<div id="map" style="margin: auto; height: 60%;width: 60%;"></div>
		<br/>
		<?= $footer ?>
		<?= $script ?>
		<script>
	      function initMap() {

	        var map = new google.maps.Map(document.getElementById('map'), {
	          zoom: <?php echo $zoom; ?>,
	          center: {lat: <?php echo $medium1; ?>, lng: <?php echo $medium2; ?>}
	        });

	        // Create an array of alphabetical characters used to label the markers.
	        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	        // Add some markers to the map.
	        // Note: The code uses the JavaScript Array.prototype.map() method to
	        // create an array of markers based on a given "locations" array.
	        // The map() method here has nothing to do with the Google Maps API.
	        var markers = locations.map(function(location, i) {
	          return new google.maps.Marker({
	            position: location,
	            label: labels[i % labels.length]
	          });
	        });

	        // Add a marker clusterer to manage the markers.
	        var markerCluster = new MarkerClusterer(map, markers,
	            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	      }

	      var locations = [
	        {lat: <?php echo $lat1; ?>, lng: <?php echo $lon1; ?>},
	        {lat: <?php echo $lat2; ?>, lng: <?php echo $lon2; ?>}
	      ]
	    </script>
	    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
	    <script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG_pi6EPRdsa9iU-2eGW8FUXCUDD5eB48&callback=initMap">
	    </script>
	</body>
</html>