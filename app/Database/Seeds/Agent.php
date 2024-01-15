<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Agent extends Seeder
{
    public function run()
    {
        $agent = array(

            [
                'nama'   => 'PT JASMINE INDAH SERVISTAMA',
                'nick'   => 'JIS',
                'alamat' => 'Ruko Mutiara, Jl. Nusantara No. 1B, Pasir Gunung, Cimanggis, Depok 16451',
                'telpon' => '021-22824746',
                'tipe'   => 'HEAD'
            ],
            [
                'nama'   => 'PT BEYORA NUSANTARA JAYA',
                'nick'   => 'BEYORA',
                'alamat' => 'Jl. Kampus RT.016 RW.004, Kel. Dukuh, Kec. Kramatjati, Jakarta Timur',
                'telpon' => null,
                'tipe'   => 'SUB'
            ],
            [
                'nama'   => 'PT PUTRA JALAKSANA',
                'nick'   => 'PUJA',
                'alamat' => 'Jl. Budaya No.60-A Batu Ampar, Kramat Jati, Condet, Jakarta Timur',
                'telpon' => null,
                'tipe'   => 'SUB'
            ],
            [
                'nama'   => 'PT LINTAS SOLUSI MANDIRI',
                'nick'   => 'LSM',
                'alamat' => "Jl. As-syafi'iyah No.15-E RT.007 RW.003, Kel. Cilangkap, Kec. Cipayung, Jakarta Timur",
                'telpon' => null,
                'tipe'   => 'SUB'
            ],

        );
        $this->db->table('d_agent')->insertBatch(
            $this->setup($agent)
        );
    }

    private function setup(array $data): array
    {
        $agent = [];
        helper(['format', 'hash']);
        foreach ($data as $dat) {

            $row['id']     = create_id(4, true);
            $row['hash']   = 'ag' . myhash($row['id'], 28, true);
            $row['nama']   = $dat['nama'];
            $row['nick']   = $dat['nick'];
            $row['alamat'] = $dat['alamat'];
            $row['telpon'] = $dat['telpon'];
            $row['tipe']   = $dat['tipe'];
            $row['active'] = 1;

            $agent[] = $row;
        }
        return $agent;
    }
}
