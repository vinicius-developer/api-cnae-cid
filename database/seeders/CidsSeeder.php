<?php

namespace Database\Seeders;

use App\Models\Cid;
use Illuminate\Database\Seeder;

class CidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cids = (array) json_decode(file_get_contents(__DIR__ . '/arraysSeeders/cid10.json'));

        $arr = [];

        foreach($cids as $cid) {
            array_push($arr, (array) $cid);
        }

        Cid::insert($arr);
    }
}
