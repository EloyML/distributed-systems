<?php
/*
 * send：
 * GET  http://localhost/api/class  list all the class
 * GET  http://localhost/api/class/1    get the particular class ( used for the different users?)
 * POST http://localhost/api/class?name=SAT&count=23 create new class ( used for the new entry)
 * PUT  http://localhost/api/class/1?name=SAT&count=23  update class information for class ( all information) 
 * PATCH  http://localhost/api/class/1?name=SAT    update class information for class ( particular information) 
 * DELETE  http://localhost/api/class/1      delete particular class
*/
//data control
require('Request.php');
//output
require('Response.php');
//get data

 
//---------testing login
/*
header("Content-type: text/html; charset=utf-8");
  
  function validate($user, $pass) {
      $users = ['user'=>'user', 'admin'=>'admin'];
      if(isset($users[$user]) && $users[$user] === $pass) {
          return true;
      } else {
          return false;
     }
  }
 
  if(!validate(@$_SERVER['PHP_AUTH_USER'], @$_SERVER['PHP_AUTH_PW'])) {
      http_response_code(401);
      header('WWW-Authenticate:Basic realm="My website"'); // http://127.0.0.3  
      echo 'need username and password'; //
      exit;
  } else {
     // var_dump($_SERVER['PHP_AUTH_USER']);
     // var_dump($_SERVER['PHP_AUTH_PW']);
  }
*/
//---------end testing



$data = Request::getRequest();
//output result
Response::sendResponse($data);

