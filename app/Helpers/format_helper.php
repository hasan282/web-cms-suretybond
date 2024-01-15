<?php

if (!function_exists('create_id')) {
    /** Format ID YYMMDDHHIISS (Length 12) ditambah Suffix Angka Random
     * @param int $suffix Length angka random
     * @return string ID yang dihasilkan.
     */
    function create_id(int $suffix = 4, $randomize = false)
    {
        if ($randomize) {
            $time = strtotime('-' . mt_rand(1, 9999999) . ' seconds');
            $dateid = date('ymdHis', $time);
        } else {
            $dateid = date('ymdHis');
        }
        $suffix_value = '';
        if ($suffix > 0) {
            if ($suffix === 1) {
                $suffix_value .= mt_rand(0, 9);
            } else {
                $min = str_pad('1', $suffix, '0');
                $max = str_pad('9', $suffix, '9');
                $suffix_value .= mt_rand(intval($min), intval($max));
            }
        }
        return $dateid . $suffix_value;
    }
}
