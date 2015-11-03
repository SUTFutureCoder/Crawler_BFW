<?php
namespace crawler\fetch;

require 'FetchFamily.php';
require 'FetchWiki.php';
require 'FetchRawData.php';

class FetchFactory {
    public static function fetchData($fetchType){
        $fetchType = (int)$fetchType;
        $fetch = new FetchRawData();
        if ($fetchType == FetchFamily::FETCH_TYPE){
            return new FetchFamily($fetch);
        } else if ($fetchType == FetchWiki::FETCH_TYPE){
            return new FetchWiki($fetch);
        }
    }
}