<?php
/*
 * send：
 * GET  http://localhost/restful/class  list all the class
 * GET  http://localhost/restful/class/1    get the particular class ( used for the different users?)
 * POST http://localhost/restful/class?name=SAT&count=23 create new class ( used for the new entry)
 * PUT  http://localhost/restful/class/1?name=SAT&count=23  update class information for class ( all information) 
 * PATCH  http://localhost/restful/class/1?name=SAT    update class information for class ( particular information) 
 * DELETE  http://localhost/restful/class/1      delete particular class
*/

/*
 * send：
 * GET  http://localhost/restful/class  list all the class
 * GET  http://localhost/restful/class/1    get the particular class ( used for the different users?)
 * POST http://localhost/restful/class?name=SAT&count=23 create new class ( used for the new entry)
 * PUT  http://localhost/restful/class/1?name=SAT&count=23  update class information for class ( all information)
 * PATCH  http://localhost/restful/class/1?name=SAT    update class information for class ( particular information)
 * DELETE  http://localhost/restful/class/1      delete particular class
*/
//data control
require('API/Request.php');
//output
require('API/Response.php');
//get data
$data = Request::getRequest();

//output result
Response::sendResponse($data);



