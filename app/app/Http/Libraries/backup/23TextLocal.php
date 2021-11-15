<?php


namespace App\Libraries;

    class TextLocal{
        public static function send_message($mobile_no, $message){
            if(env('TEXTLOCAL_STATUS') == 1){
                $apiKey = urlencode(env('TEXTLOCAL_API_KEY'));

                $sender = urlencode("TRSTRB");
                $message = rawurlencode($message);
                
                $data = array('apikey' => $apiKey, 'numbers' => $mobile_no, 'sender' => $sender, 'message' => $message);

                $ch = curl_init("https://api.textlocal.in/send/");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                
                if($response){
                    $response = json_decode($response, true);
                    if($response["status"] == "success"){
                        return true;
                    }else{
                        return false;
                    }
                    
                }else{
                    return false;
                }
            }

        }

        public static function get_message_template($key, $params = []){
            $message = "";

            switch($key){
                case "registration_otp":
                    $message = "Hi, your OTP for login on touristtribe.in is ".$params['otp'].".\nRegards,\nTouristTribe";
                break;
            }

            return $message;
        }


    }
?>