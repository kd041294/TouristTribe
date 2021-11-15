<?php


namespace App\Http\Libraries;

    class TextLocal{
        public static function send_message($mobile_no, $message){
            if(env('TEXTLOCAL_STATUS') == 1){
                
                // Account details
                $apiKey = urlencode('NDIzODQ5MzU0NDcwMzY2ODUxNzg0YjUyNmM0Mjc5NjM=');
            
                // Message details
                $numbers = array($mobile_no);
                $sender = urlencode('TRSTRB');
                $message = rawurlencode($message);
            
                $numbers = implode(',', $numbers);
            
                // Prepare data for POST request
                $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
            
                // Send the POST request with cURL
                $ch = curl_init('https://api.textlocal.in/send/');
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
                case "User_SignUp":
                     $message = "Hi, your OTP for SignUp is ".$params['otp']." on TouristTribe. Cheers !!.";
                    break;
                case "seller_registration_otp":
                    $message = "Hi, your OTP for SignUp on TouristTribe is ".$params['otp'].". Wishing you an excellent professional Journey. Regards, Team TouristTribe";
                    break;
                case "forgot_password_otp":
                    $message = "Hi, your OTP for Forget Password on touristtribe.in is ".$params['otp'].". Regards, TouristTribe";
                    break;
                case "admin_login_otp":
                    $message = "Hey ".$params['name'].", Your OTP to login to the admin panel is ".$params['otp'].". Regards, TouristTribe";
                    break;
                    
                case "affiliate_marketing_otp":
                    $message = "Hey ".$params['name'].", Your OTP to login to the Affiliate Marketing is ".$params['otp'].". Regards, TouristTribe";
                    break;
            }

            return $message;
        }



        public static function send_email(){
            return 0;
        }

    }
?>