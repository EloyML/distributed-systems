<?php
/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 13/10/2018
 * Time: 12:50
 */
function safe_redirect($url, $permament=true)
{
    if (!headers_sent()) {

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
}

	$errorEmail= $errorPass= "";

	
	if($_SERVER["REQUEST_METHOD"] == "POST") {

        if (version_compare(phpversion(), '5.4.0', '<')) {
            if(session_id() == '') {
                session_start();
            }
        }
        else
        {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
		
		$passThrough = true;

		if(empty($_POST["email"])) {
            
            $errorEmail = "Email is Required";
            $passThrough = false;
         }
		else if (!(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))) {
        
       	    $errorEmail = "Invalid Email";
       	    $passThrough = false;
		}
		else if(empty($_POST["password"])) {

            $passThrough = false;
            $errorPass = "Password is Required";
        }
		else {

            $postData = http_build_query(
                array(
                    'email' => $_POST['email']
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
            $context = stream_context_create($opts);
            //sending out web request
            $contents = file_get_contents('https://localhost/apiDS/public/user/email/validate', false, $context);
            $result = json_decode($contents);

            if ($result){
                $email = $_POST['email'];
                $password = $_POST['password'];

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
                $context  = stream_context_create($opts);
                //sending out web request
                $check = file_get_contents('https://localhost/apiDS/public/user/login', false, $context);
                $data = json_decode($check, true);

                if ($data == null){
                    $passThrough = false;
                } else {

                    if (password_verify($password, $data['Pass'])) {
                        $_SESSION['userid'] = $data['ID'];
                        $_SESSION['email'] = $data['Email'];
                        $_SESSION['password'] = $data['Pass'];
                        $data = null;
                    } else{
                        $errorPass = "Incorrect Password";
                        $passThrough = false;
                    }
                }
            } else{
                $errorEmail = "Invalid Email";
                $passThrough = false;
            }
        }

		if($passThrough) {

            safe_redirect("https://localhost/cloud/CloudPage.php" , false);
		}
	}
?>