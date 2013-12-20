<?php

/**
 *  @var array $aConfig An array with the configuration paramethers
 */
$aConfig = array(

    /** A list with the urls to check */
    'URLS'  => array(

        //Testing on prod
        'http://yourserver.com/croncheck/test.php?force_response=200',
        'http://yourserver.com/croncheck/test.php?force_response=300',
        'http://yourserver.com/croncheck/test.php?force_response=400',
        'http://yourserver.com/croncheck/test.php?force_response=500',

        //Real checks
        'http://www.yourdomain1.com',
        'http://www.yourdomain2.com/url/',

        ),

    /** When to send a notification */
    'NOTIFY_ERRORS' => array(
        0,
        // 100, 101,
        // 200, 201, 202, 203, 204, 205, 206,
        // 300, 301, 302, 303, 304, 305, 306,
        400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 415, 416, 417,
        500, 501, 502, 503, 504, 505,

    ),

    /** A list with the admin emails to notify. You can keep this list empty */
    'ADMINS'=> array(
        'your.email@sample.com',
        ),

    /** Path for the log files. Comment this line to disable logs */
    'LOG_PATH'  => './logs/',
);

return $aConfig;