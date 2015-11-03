<?php
namespace crawler\fetch;

require_once 'FetchDecorator.php';

class FetchFamily extends FetchDecorator{
    private $_fetch;
    
    private $url = 'http://jishu.family.baidu.com/';
    
    const FETCH_TYPE = 1;
    
    public function __construct(Fetch $fetch) {
        $this->_fetch = $fetch;
    }
    
    public function getData($cookies) {
        return $this->_fetch->getRawData($this->url, $cookies);
    }
}