<?php

namespace App\Libraries;

class Terbilang
{
    protected $bilangan;

    public function __construct()
    {
        $this->bilangan = array(
            '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam',
            'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'
        );
    }

    public function terbilang(string $angka)
    {
        if (preg_match('/^[0-9.]+$/', $angka) !== 1) {
            return null;
        }
        $angka = strval(floatval($angka));
        if (strpos($angka, '.') === false) {
            if ($angka + 0 === 0) {
                return 'Nol';
            }
            return $this->terjemahkanAngka($angka);
        }
        list($angka, $desimal) = explode('.', $angka, 2);
        if ($angka + 0 === 0) {
            return 'Nol Koma ' . $this->terjemahkanPerAngka($desimal);
        }
        return rtrim($this->terjemahkanAngka($angka) . ' Koma ' . $this->terjemahkanPerAngka($desimal));
    }

    protected function terjemahkanAngka($angka)
    {
        if ($this->lebihKecilDari($angka, '12')) {
            return $this->bilangan[$angka];
        }
        if ($this->lebihKecilDari($angka, '20')) {
            return $this->bilangan[$angka - 10] . ' Belas';
        }
        if ($this->lebihKecilDari($angka, '100')) {
            $hasilBagi = $this->bulatkanKebawah($angka / 10);
            $hasilMod = $angka % 10;
            return rtrim(sprintf(
                '%s Puluh %s',
                $this->bilangan[$hasilBagi],
                $this->bilangan[$hasilMod]
            ));
        }
        if ($this->lebihKecilDari($angka, '200')) {
            return rtrim(sprintf('Seratus %s', $this->terjemahkanAngka($angka - 100)));
        }
        if ($this->lebihKecilDari($angka, '1000')) {
            $hasilBagi = $this->bulatkanKebawah($angka / 100);
            $hasilMod = $angka % 100;
            return rtrim(sprintf(
                '%s Ratus %s',
                $this->bilangan[$hasilBagi],
                $this->terjemahkanAngka($hasilMod)
            ));
        }
        if ($this->lebihKecilDari($angka, '2000')) {
            return rtrim(sprintf('Seribu %s', $this->terjemahkanAngka($angka - 1000)));
        }
        if ($this->lebihKecilDari($angka, '1000000')) {
            $hasilBagi = $this->bulatkanKebawah($angka / 1000);
            $hasilMod = $angka % 1000;
            return rtrim(sprintf(
                '%s Ribu %s',
                $this->terjemahkanAngka($hasilBagi),
                $this->terjemahkanAngka($hasilMod)
            ));
        }
        if ($this->lebihKecilDari($angka, '1000000000')) {
            $hasilBagi = $this->bulatkanKebawah($angka / 1000000);
            $hasilMod = $angka % 1000000;
            return rtrim(sprintf(
                '%s Juta %s',
                $this->terjemahkanAngka($hasilBagi),
                $this->terjemahkanAngka($hasilMod)
            ));
        }
        if ($this->lebihKecilDari($angka, '1000000000000')) {
            $hasilBagi = $this->bulatkanKebawah(bcdiv($angka, '1000000000'));
            $hasilMod = bcmod($angka, '1000000000');
            return rtrim(sprintf(
                '%s Milyar %s',
                $this->terjemahkanAngka($hasilBagi),
                $this->terjemahkanAngka($hasilMod)
            ));
        }
        if ($this->lebihKecilDari($angka, '1000000000000000000000000')) {
            $hasilBagi = $this->bulatkanKebawah(bcdiv($angka, '1000000000000'));
            $hasilMod = bcmod($angka, '1000000000000');
            return rtrim(sprintf(
                '%s Triliun %s',
                $this->terjemahkanAngka($hasilBagi),
                $this->terjemahkanAngka($hasilMod)
            ));
        }
        $hasilBagi = $this->bulatkanKebawah(bcdiv($angka, '1000000000000000000000000'));
        $hasilMod = bcmod($angka, '1000000000000000000000000');
        return rtrim(sprintf(
            '%s Septiliun %s',
            $this->terjemahkanAngka($hasilBagi),
            $this->terjemahkanAngka($hasilMod)
        ));
    }

    public function terjemahkanPerAngka($angka)
    {
        $bilangan = $this->bilangan;
        $bilangan[0] = 'Nol';
        $terbilang = [];
        $length = strlen($angka);
        for ($i = 0; $i < $length; $i++) {
            $index = (int)$angka[$i];
            $terbilang[] = $bilangan[$index];
        }
        return implode(' ', $terbilang);
    }

    protected function lebihKecilDari($x, $y)
    {
        return bccomp($x, $y) === -1 ? true : false;
    }

    protected function bulatkanKebawah($angka)
    {
        return bcadd($angka, 0);
    }

    public function t($angka)
    {
        return $this->terbilang($angka);
    }
}
