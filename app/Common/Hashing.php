<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 04/11/2017
 * Time: 10:37 AM
 */

namespace Common;


const alphabet ='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
const QUICK_HASH_SALT = '$1$Olt2e0$';
const STRONG_HASH_ARGTH = PASSWORD_BCRYPT;
const STRONG_HASH_COST = 10;
const SECURE_STRING_TOKEN = 'seuitk8';

function quick_hashing($str)
{
    $hashedStr = crypt($str, QUICK_HASH_SALT);
    return substr($hashedStr, strlen(QUICK_HASH_SALT));
}

function verify_quick_hash($verifyStr, $hashedStr)
{
    return password_verify($verifyStr, QUICK_HASH_SALT.$hashedStr);
}

function strong_hashing($str)
{
    return password_hash($str, STRONG_HASH_ARGTH, ['cost' => STRONG_HASH_COST]);
}

function verify_string($string, $hashedString)
{
    return password_verify($string, $hashedString);
}

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