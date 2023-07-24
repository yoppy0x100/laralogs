<?php

namespace Yoppy0x100\LaraLogs;

use BadMethodCallException;
use Illuminate\Support\Facades\Http;

/* Available Methods
@methods request
@methods status
@methods delay
@methods city
@methods region
@methods regionCode
@methods regionName
@methods areaCode
@methods dmaCode
@methods countryCode
@methods countryName
@methods inEU
@methods euVATrate
@methods continentCode
@methods continentName
@methods latitude
@methods longitude
@methods locationAccuracyRadius
@methods timezone
@methods currencyCode
@methods currencySymbol
@methods currencySymbol_UTF8
@methods currencyConverter
*/
class Locations
{
    private $geoplugin;

    public function __construct($ip)
    {
        $this->geoplugin = Http::get('http://www.geoplugin.net/json.gp?ip=' . $ip)->json();
    }

    public function __call($key, $arguments)
    {
        $keyna = 'geoplugin_' . $key;
        if(!array_key_exists($keyna, $this->geoplugin)) {
            throw new BadMethodCallException();
        }

        return $this->geoplugin[$keyna];
    }
}
