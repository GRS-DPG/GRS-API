<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class BanglaConverterServices
{
    public function convertDateTimeBangla($date)
    {

        $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০", "অপরাহ্ন", "পুর্বাহ্ন", ":", ",","পুর্বাহ্ন","অপরাহ্ন");

        $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "PM", "AM", ":", ",","am","pm");

        // convert all English char to bangla char
        $bn_number = str_replace($search_array,$replace_array, $date);

        return $bn_number;
    }

    public function convertNumberBangla($number)
    {
        $bn = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];

        $en = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        return str_replace($en, $bn, $number);
    }





}
