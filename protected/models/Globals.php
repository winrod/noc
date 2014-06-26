<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Globals
 *
 * @author rodwin
 */
class Globals {
    
    /**
    * Get either a Gravatar URL or complete image tag for a specified email address.
    *
    * @param string $email The email address
    * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
    * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
    * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
    * @param boole $img True to return a complete IMG tag False for just the URL
    * @param array $atts Optional, additional key/value attributes to include in the IMG tag
    * @return String containing either just a URL or a complete image tag
    * @source http://gravatar.com/site/implement/images/php/
    */
   static function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
       $url = 'http://www.gravatar.com/avatar/';
       $url .= md5( strtolower( trim( $email ) ) );
       $url .= "?s=$s&d=$d&r=$r";
       if ( $img ) {
           $url = '<img src="' . $url . '"';
           foreach ( $atts as $key => $val )
               $url .= ' ' . $key . '="' . $val . '"';
           $url .= ' />';
       }
       return $url;
   }

    //put your code here
    static function getWeek($date, $rollover='sunday') {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $i = 1;
        $weeks = 1;

        for ($i; $i <= $elapsed; $i++) {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if ($day == strtolower($rollover))
                $weeks++;
        }

        return $weeks;
    }

    static public function getFrequency($week_no) {

        $frequency = "";

        switch ($week_no) {
            case 1://w,f1,m1
                $frequency = "'w','f1','m1'";
                break;
            case 2://w,f2,m2
                $frequency = "'w','f2','m2'";
                break;
            case 3://w,f1,m3
                $frequency = "'w','f1','m3'";
                break;
            case 4://w,f2,m4
                $frequency = "'w','f2','m4'";
                break;
            case 5://w,f1,m5
                $frequency = "'w','f1','m5'";
                break;
            case 6://w,f1,m5
                $frequency = "'w','f2','m6'";
                break;

            default:
                break;
        }

        return $frequency;
    }

    static function nice_number($n) {
        // first strip any formatting;
        $n = (0 + str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n))
            return false;

        // now filter it;
        if ($n > 1000000000000)
            return round(($n / 1000000000000)) . 'T';
        else if ($n > 1000000000)
            return round(($n / 1000000000)) . 'B';
        else if ($n > 1000000)
            return round(($n / 1000000)) . 'M';
        else if ($n > 1000)
            return round(($n / 1000)) . 'K';

        return number_format($n);
    }

    public static function parseCSV($file, $head = FALSE, $first_column = FALSE, $delim=",", $len = 9216, $max_lines = NULL) {
        if (!file_exists($file)) {
            //Debug::text('Files does not exist: ' . $file, __FILE__, __LINE__, __METHOD__, 10);
            return FALSE;
        }

        $return = false;
        $handle = fopen($file, "r");
        if ($head !== FALSE) {
            if ($first_column !== FALSE) {
                while (($header = fgetcsv($handle, $len, $delim) ) !== FALSE) {
                    if ($header[0] == $first_column) {
                        //echo "FOUND HEADER!<br>\n";
                        $found_header = TRUE;
                        break;
                    }
                }

                if ($found_header !== TRUE) {
                    return FALSE;
                }
            } else {
                $header = fgetcsv($handle, $len, $delim);
            }
        }

        $i = 1;
        while (($data = fgetcsv($handle, $len, $delim) ) !== FALSE) {
            if ($head AND isset($header)) {
                foreach ($header as $key => $heading) {
                    $row[$heading] = ( isset($data[$key]) ) ? $data[$key] : '';
                }
                $return[] = $row;
            } else {
                $return[] = $data;
            }

            if ($max_lines !== NULL AND $max_lines != '' AND $i == $max_lines) {
                break;
            }

            $i++;
        }

        fclose($handle);

        return $return;
    }

}

?>