<?php
namespace crawler\fetch;

require 'Fetch.php';

class FetchDecorator extends Fetch{
    public function getRawData($url, $cookies) {
        return 1;
    }
}