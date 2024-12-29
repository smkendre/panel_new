<?php

namespace App\Libraries;

class PinnacleSms
{
    protected $url = 'http://www.smsjust.com/sms/user/urlsms.php';
    protected $username = 'theindianexpress';
    protected $password = '7rDiV3!$';
    protected $senderid = 'INDEXP';

   
    public function sendSMS($otp, $mobile, $name)
    {
        $message = urlencode('Dear '.$name.', OTP for login to User dashboard is '.$otp.'. Please verify to proceed further.');

        // $params = [
        //   'username'=> $this->username,
        //   'pass' => $this->password, 
        //   'senderid' => $this->senderid,
        //   'dest_mobileno' => $mobile,
        //   'message' => $message, 
        //   'response' => 'Y'
        // ];

        $request = $this->url.'?username='.$this->username.'&pass='.$this->password.'&senderid='.$this->senderid.'&dest_mobileno='.$mobile.'&message='.$message.'&response=Y';

        // Generate curl request
        $session = curl_init($request);

        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);

        //curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $this->apiKey));
        // Tell curl to use HTTP POST
        curl_setopt($session, CURLOPT_POST, false);
        // Tell curl that this is the body of the POST
        //curl_setopt($session, CURLOPT_POSTFIELDS, $params);
        // Tell curl not to return headers, but do return the response

        // we created fo
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        curl_close($session);

        return $response;
    }
}
