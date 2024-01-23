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

if (!function_exists('id2date')) {
    /**
     * Convert ID 12+ to Date Format
     * @param string $id 12+ length id
     * @param string $format date format with YMDHIS
     * @return string formatted id
     */
    function id2date(string $id, string $format = 'Y-M-D H:I:S'): string
    {
        $year = '20' . substr($id, 0, 2);
        $month = substr($id, 2, 2);
        $day = substr($id, 4, 2);
        $hour = substr($id, 6, 2);
        $minute = substr($id, 8, 2);
        $second = substr($id, 10, 2);
        return str_replace(array(
            'Y', 'M', 'D', 'H', 'I', 'S'
        ), array(
            $year, $month, $day, $hour, $minute, $second
        ), $format);
    }
}
