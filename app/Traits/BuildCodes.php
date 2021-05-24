<?php

namespace App\Traits;


/**
 * Traits BuildCodes
 * @package App\Traits
 */
Trait BuildCodes {

    /**
     * Get cnae characters and add punctuation
     *
     * @param string $cnae
     * @return string
     */
    public function buildCnae(string $cnae): string
    {
        return substr($cnae, 0, 4) . '-' . substr($cnae, 4, 1) . '/'. substr($cnae, -2);
    }

    /**
     * Get cid characters and add punctuation
     *
     * @param string $cid
     * @return string
     */
    public function buildCid(string $cid): string
    {
        if(strlen($cid) === 4) {

            return  substr($cid, 0, 3) . '.' . substr($cid,-1, 1);

        }

        return $cid;
    }


}

