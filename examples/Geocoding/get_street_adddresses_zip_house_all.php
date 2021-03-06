<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Geocoding;
	
	// Example refers to getting all geocodings wirh specified zipcode and house number.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');

	$gcParameters=(array)Geocoding::fromArray(array(
		"zipcode" => '00601',
		"housenumber" => 17
	));
	
	$geocoding = new Geocoding();
	
	$response = $geocoding->getService($gcParameters);
	
	Route4Me::simplePrint($response);
?>