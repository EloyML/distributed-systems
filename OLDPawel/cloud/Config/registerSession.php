<?php
/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 13/10/2018
 * Time: 12:24
 */
	function safe_redirect($url, $permament=true)
	{
		if (!headers_sent()) {

			header('HTTP/1.1 301 Moved Permanently');
			header('Location: ' . $url);
			header("Connection: close");
		}
	}
	if (version_compare(phpversion(), '5.4.0', '<')) {
		
		if(session_id() == '') {
			
			session_start();
		}
	}
	else {
		
		if (session_status() == PHP_SESSION_NONE) {
			
			session_start();
		}
	}
	
	if (isset($_POST["email"])){
		
		$_SESSION["email"] = $_POST["email"];
	}
	
	if (isset($_POST["pass"])){
		
		$_SESSION["pass"] = $_POST["pass"];
	}

    $email = $_SESSION["email"];
    $password = $_SESSION["pass"];

    $postData = http_build_query(
        array(
            'email' => $email,
            'password' => $password
        )
    );

    $opts = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postData,
        ),
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
        )
    );
    //set up request content
    $context  = stream_context_create($opts);
    //sending out web request
    $result = file_get_contents('https://localhost/apiDS/public/user/add', false, $context);

    // redirect to login page
    if ($result){

        safe_redirect("https://localhost/cloud/LoginPage.php" , false);
    }
?>