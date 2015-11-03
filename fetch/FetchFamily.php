<?php
namespace crawler\fetch;

require_once 'FetchDecorator.php';
require 'phpQuery/phpQuery/phpQuery.php';

class FetchFamily extends FetchDecorator{
    private $_fetch;
    
    private $url = 'http://jishu.family.baidu.com/detail?articleId=';
    
    private $imgSavePath = 'images/family/';
    
    const FETCH_TYPE = 1;
    
    public function __construct(Fetch $fetch) {
        $this->_fetch = $fetch;
    }
    
    public function getData($cookies) {
        //循环抓取
        $data = array();
        $i = 3031;
        $url = $this->url . $i;
        $htmlData = $this->_fetch->getRawData($url, $cookies);
        \phpQuery::newDocumentHTML($htmlData);
        $detailTitle    = pq('.detailTitleMain');
        $data['articleSection'] = pq('.crumb a:eq(1)')->html();
        $data['articleTitle']   = $detailTitle->find('span:eq(0)')->html();
        $data['articleAuthor']  = $detailTitle->find('.userName')->html();
        $data['authorSection']  = mb_substr($detailTitle->find('div span:eq(1)')->html(), 3, null, 'utf-8');
        $data['articleTime']    = $detailTitle->find('div span:eq(3)')->html();
        $data['hits']           = $detailTitle->find('div span:eq(5)')->html();
        
        $articleData            = pq('.detailTxt.mt10');
        $data['article']        = $articleData->html();
        //对图片进行抓取
        $images                 = $articleData->find('img');
        $imgAddr                = $this->catchImg($images, $i);
        foreach ($imgAddr as $key => $addr){
            $data['article']    = str_replace($addr['old'], $addr['new'], $data['article']);
        }
        
        $evaluateArea           = pq('.evaluateArea');
        $data['prize']          = substr($evaluateArea->find('#J_Support b')->html(), 1, -1);
        $data['comment']        = substr($evaluateArea->find('#J_Comment b')->html(), 1, -1);
        
        print_r($data);
    }
    
    private function catchImg($images, $articleId){
        $srcArray = array();
        if ($images && count($images)){
            foreach ($images as $key => $imagesValue){
                $imageAddress = pq($imagesValue)->attr('src');
                $imagePathInfo = pathinfo($imageAddress);
                //下载
                $address = $this->imgSavePath . $articleId . '/' . $imagePathInfo['basename'];
                if (!is_dir($this->imgSavePath . $articleId)){
                    mkdir($this->imgSavePath . $articleId);
                }

                $imgData = @file_get_contents($imageAddress);
                if ($imgData){
                    file_put_contents($address, $imgData);  
                    $srcArray[$key]['old'] = $imagePathInfo['dirname'] . '/' . $imagePathInfo['basename'];
                    $srcArray[$key]['new'] = $address;
                }
            }
        }
        return $srcArray;
    }
}