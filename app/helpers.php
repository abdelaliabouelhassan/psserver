<?php

use Longman\IPTools\Ip;

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


?>