<?php

    $iError = $_GET['force_response'] ? $_GET['force_response'] : 300;

    header(sprintf(
        "HTTP/1.0 %s Fake message",
         $iError
    ));