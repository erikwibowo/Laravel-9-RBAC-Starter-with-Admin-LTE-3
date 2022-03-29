<?php

namespace App\Helpers;

use App\Models\Setting;

class SettingHelper
{
    public static function getValue(string $key)
    {
        return Setting::where(['key' => $key])->first()->value;
    }

    public static function getName(string $key)
    {
        return Setting::where(['key' => $key])->first()->name;
    }

    public static function getType(string $key)
    {
        return Setting::where(['key' => $key])->first()->type;
    }

    public static function getExt(string $key)
    {
        return Setting::where(['key' => $key])->first()->ext;
    }
}
