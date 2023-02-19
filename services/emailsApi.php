<?php
include_once __DIR__.'/ApiCommon.php';

ApiCommon::init();

$util = ApiCommon::getUtil();

$emails = $util->getUsersEmails();

if ($emails != []) {
    ApiCommon::response($emails, 200, 'records found');
}
else {
    ApiCommon::response(NULL, 200, "No Record Found");
}
?>