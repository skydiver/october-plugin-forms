<?php

namespace Martin\Forms\Classes;

use Backend, BackendAuth;

class BackendHelpers {

    /**
     * Return a Backend URL based on a matrix of URLS and permissions
     *
     * @param array  $urls    Matrix of permissions and URLs
     * @param string $default Default URL
     *
     * @return string
     */
    public static function getBackendURL(array $urls, string $default) :string {
        $user = BackendAuth::getUser();
        foreach ($urls as $permission => $URL) {
            if ($user->hasAccess($permission)) {
                return Backend::url($URL);
            }
        }
        return Backend::url($urls[$default]);
    }

    /**
     * Check if Translator plugin is installed
     *
     * @return boolean
     */
    public static function isTranslatePlugin() :bool {
        return class_exists('\RainLab\Translate\Classes\Translator') && class_exists('\RainLab\Translate\Models\Message');
    }

    /**
     * Render an array as HTML list (UL > LI)
     *
     * @param array $array List items
     *
     * @return string
     */
    public static function array2ul(array $array) :string {
        $return = '';
        foreach ($array as $index => $item) {
            if (is_array($item)) {
                $return .= '<li>' . htmlspecialchars($index, ENT_QUOTES) . '<ul>' . self::array2ul($item) . "</ul></li>";
            } else {
                $return .= '<li>' . htmlspecialchars($item, ENT_QUOTES) .'</li>';
            }
        }
        return $return;
    }

    /**
     * Anonymize an IPv4 address
     * (credits: https://github.com/geertw/php-ip-anonymizer)
     *
     * @param string $address IPv4 address
     *
     * @return string Anonymized address
     */
    public static function anonymizeIPv4(string $address) :string {
        return inet_ntop(inet_pton($address) & inet_pton("255.255.255.0"));
    }

    /**
     * Extract string from curly braces
     *
     * @param string $pattern     Pattern to replace
     * @param string $replacement Replacement string
     * @param string $subject     Strings to replace
     *
     * @return string
     */
    public static function replaceToken(string $pattern, string $replacement, string $subject) :string {
        $pattern = '/{{\s*('.$pattern.')\s*}}/';
        return preg_replace($pattern, $replacement, $subject);
    }

}

?>