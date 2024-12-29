<?php
//error_reporting(E_ALL^E_NOTICE);
//ini_set('display_errors', 1);
class sendEmail {
    protected $url = 'https://newsletters.expressbpd.in/sendmail/api/';
    protected $apiKey;
    public function __construct($key) {
        $this->apiKey = $key;
    }
    public function sendMail($params) {
        $requestUrl = $this->url . 'sendEmail.php';
        $curlReq = curl_init($requestUrl);
        curl_setopt($curlReq, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($curlReq, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $this->apiKey));
        curl_setopt($curlReq, CURLOPT_POST, true);
        curl_setopt($curlReq, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curlReq, CURLOPT_HEADER, false);
        curl_setopt($curlReq, CURLOPT_RETURNTRANSFER, true);
        $curlResponse = curl_exec($curlReq);
        curl_close($curlReq);
        return json_encode($curlResponse);
    }

}
?>