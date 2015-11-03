<?php
namespace crawler\fetch;

require_once 'FetchDecorator.php';

class FetchWiki extends FetchDecorator{
    private $_fetch;
    
    private $url = 'http://wiki.baidu.com/';
    
    const FETCH_TYPE = 2;

    public function __construct(Fetch $fetch) {
        $this->_fetch = $fetch;
    }
}