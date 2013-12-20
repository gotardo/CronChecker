<?php

/**
 * Checker
 *
 * The checker class wraps functions to check the response of an URL
 *
 * @author Gotardo González <contacto@gotardo.es>
 * @copyright Gotardo González <contacto@gotardo.es>
 * @license MIT License http://opensource.org/licenses/MIT
 */
class Checker
{
    /** Checks the status of an URL and retors the information of the ping.
     *
     *  @param string $sURL The URL.
     *  @return array The info of the cURL connection.
     */
    public static function checkUrl($sURL)
    {
        $rHandle = curl_init($sURL);

        curl_setopt($rHandle,  CURLOPT_RETURNTRANSFER, TRUE);

        /** Get the HTML or whatever is linked in $sUrl. */
        curl_exec($rHandle);

        /** Check for 404 (file not found). */
        $aCurlInfo = curl_getinfo($rHandle);

        /** Close cURL handle */
        curl_close($rHandle);

        return $aCurlInfo;
    }
}