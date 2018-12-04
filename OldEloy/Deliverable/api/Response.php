<?php
/**
 * output class
 */
class Response
{
    const HTTP_VERSION = "HTTP/1.1";

    //return result
    public static function sendResponse($data)
    {
        //get data
        if ($data) {
            $code = 200;
            $message = 'OK';
        } else {
            $code = 404;
            $data = array('error' => 'Not Found');
            $message = 'Not Found';
        }

        //output result
        header(self::HTTP_VERSION . " " . $code . " " . $message);
        $content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : $_SERVER['HTTP_ACCEPT'];
        if (strpos($content_type, 'application/json') !== false) {
            header("Content-Type: application/json");
            echo self::encodeJson($data);
        } else if (strpos($content_type, 'application/xml') !== false) {
            header("Content-Type: application/xml");
            echo self::encodeXml($data);
        } else {
            header("Content-Type: text/html");
            echo self::encodeHtml($data);
        }
    }

    //json 
    private static function encodeJson($responseData)
    {
        return json_encode($responseData);
    }

    //xml
    private static function encodeXml($responseData)
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><rest></rest>');
        foreach ($responseData as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $xml->addChild($k, $v);
                }
            } else {
                $xml->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

    //html
    private static function encodeHtml($responseData)
    {
        $html = "<br/><table class=\"table table-striped\">";
        foreach ($responseData as $key => $value) {
            $html .= "<tr>";
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $html .= "<td style=\"padding:10px\">" . $k . "</td><td style=\"padding:10px\">" . $v . "</td>";
                }
            } else {
                $html .= "<td style=\"padding:10px\">" . $key . "</td><td style=\"padding:10px\">" . $value . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table><br/>";
        return $html;
    }
}