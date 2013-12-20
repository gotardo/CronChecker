<?php

/**
 * SimpleLogger
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
class SimpleLogger
{
    /** @var string The path where the logs will be placed*/
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

    public function readLog($sFileName)
    {
        $rFile = fopen($this->_sPath . $sFileName, 'a');
        while ($sfile = fgetcsv($rFile))
            var_dump ($file);
    }

}