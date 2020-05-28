<?php

namespace helpers;

class Utils
{
    public static function createSambaConnection(array $samba_share_details)
    {
        if(!isset($samba_share_details['host'])
        || !isset($samba_share_details['domain'])
        || !isset($samba_share_details['user'])
        || !isset($samba_share_details['pass'])
        || !isset($samba_share_details['share'])){
            throw(new \Exception('Samba connection information is not configured correctly'));
        }

        $connection = new \helpers\SambaConnection(
            $samba_share_details['host'],
            $samba_share_details['share'],
            $samba_share_details['user'],
            $samba_share_details['pass'],
            $samba_share_details['domain'],
        );

        return $connection;
    }
}