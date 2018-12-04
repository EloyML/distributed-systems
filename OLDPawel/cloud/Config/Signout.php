<?php
/**
 * Created by PhpStorm.
 * User: Pawel
 * Date: 14/10/2018
 * Time: 01:30
 */
function safe_redirect($url, $permament=true)
{

    if (!headers_sent()) {

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $url);

        // Optional workaround for an IE bug (thanks Olav)
        header("Connection: close");
    }
}
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
session_destroy();

safe_redirect("https://localhost/cloud/HomePage.html" , false);