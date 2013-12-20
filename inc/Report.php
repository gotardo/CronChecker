<?php

/**
 * Report
 *
 * A simple class to manage reports in the application. It will allow you to:
 *  - Create a report
 *  - Add registers to the report.
 *  - Generate a string version of the report.
 *  - Send the report via email.
 *
 * @author Gotardo González <contacto@gotardo.es>
 * @copyright Gotardo González <contacto@gotardo.es>
 * @license MIT License http://opensource.org/licenses/MIT
 * @var: This holds the type and description of a variable or class property. The format is type element description.
 * @param: This tag shows the type and description of a function or method parameter. The format is type $element_name element description.
 *
 */
class Report
{
    /**
     * @var array
     */
    protected $_aRegisters;
    /**
     * @var string The HTML template to show the registers.
     */
    protected $_sRegisterTemplate = '<div>%http_code% - %url%</div>';

    /**
     * Create
     */
    public function __construct()
    {
        $this->_aRegisters = array();
    }

    /**
     * Adds a register to the report.
     *
     * @param array $aData The data to be reported.
     * @param int $iPriority The priority order in the report.
     * @return Report the $this object
     */
    public function addRegister($aData, $iPriority = 0)
    {
        array_push($this->_aRegisters, array(
            '_data'     => $aData,
            '_priority' => $iPriority,
        ));

        return $this;
    }

    /**
     * Sends the report via email.
     *
     * @param string $sEmail The 'To' address
     * @return Report the $this object
     */
    public function mail($sEmail)
    {
        $sHeaders  = 'MIME-Version: 1.0' . "\r\n";
        $sHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Cabeceras adicionales
        //$sHeaders .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
        $sHeaders .= 'From: WebTools URL Checker <no-reply@gotardo.es>' . "\r\n";

        mail($sEmail, 'Some incidence was detected', $this, $sHeaders);
        return $this;
    }

    /**
     * Sets the template that will be used in the object's string casting. It will show the register's fields added with
     * a pattern like %field_name%.
     * (e.g) '<div>%http_code% - %url%</div>'
     *
     * @param $sTemplate string The patter for the object's string casting.
     * @return Report $this
     */
    public function setRegisterTemplate($sTemplate)
    {
        $this->_sRegisterTemplate = $sTemplate;
        return $this;
    }

    /**
     * Convert the object to string by using the html template.
     * @return string an HTML version of the report.
     */
    public function __toString()
    {
        $sReport = '';
        foreach ($this->_aRegisters as $aRegister)
        {
            $sRegister = $this->_sRegisterTemplate;
            foreach(array_keys ($aRegister['_data']) as $sKey)
                if (!is_array($aRegister['_data'][$sKey]))
                    $sRegister = str_replace ('%' . $sKey . '%', $aRegister['_data'][$sKey], $sRegister);
            $sReport .= $sRegister;
        }

        return $sReport;
    }

    /**
     *  Count the number of registers of the report.
     *  @return int Number of registers of the report.
     */
    public function count(){
        return count($this->_aRegisters);
    }

}