<?php
/**
 * CronChecker
 *
 * @author Gotardo González <contacto@gotardo.es>
 * @copyright Gotardo González <contacto@gotardo.es>
 * @license MIT License http://opensource.org/licenses/MIT
 */

class CronCheckerApp
{
    /**
     * @var array The configuration params
     */
    protected $_aConfig;

    /**
     * Launch the app
     * @param $aConfig
     */
    public function __construct($aConfig)
    {
        ini_set("auto_detect_line_endings", false);

        $this->_aConfig = $aConfig;

        /** @var SimpleLogger The loggerobject */
        $oLogger    = new SimpleLogger($this->_aConfig['LOG_PATH']);
        /** @var Report The report to be sent */
        $oReport    = new Report;
        /** @var Checker The url checker object */
        $oChecker   = new Checker;

        /**
         *  Check the URLs
         */
        foreach ($aConfig['URLS'] as $sURL)
        {

            $aResults = $oChecker->checkUrl($sURL);
            printf ("\nChecking... %s (%s)", $sURL, $aResults['http_code']);
            if (!$aResults['http_code'] || in_array($aResults['http_code'], $this->_aConfig['NOTIFY_ERRORS']))
                $oReport->addRegister($aResults);

            $oLogger->addLog($aResults) || printf("\n error logging");
        }

        /**
         *  Send the report
         */
        if ($oReport->count() && is_array($this->_aConfig['ADMINS']))
        {
            foreach ($this->_aConfig['ADMINS'] as $sAdminEmail)
            {
                echo "\nreporting to " . $sAdminEmail;
                if (!$oReport->mail($sAdminEmail))
                    echo "\nMail failed";
            }
        }
    }
}