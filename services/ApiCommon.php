<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
include_once __DIR__ . '/../data/Util.php';

class  ApiCommon
{
    public static function getUtil() {
        return new Util();
    }
    public static function init()
    {
        $u = self::getUtil();
        //genero le tabelle
        $u->init();
    }
    public static function response($rows, $response_code, $response_desc)
    {
        $response['orders'] = $rows;
        $response['response_code'] = $response_code;
        $response['response_desc'] = $response_desc;

        $json_response = json_encode($response);

        echo $json_response;
    }
}
