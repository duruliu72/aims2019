<?php
namespace App;

class SendSms {
    public function MessageSend($to="", $message="Error")
    {
        $status = false;

        //$to = '01746736936';
        //$message = 'TTTTTTTT';

        $user = 'bd01612302124';
        $password = 'ABCDabc12!@';
        $sender = '8804445647841';
        $SMSText = $message;
        $GSM = '88'.$to;
        //$GSM = '8801746736936';
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


        $messageid = '';
        try {
            $xml = simplexml_load_string($response); 
            $messageid = (string) ($xml->result->messageid ?? '');
        } catch (\Exception $e) {
            $messageid = '';
        }

        //dd($to, $message, $response);

        if ( !empty($messageid) ) {
            $status = true;
        }

        //dd( $response, $xml, $mssid );

        return $status;


        //http://api.zaman-it.com/api/v3/sendsms/plain?&user=bd01612302124&password=ABCDabc12!@&sender=8804445647841&SMSText=123456789&GSM=8801746736936&type=longSMS&datacoding=8
    }
}
?>