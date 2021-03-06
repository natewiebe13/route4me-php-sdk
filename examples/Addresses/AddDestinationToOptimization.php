<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	use Route4Me\OptimizationProblem;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	// Get random route from test routes
	//--------------------------------------------------------
	$route=new Route();
	
	$route_id=$route->getRandomRouteId(0, 10);
	
	if (is_null($route_id)) {
		echo "can't retrieve random route_id!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	// Get random address's id from selected route above
	//--------------------------------------------------------
	$addressRand=(array)$route->GetRandomAddressFromRoute($route_id);
	$optimization_problem_id=$addressRand['optimization_problem_id'];
	
	if (is_null($optimization_problem_id)) {
		echo "can't retrieve random address!.. Try again.";
		return;
	}
	//--------------------------------------------------------
	
	$addresses=array();
	
	$address1=(array)Address::fromArray(array(
		'address' 	=>	'717 5th Ave New York, NY 10021',
		'alias'		=>	'Giorgio Armani',
		'lat'		=>	40.7669692,
		'lng'		=>	73.9693864,
		'time'		=>	0
	));

	$addresses[0]=$address1;
	
	$OptimizationParameters=(array)OptimizationProblem::fromArray(array(
		"optimization_problem_id"	=> $optimization_problem_id,
		"addresses"		=> $addresses,
		"reoptimize"	=> 1,
	));
	
	$optimizationproblem=new OptimizationProblem();
	
	$result=$optimizationproblem->update($OptimizationParameters);
	
	Route4Me::simplePrint($result);
?>