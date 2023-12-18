<?php

/**
 * global hash key for application
 */
define('HASH_KEYWORD', md5('_y0ur_k3YwoRd_i5_s3tup_!n_tH!s_vAr_'));

if (!function_exists('sha3hash')) {
    /**
     * hash string with sha3-256
     * @param string $text a string text
     * @param int $length max length 64
     */
    function sha3hash(string $text, int $length = 32): string
    {
        $chars  = $length < 64 ? $length : 64;
        $offset = $chars < (64 - 1) ? floor((64 - $chars) / 2) : 0;
        $result = hash_hmac('sha3-256', $text, HASH_KEYWORD);
        return substr($result, $offset, $chars);
    }
}

if (!function_exists('myhash')) {
    /**
     * hash string with A-Z result
     * @param string $text a string text
     * @param int $length result length max 32
     * @param bool $random randomize source
     */
    function myhash(string $text, int $length = 32, bool $random = false): string
    {
        $source = $random ? mt_rand(1, 15) : 9;
        $hash   = new \App\Libraries\Core\Hash($length, $source);
        return $hash->hash($text, HASH_KEYWORD);
    }
}

if (!function_exists('hash_match')) {
    function hash_match(string $text, string $hash)
    {
        $results = array();
        $length  = strlen($hash);
        for ($h = 0; $h < 15; $h++) {
            $hashlib   = new \App\Libraries\Core\Hash($length, $h + 1);
            $results[] = $hashlib->hash($text, HASH_KEYWORD);
        }
        return in_array($hash, $results);
        // return $results;
    }
}
