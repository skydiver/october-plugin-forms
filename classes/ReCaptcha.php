<?php

    namespace Martin\Forms\Classes;

    use Session;
    use RainLab\Translate\Classes\Translator;
    use Martin\Forms\Models\Settings;

    trait ReCaptcha {
        
        /**
         * @var RainLab\Translate\Classes\Translator Translator object.
         */
        protected $translator;

        /**
         * @var string The active locale code.
         */
        public $activeLocale;

        public function init() {
                $this->translator = Translator::instance();
        }

        private function isReCaptchaEnabled() {
            return ($this->property('recaptcha_enabled') && Settings::get('recaptcha_site_key') != '' && Settings::get('recaptcha_secret_key') != '');
        }

        private function isReCaptchaMisconfigured() {
            return ($this->property('recaptcha_enabled') && (Settings::get('recaptcha_site_key') == '' || Settings::get('recaptcha_secret_key') == ''));
        }

        private function loadReCaptcha() {
            $activeLocale = $this->activeLocale = $this->translator->getLocale();
            $this->addJs('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl='.$activeLocale, ['async', 'defer']);
            $this->addJs('assets/js/recaptcha.js');
        }

    }

?>
