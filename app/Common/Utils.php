<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/12/2017
 * Time: 8:34 PM
 */

namespace Common;

use Illuminate\Support\Facades\File;

require_once 'Hashing.php';

/**
 * @param $userId
 * @return string
 */
function generateToken($userId)
{
    $fullString = $userId.SECURE_STRING_TOKEN.randString(8);
    return strong_hashing($fullString);
}

function randString($length)
{
    $rs = array();
    for ($i = 0; $i < $length; $i++)
    {
        array_push($rs, alphabet[random_int(0, 61)]);
    }
    return implode('', $rs);
}

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb");
    $data = explode(',', $base64_string);
    fwrite($ifp, base64_decode($data[1]));
    fclose($ifp);
    return $output_file;
}

function removeHashPrefix($string){
    static $_hashPrefix = '$2y$10$';
    if (strpos($string, $_hashPrefix) === 0)
        return substr($string, strlen($_hashPrefix));
    else
        return $string;
}

function putHashPrefix($string){
    static $_hashPrefix = '$2y$10$';
    return $_hashPrefix.$string;
}

