<?php

    namespace Martin\Forms\Classes;

    use Backend, BackendAuth;

    class BackendHelpers {

        /**
         * Return a Backend URL based on a matrix of URLS and permissions
         * @param  array   $urls
         * @param  string  $default
         * @return string
         */
        public static function getBackendURL($urls, $default) {

            $user = BackendAuth::getUser();

            foreach($urls as $permission => $URL) {
                if($user->hasAccess($permission)) {
                    return Backend::url($URL);
                }
            }

            return Backend::url($urls[$default]);

        }

        /**
         * Check if Translator plugin is installed
         * @param  array   $array
         * @return string
         */
        public static function isTranslatePlugin() {
            return class_exists('\RainLab\Translate\Classes\Translator') && class_exists('\RainLab\Translate\Models\Message');
        }

        /**
         * Render an array as HTML list (UL > LI)
         * @param  array   $array
         * @return string
         */
        public static function array2ul($array) {
            $return = '';
            foreach($array as $index => $item) {
                if(is_array($item)) {
                    $return .= '<li>' . htmlspecialchars($index, ENT_QUOTES) . '<ul>' . self::array2ul($item) . "</ul></li>";
                } else {
                    $return .= '<li>' . htmlspecialchars($item , ENT_QUOTES) .'</li>';
                }
            }
            return $return;
        }

        /**
        * Anonymize an IPv4 address (credits: https://github.com/geertw/php-ip-anonymizer)
        * @param $address string IPv4 address
        * @return string Anonymized address
        */
        public static function anonymizeIPv4($address) {
            return inet_ntop(inet_pton($address) & inet_pton("255.255.255.0"));
        }

    }

?>