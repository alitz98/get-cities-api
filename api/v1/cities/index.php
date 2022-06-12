<?php

include "../../../autoloader.php";

use App\Services\CityService;
use app\Utilities\Response;
use app\Utilities\Validator;



$method=$_SERVER['REQUEST_METHOD'];

$request_body=json_decode(file_get_contents('php://input'),true);

$city_service=new CityService();

switch ($method) {

    case 'GET':
      
        $validator=new Validator();

        $province_id=$_GET['province_id']?? null;
        $page=$_GET['page']??null;
        $page_size=$_GET['page_size']?? null;
        $fields=$_GET['fields']?? "*";


        if(!$validator->province_validate($province_id)){

            Response::respondeAndDie(['Error: Invalid province...'],Response::HTTP_NOT_FOUND);
    }
        $data=["province_id"=>$province_id,
                "page"=> $page,
                "page_size"=> $page_size,
                "fields"=>$fields
             ];

        $response=$city_service->getsities($data);

         Response::respondeAndDie($response,Response::HTTP_OK);
        

    
    case 'POST':

        if(!isValidCity($request_body)){

            Response::respondeAndDie(['not invalid request...'],Response::HTTP_NOT_ACCEPTABLE);
        }
        $response=$city_service->addcity($request_body); 

        Response::respondeAndDie($response,Response::HTTP_OK);
        
        

    case 'PUT':
        [$city_id,$name]=[$request_body['city_id'],$request_body['name']];

        $response=$city_service->updatecity($city_id,$name);
        Response::respondeAndDie($response,Response::HTTP_OK);
        
        

    case 'DELETE':

        $response=$city_service-> deletecity($request_body['city_id']);
        Response::respondeAndDie($response,Response::HTTP_OK);
        
    
    default :      
    Response::respondeAndDie(['not acces'],Response::HTTP_NOT_ACCEPTABLE);  
}

