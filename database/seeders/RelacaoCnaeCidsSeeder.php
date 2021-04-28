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
            $objectCids = [];
            $inserts = [];

            foreach ($groupCids as $groupCid) {
                $arrLastAndInitalCids = explode("-", $groupCid);

                $letter = $arrLastAndInitalCids[0][0];
                $initial = preg_replace('/[a-zA-Z]/', '', $arrLastAndInitalCids[0]);
                $allCids = [];

                if (count($arrLastAndInitalCids) > 1) {
                    $final = preg_replace('/[a-zA-Z]/', '', $arrLastAndInitalCids[1]);
                    for ($i = (int) $initial; $i <= $final; $i++) {
                        $number = $i > 9 ? $i : 0 . $i;
                        array_push($allCids, $letter . $number);

                        for ($subNumber = 0; $subNumber <= 9; $subNumber++) {
                            $subCid = $letter . $number . '.' . $subNumber;
                            array_push($allCids, $subCid);
                        }
                    }
                } else {
                    $number = $letter . $initial;
                    array_push($allCids, $number);

                    for ($subNumber = 0; $subNumber <= 9; $subNumber++) {
                        $subCid = $letter . $initial . '.' . $subNumber;
                        array_push($allCids, $subCid);
                    }
                }
                $objectCids = Cid::select('id_cid')->whereIn('codigo', $allCids)->get()->pluck('id_cid');
            }

            foreach ($objectCids as $cid) {
                array_push($inserts, [
                    'id_cnae' => $idCnae,
                    'id_cid' => $cid
                ]);
            }

            RelacaoCnaeCid::insert($inserts);
        }

    }
}
