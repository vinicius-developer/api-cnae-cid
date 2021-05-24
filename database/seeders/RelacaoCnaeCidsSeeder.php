<?php

namespace Database\Seeders;

use App\Models\Cid;
use App\Models\Cnae;
use App\Models\RelacaoCnaeCid;
use Illuminate\Database\Seeder;

class RelacaoCnaeCidsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = (array) json_decode(file_get_contents(__DIR__ . '/arraysSeeders/cnaeCid.json'));

        foreach ($items as $item) {

            $idCnae = Cnae::select('id_cnae')->where('codigo', $item->cnae)->first()->id_cnae;

            $groupCids = explode("|", $item->cid);
            $inserts = [];

            foreach ($groupCids as $groupCid) {
                $cids = explode("-", $groupCid);
                $groupCids = [];


                foreach ($cids as $cid) {
                    array_push($groupCids, $cid);
                    for($i = 0; $i <= 9; $i++) {
                        $string = "$cid.$i";
                        array_push($groupCids, $string);
                    }
                }

                $objectCids = Cid::select('id_cid')->whereIn('codigo', $groupCids)->get()->pluck('id_cid');

                foreach ($objectCids as $cid) {
                    array_push($inserts, [
                        'id_cnae' => $idCnae,
                        'id_cid' => $cid
                    ]);
                }
            }

            RelacaoCnaeCid::insert($inserts);
        }

    }
}
