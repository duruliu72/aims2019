<?php
namespace App;

class SendSms {
    public function MessageSend($to="", $message="Error")
    {
        $user = '01612302124';
        $password = 'ABCDabcd1234';
        $sender = '+8804445647831';
        $SMSText = $message;
        $GSM = '88'.$to;
        $type = 'longSMS';
        $param='';
        $url = "http://api.zaman-it.com/api/v3/sendsms/plain?";
        $param.= '&user='.$user;
        $param.= '&password='.$password;
        $param.= '&sender='.$sender;
        $param.= '&SMSText='.urlencode($SMSText);
        $param.= '&GSM='.urlencode($GSM);
        $param.= '&type='.urlencode($type);
        $param.='&datacoding=8';
        $urlFinal =  $url.$param;

        $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $urlFinal);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($curl, CURLOPT_TIMEOUT, 60);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
        return json_encode($ajax);
    }
}
?>