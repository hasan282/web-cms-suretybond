<?php

namespace App\Libraries\Core;

class Hash
{
    private string $source;

    private string $key;

    private string $alpha;

    private int $length = 32;

    /**
     * constructor
     * @param int $length max 32
     * @param int $source 1 to 15
     */
    public function __construct(int $length, int $source, bool $upper = false)
    {
        $this->key    = '_tH1s_i5-a_d3faULt_kEy_';
        $this->length = $length > $this->length ? 32 : $length;

        $this->init($source, $upper);
    }

    public function hash(string $text, string $key = null): string
    {
        if ($key !== null) $this->key = $key;
        $texthash = hash_hmac('sha3-256', $text, $this->key);
        $textmd5  = md5($text);

        $hash    = $this->res32($texthash, $textmd5);
        $hashlen = strlen($hash);
        $offset  = $this->length < ($hashlen - 1) ?
            floor(($hashlen - $this->length) / 2) : 0;
        return substr($hash, $offset, $this->length);
    }

    private function init(int $source, bool $upper)
    {
        $this->alpha  = '0123456789abcdefghijklmnopqrstuvwxyz';

        $sources      = $this->source($upper);
        $sourcekey    = $source > 0 && $source <= sizeof($sources) ? $source : 1;
        $this->source = $sources[$sourcekey - 1];
    }

    private function res32(string $hash, string $addon): string
    {
        $res1   = substr($hash, 0, 32);
        $res2   = substr($hash, -32);
        $result = '';
        $srclen = strlen($this->source);
        for ($i = 0; $i < 32; $i++) {
            $pos =
                strpos($this->alpha, $res1[$i]) -
                strpos($this->alpha, $res2[31 - $i]) +
                strpos($this->alpha, $addon[$i]);
            if ($pos > $srclen - 1) $pos = $pos - $srclen;
            if ($pos < 0) $srclen + $pos;
            $result .= $this->source[intval($pos)];
        }
        return $result;
    }

    private function source(bool $mixed = false): array
    {
        $mix = array(
            'bUNrp07MaFYk8o9HhCJRqsDA1Veu2wPzytif5B4QmWZ6XTGS3cELvKxdn',
            'XHZJv9NGsUiAoBFkh1QC2e6fYKPaR04TpxbV58mrdLqucny7Wtz3wMSDE',
            'dNyw9kCs5MupmPqA3aBRbJFUGxEhfTvcLKW04HYez8onDt76iXQ12rZVS',
            'hoNRdXcGmZeWQuT6pviP8Lr2U3zV04DfEsA1HJFn5BCk9bM7YatSyKqxw',
            'zp43ELhmq8HAuR9PeavrWGoCZ5QnTXyt6ikVBDsJKFbf2Mc7xSU1dNwY0',

            'pQ2vfEU91A4FzYbDSM7qmVxtaNH0Xn5LkoPeCyshi38cRTGBd6WJuZrKw',
            '45xYGM1zDmBHUTXAepFbZ38t7kf9QRnvwPsar0cNq6hJyKC2oiuVdLWES',
            'eKbSX6QBZcdvUM5VTxkW0GY4D3tfa29JPohrqHRLswzN7E8uimAnpCF1y',
            'Hof4Nc5zU6nVLCXqPtSJQRmGY9ZkAesrwua1Ty8bhK2vEWFDMx7pBd30i',
            'DwuqyV3SL9Jz72Bks84mYbHFnr0RMKCdU6EfXWeZTN1QGtpxPiA5ohvac',

            'fSD5dZyA7hqCV1KLseQGb2MwrERk6mupnNWvPa0oJiF4XT39c8BYtxUzH',
            'PmQUbh0XRqNLr73BGkuxp2s6fnoFecHSJK1CTtazVZMAW4vE5Yy9Ddw8i',
            '2o8AvPnKUHsVbpZNWzcahtqwD7idM4LeyGSkxu9JrT1m6QBERFC3f0X5Y',
            'ENm1SWqLci0RMBw5Zu2hGFTnbtX3pQHY4oxdzK896eUsDfA7VaCvkJryP',
            'tQukcLmNPwbFR6qH5Kh8yJvA03EoZaf9T7YixdSVDB4GsXCMpenr1WU2z'
        );

        $low = array(
            'u1nyx5r7stdfbz628qiapc3k9h04e',
            'cf6y2abzuedqinpxt849531rhk0s7',
            '47etbrxsqhd60y38zcpi512un9afk',
            '96y2cdpu0ziqr7bat51hsnx4k3f8e',
            '10rkh74be9pzdy8qs32xifanc6u5t',

            'e65fsz1pyxdtan8hcbri9u4qk0723',
            'i7pzyu5et8hq01k926bc3ns4xfdar',
            'qcdk0n1xz9h53p4ur8sfae67b2iyt',
            '3sq9e2zydkpcf4binrh0x1a7u856t',
            'py0e18a7465hi9td3zru2nfqskcxb',

            'bt34ndr1a927ei5kyup6hzsx08qcf',
            '7hic56nu9ed8bfyq3a024r1tzkpsx',
            'scepyk6xz05dq1nu742rhfi938abt',
            'id68zut3ab0715pshy4ker9nqxc2f',
            '7ufy2z03419qtn8kdhc6b5aeirpxs'
        );

        return $mixed ? $mix : $low;
    }
}
