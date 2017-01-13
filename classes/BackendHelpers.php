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

    }

?>