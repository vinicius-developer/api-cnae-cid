<?php

namespace Database\Seeders;

use App\Models\Cnae;
use Illuminate\Database\Seeder;

class CnaesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cnaes = (array) json_decode(file_get_contents(__DIR__ . '/arraysSeeders/cnaes.json'));

        $arr = [];

        foreach($cnaes as $cnae) {
            array_push($arr, (array) $cnae);
        }

        Cnae::insert($arr);
    }
}
