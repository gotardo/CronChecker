<?php

    /**
     *  @todo
     *
     *      v0.1 Study CronChecker class, make it cool, man.
     *      v0.1 Create a different repository for logger.
     *      v0.1 add comments
     *      v0.1 add licese
     *      v0.1 add README,
     *      v0.1 add logging
     *      v0.1 add log cleaner process
     *
     *      v0.2 add profiling options
     *      v0.2 add slowliness checks
     *
     */
    include 'inc/Report.php';
    include 'inc/Checker.php';
    include 'inc/SimpleLogger.php';
    include 'config.php';


    class CronChecker
    {
        /**
         * @var array The configuration params
         */
        protected $_aConfig;

        public function __construct($aConfig)
        {
            $this->_aConfig = $aConfig;

            /** @var Logger The loggerobject */
            $oLogger    = new SimpleLogger($this->_aConfig['LOG_PATH']);
            /** @var Report The report to be sent */
            $oReport    = new Report;
            /** @var Checker The url checker object */
            $oChecker   = new Checker;

            /**
             *  Check the URLs
             */
            echo "<pre>";
            foreach ($aConfig['URLS'] as $sURL)
            {

                $aResults = $oChecker->checkUrl($sURL);
                printf ("\nChecking... %s (%s)", $sURL, $aResults['http_code']);
                if (!$aResults['http_code'] || in_array($aResults['http_code'], $this->_aConfig['NOTIFY_ERRORS']))
                {
                    $oReport->addRegister($aResults);
                    $oLogger->addLog($aResults);
                }
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
            echo "</pre>";
        }

    }
?>
<pre>
Starting...
<?php new CronChecker($aConfig); ?>
</pre>
