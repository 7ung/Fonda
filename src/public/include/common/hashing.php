<?php
/**
 * Created by DoAnChuyenNganhTeam
 * User: TungHH
 * Date: 03/17/2017
 * Time: 8:42 PM
 */

namespace common;

require_once __DIR__.'/../config.php';

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