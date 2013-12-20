<?php

    /**
     * Croncheck is an script to be used as a cronjob. It will check
     *
     * @version 0.1
     * @see README.md
     * @author Gotardo González <contacto@gotardo.es>
     * @copyright Gotardo González <contacto@gotardo.es>
     * @license MIT License http://opensource.org/licenses/MIT
     * @todo
     *
     *      v0.2
     *      v0.2 add profiling options
     *      v0.2 add slowliness checks
     *      v0.3 add log reader
     */

    include 'inc/Report.php';
    include 'inc/Checker.php';
    include 'inc/SimpleLogger.php';
    include 'inc/CronCheckerApp.php';
    include 'config.php';

    echo '<pre>';
    new CronCheckerApp($aConfig);
    echo '</pre>';
