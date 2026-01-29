<?php

if (! function_exists('base64url_encode')) {
    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if (! function_exists('base64url_decode')) {
    function base64url_decode($data) {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}

if (! function_exists('encrypt_url_safe')) {
    function encrypt_url_safe($string) {
        $key = 'ViShalAgroKrishi'; // must be 16 or 32 chars
        $iv  = substr(hash('sha256', $key), 0, 16);

        $encrypted = openssl_encrypt(
            $string,
            'AES-256-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        // URL-safe Base64
        return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');        
    }
}

if (! function_exists('decrypt_url_safe')) {
    function decrypt_url_safe($string) {
        $key = 'ViShalAgroKrishi';
        $iv  = substr(hash('sha256', $key), 0, 16);

        // Restore Base64
        $data = base64_decode(strtr($string, '-_', '+/'));

        return openssl_decrypt(
          $data,
          'AES-256-CBC',
          $key,
          OPENSSL_RAW_DATA,
          $iv
        );
    }
}

if (! function_exists('slugify')) {
    function slugify($string) {
        // convert to lowercase
        $string = strtolower($string);

        // replace non-alphanumeric characters with hyphens
        $string = preg_replace('/[^a-z0-9]+/i', '-', $string);

        // trim hyphens from start and end
        return trim($string, '-');
    }
}


if (!function_exists('indian_number_format')) {
    function indian_number_format($num) {
        $num = explode('.', (string)$num);
        $int = $num[0];
        $decimal = isset($num[1]) ? $num[1] : '00';

        $last3 = substr($int, -3);
        $rest = substr($int, 0, -3);

        if ($rest != '') {
            $rest = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $rest);
            $formatted = $rest . "," . $last3;
        } else {
            $formatted = $last3;
        }

        return $formatted . '.' . str_pad($decimal, 2, '0', STR_PAD_RIGHT);
    }
}

if (!function_exists('indian_currency')) {
    function indian_currency($amount) {
        return "₹ " . indian_number_format($amount);
    }
}

if (!function_exists('format_indian_currency')) {
    function format_indian_currency($number) {
        $fmt = new \NumberFormatter('en_IN', \NumberFormatter::CURRENCY);

        // Force exactly 2 decimal places
        $fmt->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 2);
        $fmt->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 2);

        return $fmt->format($number);
    }
}

?>