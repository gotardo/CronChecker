<?php

/**
 * SimpleLogger
 *
 * @author Gotardo González <contacto@gotardo.es>
 * @copyright Gotardo González <contacto@gotardo.es>
 * @license MIT License http://opensource.org/licenses/MIT
 */
class SimpleLogger
{
    /**
     *  @var string The path to the log folder
     */
    protected $_sPath;

    /**
     * Logs an event.
     *
     * @param string $sPath The path of the log.
     */
    public function __construct($sPath)
    {
        $this->_sPath = $sPath;
    }

    /**
     * Logs an event.
     *
     * @param array $aData The data to be reported.
     * @param array $sFileName (not mandatory) The file name for the log. If
     * this param is omitted, a file with the time will be used.
     *
     * @return Report the $this object
     */
    public function addLog($aData, $sFileName = NULL)
    {
        isset($sFileName) || $sFileName = date('Ymd', time()) . ".log";
        $rFile = fopen($this->_sPath . $sFileName, 'a');
        $bOK = fputcsv($rFile, $aData);
        fclose($rFile);
        return $bOK;
    }
}