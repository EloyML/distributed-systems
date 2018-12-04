<?php
/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 13/10/2018
 * Time: 14:00
 */
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

function safe_redirect($url, $permament=true)
{
    if (!headers_sent()) {

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);
        header("Connection: close");
    }
};

	///setting all error variables to empty
	$errorEmail = $errorPass = $errorCPass = $passThrough = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
///////////////////////////////Start of Validation///////////////////////////////////
        $passThrough = true;

        if (empty($_POST["email"])) {

            $errorEmail = "Email is Required";
            $passThrough = false;

        } else if (!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))) {

            $errorEmail = "Invalid Email";
            $passThrough = false;

        } else {

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
                $passThrough = false;
                $errorEmail = "User Already Exists";
            } else{
                $_SESSION["email"] = $_POST["email"];
            }

//////Password Validation////////////////////
            if (empty($_POST["password"])) {

                $errorPass = "Password is Required";
                $passThrough = false;

            } else if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {

                $errorPass = "Password must be 8 to 20 characters";
                $passThrough = false;

            }

//////Confirm Password Validation////////////////////
            if (empty($_POST["cpass"])) {

                $errorCPass = "Confirm Password is Required";
                $passThrough = false;

            } else if (!($_POST["password"] === $_POST["cpass"])) {

                $errorCPass = "Passwords do not match";
                $passThrough = false;
            } else {

                $_SESSION["pass"] = $_POST["password"];
            }

//////Path decider////////////////////
            if ($passThrough) {

                safe_redirect("https://localhost/cloud/Config/RegisterSession.php", false);

            }
        }
	}
///////////////////End of Validation////////////////////////////////////
?>

