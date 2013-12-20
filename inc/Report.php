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
class Report
{
    protected $_aRegisters;
    protected $_sRegisterHtmlTemplate = '<div>%http_code% - %url%</div>';

    public function __construct()
    {
        $this->_aRegisters = array();
    }

    /**
     * Adds a register to the report.
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
     * Convert the object to string
     * @return Return an HTML version of the report.
     */
    public function __toString()
    {
        $sReport = '';
        foreach ($this->_aRegisters as $aRegister)
        {
            $sRegister = $this->_sRegisterHtmlTemplate;
            foreach(array_keys ($aRegister['_data']) as $sKey)
            {
                if (!is_array($aRegister['_data'][$sKey]))
                {
                    $sRegister = str_replace ('%' . $sKey . '%', $aRegister['_data'][$sKey], $sRegister);
                }
            }

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