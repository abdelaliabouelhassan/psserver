<?php

use Longman\IPTools\Ip;
use App\BacklinkChecker;
function get_ip_version_from_ip_address(string $ip)
{
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        return 4;
    }

    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return 6;
    }

    return false;
}

function compare_ip_addresses(string $ip1, string $ip2): bool
{
    $ipv_1 = get_ip_version_from_ip_address($ip1);
    $ipv_2 = get_ip_version_from_ip_address($ip2);

    // If the Internet Protocol addresses are invalid.
    if ($ipv_1 === false || $ipv_2 === false) {
        return false;
    }

    // If the Internet Protocol versions differ.
    if ($ipv_1 !== $ipv_2) {
        return false;
    }

    $ip2 .= '/' . ($ipv_2 === 4 ? '24' : '64');

    return Ip::match($ip1, $ip2);
}
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



function checkBackLink($url, $url_name){
    $checker = new BacklinkChecker\SimpleBacklinkChecker();
    $pattern = "@https?://(www\.)?" . $url_name. ".*@";
    $scan_Back_links = true;
    $scan_Hot_links = false;
    $make_Screenshot = false;

    try {
        $result = $checker->getBacklinks($url, $pattern, $scan_Back_links, $scan_Hot_links, $make_Screenshot);
        $response = $result->getResponse();
        if ($response->getSuccess()) {
             $links = $result->getBacklinks();
            if (sizeof($links) > 0) {
                //Backlinks found
                return true;
            } else {
                //No backlinks found
                return false;
            }
        } else {
            //Error, usually network error, or server error
            die("Error, HTTP Code " . $response->getStatusCode());
        }
    } catch (RuntimeException $e) {
        die("Error: " . $e->getMessage());
    }
}

function checkRecaptcha($key,$response){
    $recaptcha = new \ReCaptcha\ReCaptcha($key);
    $gRecaptchaResponse = $response;
    $remoteIp = getIPAddress();
    $resp = $recaptcha
        ->verify($gRecaptchaResponse, $remoteIp);
    if ($resp->isSuccess()) {
        return true;
    } else {
         return false;
    }

}


?>