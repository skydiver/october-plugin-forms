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
         * Render an array as HTML list (UL > LI)
         * @param  array   $array
         * @return string
         */
        public static function array2ul($array) {
            $return = '';
            foreach($array as $index => $item) {
                if(is_array($item)) {
                    $return .= "<li>$index<ul>" . self::array2ul($item) . "</ul></li>";
                } else {
                    $return .= "<li>$item</li>";
                }
            }
            return $return;
        }

    }

?>