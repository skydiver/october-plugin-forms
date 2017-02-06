<?php

    namespace Martin\Forms\Classes;

    use Session;
    use Martin\Forms\Models\Settings;

    trait ReCaptcha {

        private function isReCaptchaEnabled() {
            return ($this->property('recaptcha_enabled') && Settings::get('recaptcha_site_key') != '' && Settings::get('recaptcha_secret_key') != '');
        }

        private function isReCaptchaMisconfigured() {
            return ($this->property('recaptcha_enabled') && (Settings::get('recaptcha_site_key') == '' || Settings::get('recaptcha_secret_key') == ''));
        }

        private function loadReCaptcha() {
            $this->addJs('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit', ['async', 'defer']);
            $this->addJs('assets/js/recaptcha.js');
        }

    }

?>