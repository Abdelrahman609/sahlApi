<?php

use \Psr\Http\Message\ServerRequestInterface as Request;

use \Psr\Http\Message\ResponseInterface as Response;



//handle http request to select all from categories

$app->get('/key/{apikey}/cats', function(Request $req, Response $res){

  //array to calculate the information and send it to user as json
	$response = array();

  //get and test the api key
  $key = $req->getAttribute('apikey');

  // check the condition of api key

  if($key == '1234') {
    // 	connect to the database
    $obj = new dbConfig();

    // if connection is true
    if($obj->report['connection_error'] == 'false') {
      $data = $obj->fetchData('category');

      if($data['fetch'] == 'true') {
        $response['code']=200;
        $response['status']='success';
        $response['message']='shop fetched successfuly';
        $response['data'] = $data['data'];
        echo json_encode($response);
      }
      else
      {
          $response['code']=204;
          $response['status']='no content';
          $response['message']= 'No categories yet';
          echo json_encode($response);
      }

    }
    // if there connecton error
    else {
      //send json response to user
            $response['code']=500;
            $response['statu']='internal server error';
            $response['message']='connection error';
            echo json_encode($response);
    }
  }
  else {

    //send json response to user

		$response['code']=401;

		$response['status']='unauthorized';

		$response['message']='invalid api key';

		echo json_encode($response);
  }

});
