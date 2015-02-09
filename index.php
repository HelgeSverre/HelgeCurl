<?php

use Helge\cURL;

require_once("Curl.php");

$url = "https://helgesverre.com/libs/ajax_domaincheck.php";

$curl = new cURL($url);
$curl->setUserAgent("Helge cURL");
$curl->setPostFields(array(
    "domain" => "magicponies555.com"
));

$result = $curl->Execute();
$curl->Close();

print_r($result);