<?php
namespace crawler\fetch;
class FetchRawData extends Fetch{
    /**
     * Get raw data from url with cookies
     * 
     * 
     * @access public
     * @param string $url The url to crawl
     * @param array $array The cookies array to read url
     * @return string The result of crawl
     */
    public function getRawData($url, $cookies) {
        $ch = curl_init();
        
        $cookiesStr = '';
        foreach ($cookies as $key => $cookiesValue){
            $cookiesStr .= $key . '=' . $cookiesValue . ';';
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 240);
        curl_setopt($ch, CURLOPT_COOKIE, $cookiesStr);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}