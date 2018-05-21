<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Hashids\Hashids;

class GeoInfo
{

    /**
     * @param string $ip
     * @return string
     */
    public function getCountryNameByIp(string $ip) : string
    {
        $geoInfo = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"), true);

        return $geoInfo['country_name'] ?? 'N/A';

    }
}