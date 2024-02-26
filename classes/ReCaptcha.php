<?php

namespace BlakeJones\MagicForms\Classes;

use Session;
use BlakeJones\MagicForms\Classes\BackendHelpers;
use BlakeJones\MagicForms\Models\Settings;
use RainLab\Translate\Classes\Translator;

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
        if (BackendHelpers::isTranslatePlugin()) {
            $this->translator = Translator::instance();
        }
    }

    private function isReCaptchaEnabled() {
        return ($this->property('recaptcha_enabled') && Settings::get('recaptcha_site_key') != '' && Settings::get('recaptcha_secret_key') != '');
    }

    private function isReCaptchaMisconfigured() {
        return ($this->property('recaptcha_enabled') && (Settings::get('recaptcha_site_key') == '' || Settings::get('recaptcha_secret_key') == ''));
    }

    private function getReCaptchaLang($lang='') {
        if (BackendHelpers::isTranslatePlugin()) {
            $lang = '&hl=' . $this->activeLocale = $this->translator->getLocale();
        } else {
            $lang = '&hl=' . $this->activeLocale = app()->getLocale();
        }
        return $lang;
    }

    private function loadReCaptcha() {
        $this->addJs('https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'.$this->getReCaptchaLang(), ['async', 'defer']);
        $this->addJs('assets/js/recaptcha.js');
    }

}

?>
