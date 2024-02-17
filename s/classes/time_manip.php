<?php

/**
* @Auther: bhief
* @Version: 1.0
*
* Time manipulation class. Used for converting seconds -> time and getting x seconds ago, eg.
*
**/
class time_helper {
    function time_elapsed_string($datetime, $full = false) {
        global $cLang;
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        if(!isset($cLang)) {
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
        } else {
            $string = array(
                'y' => $cLang['year'],
                'm' => $cLang['month'],
                'w' => $cLang['week'],
                'd' => $cLang['day'],
                'h' => $cLang['hour'],
                'i' => $cLang['minute'],
                's' => $cLang['second'],
            );
        }
    
        if(!isset($cLang)) {
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }
        } else {
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? $cLang['pluralTimeRight'] : '');
                } else {
                    unset($string[$k]);
                }
            }
        }
    
        if(!isset($cLang)) {
            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        } else {
            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode($cLang['agoLeft'], $string) . " " . " " . $cLang['agoRight'] : $cLang['justNow'];
        }
    }

    
    function timestamp(int $seconds) {
        if ($seconds > 60*60*24) {
            // over a day
            return sprintf("%d:%s:%s:%s",
                floor($seconds/60/60/24),                                 // Days
                str_pad( floor($seconds/60/60%24), 2, "0", STR_PAD_LEFT), // Hours
                str_pad( floor($seconds/60%60),    2, "0", STR_PAD_LEFT), // Minutes
                str_pad(       $seconds%60,        2, "0", STR_PAD_LEFT)  // Seconds
            );
        } else if ($seconds > 60*60) {
            // over an hour
            return sprintf("%d:%s:%s",
                        floor($seconds/60/60),                        // Hours
                str_pad(floor($seconds/60%60), 2, "0", STR_PAD_LEFT), // Minutes
                str_pad(      $seconds%60,     2, "0", STR_PAD_LEFT)  // Seconds
            );
        } else {
            // less than an hour
            return sprintf("%d:%s",
                        floor($seconds/60),                       // Minutes
                str_pad(      $seconds%60,  2, "0", STR_PAD_LEFT) // Seconds
            );
        }
    }
}
?>