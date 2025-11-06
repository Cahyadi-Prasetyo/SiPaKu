<?php

if (!function_exists('set_user_timezone')) {
    /**
     * Set timezone berdasarkan user preference atau negara
     * 
     * @param string $timezone
     * @return bool
     */
    function set_user_timezone($timezone = null)
    {
        if ($timezone === null) {
            $timezone = session()->get('user_timezone') ?? 'Asia/Jakarta';
        }
        
        try {
            date_default_timezone_set($timezone);
            return true;
        } catch (Exception $e) {
            log_message('error', 'Invalid timezone: ' . $timezone);
            return false;
        }
    }
}

if (!function_exists('get_timezone_list')) {
    /**
     * Daftar timezone untuk berbagai negara ASEAN
     * 
     * @return array
     */
    function get_timezone_list()
    {
        return [
            'Asia/Jakarta' => 'Indonesia (WIB) - Jakarta, Medan, Palembang',
            'Asia/Makassar' => 'Indonesia (WITA) - Makassar, Denpasar, Balikpapan',
            'Asia/Jayapura' => 'Indonesia (WIT) - Jayapura, Ambon',
            'Asia/Kuala_Lumpur' => 'Malaysia - Kuala Lumpur',
            'Asia/Singapore' => 'Singapura',
            'Asia/Bangkok' => 'Thailand - Bangkok',
            'Asia/Manila' => 'Filipina - Manila',
            'Asia/Ho_Chi_Minh' => 'Vietnam - Ho Chi Minh',
            'Asia/Phnom_Penh' => 'Kamboja - Phnom Penh',
            'Asia/Vientiane' => 'Laos - Vientiane',
            'Asia/Yangon' => 'Myanmar - Yangon',
            'Asia/Brunei' => 'Brunei Darussalam'
        ];
    }
}

if (!function_exists('format_local_time')) {
    /**
     * Format waktu sesuai timezone user
     * 
     * @param string|null $datetime
     * @param string $format
     * @param string|null $timezone
     * @return string
     */
    function format_local_time($datetime = null, $format = 'Y-m-d H:i:s', $timezone = null)
    {
        if ($datetime === null) {
            $datetime = date('Y-m-d H:i:s');
        }
        
        if ($timezone === null) {
            $timezone = session()->get('user_timezone') ?? app_timezone();
        }
        
        try {
            $date = new DateTime($datetime);
            $date->setTimezone(new DateTimeZone($timezone));
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error formatting time: ' . $e->getMessage());
            return $datetime;
        }
    }
}

if (!function_exists('get_current_time')) {
    /**
     * Dapatkan waktu saat ini sesuai timezone user
     * 
     * @param string $format
     * @param string|null $timezone
     * @return string
     */
    function get_current_time($format = 'Y-m-d H:i:s', $timezone = null)
    {
        return format_local_time(null, $format, $timezone);
    }
}

if (!function_exists('convert_timezone')) {
    /**
     * Convert waktu dari satu timezone ke timezone lain
     * 
     * @param string $datetime
     * @param string $from_timezone
     * @param string $to_timezone
     * @param string $format
     * @return string
     */
    function convert_timezone($datetime, $from_timezone, $to_timezone, $format = 'Y-m-d H:i:s')
    {
        try {
            $date = new DateTime($datetime, new DateTimeZone($from_timezone));
            $date->setTimezone(new DateTimeZone($to_timezone));
            return $date->format($format);
        } catch (Exception $e) {
            log_message('error', 'Error converting timezone: ' . $e->getMessage());
            return $datetime;
        }
    }
}