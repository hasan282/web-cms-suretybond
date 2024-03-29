<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
    public function run()
    {
        $this->call('Menu');

        $this->call('Access');
        $this->call('MenuAccess');

        $this->call('Agent');
        $this->call('User');
    }
}
