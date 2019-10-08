<?php
require_once __DIR__.'/functions.php';

create_download($url, $token);
create_file($file, "/tmp/$token", $token);
create_share($file, $pass, $token);
