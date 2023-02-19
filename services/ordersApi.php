<?php
include_once __DIR__.'/ApiCommon.php';

ApiCommon::init();

$util = ApiCommon::getUtil();

if (isset($_GET['email']) && $_GET['email'] != "") {

    $rows = $util->getOrdersByUserEmail($_GET['email']) ;

    if ($rows != []) {
        ApiCommon::response($rows, 200, 'records found');
    }
    else {
        ApiCommon::response(NULL, 200, "No Record Found");
    }
}
else {
    ApiCommon::response(NULL, 400, "Invalid Request");
}
?>