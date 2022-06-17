<?php

namespace App\Service;

class BaocaoService
{

    public function getweek(){
        $date_string = "2022-02-05";
        return date("W", strtotime($date_string));
    }

}