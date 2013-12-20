<?php

/**
 * Report
 *
 * A simple class
 *
 * This is the long description for this class,
 * which can span as many lines as needed. It is
 * not required, whereas the short description is
 * necessary.
 *
 * It can also span multiple paragraphs if the
 * description merits that much verbiage.
 *
 * @author Gotardo González <contacto@gotardo.es>
 * @copyright Gotardo González <contacto@gotardo.es>
 * @license MIT License http://opensource.org/licenses/MIT
 * @var: This holds the type and description of a variable or class property. The format is type element description.
 * @param: This tag shows the type and description of a function or method parameter. The format is type $element_name element description.
 * @return: The type and description of the return value of a function or method are provided in this tag. The format is type return element description.
 *
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
        $response = curl_exec($rHandle);

        /** Check for 404 (file not found). */
        $aCurlInfo = curl_getinfo($rHandle);

        /** Close cURL handle */
        curl_close($rHandle);

        return $aCurlInfo;
    }
}