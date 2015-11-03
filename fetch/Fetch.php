<?php
namespace crawler\fetch;

abstract class Fetch{
    abstract function getRawData($url, $cookies);
}