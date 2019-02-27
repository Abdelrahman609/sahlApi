<?php

use \Psr\Http\Message\ServerRequestInterface as Request;

use \Psr\Http\Message\ResponseInterface as Response;



//handle http request to select all from items

$app->get('/key/{apikey}/items', function(Request $req, Response $res){

  //array to calculate the information and send it to user as json
	$response = array();

  //get and test the api key
  $key = $req->getAttribute('apikey');

  // check the condition of api key

  if($key == '1234') {

    $response['code'] = 200;
    $response['status'] = 'authorized';
    $response['message'] = 'valid api key';

    echo json_encode($response);

  }
  else {

    //send json response to user

		$response['code']=401;

		$response['status']='unauthorized';

		$response['message']='invalid api key';

		echo json_encode($response);
  }

});
