<?php

    namespace Martin\Forms\Classes;

    use Request;
    use Martin\Forms\Models\Settings;

    class ReCaptchaValidator {

        public function validateReCaptcha($attribute, $value, $parameters) {
            $secret_key = Settings::get('recaptcha_secret_key');
            $recaptcha  = post('g-recaptcha-response');
            $ip         = Request::getClientIp();
            $URL        = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$recaptcha&remoteip=$ip";
            $response   = json_decode(file_get_contents($URL), true);
            return ($response['success'] == true);
        }

    }

?>