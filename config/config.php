<?php
    /* ===              DATABASE ACCESS               === */
    define('DBHOST', '****');
    define('DBPORT', '3306');
    define('DBUSER', '****');
    define('DBPASS', '****');
    define('DBNAME', '****');

    /* ===             WEB SITE PARAMETERS            === */
    define('BLOGTITLE', 'Je BLOG donc je suis !');
    define('SL_MAIN', 'Jean Forteroche');

    /* ===               MEMBERS ACCESS               === */
    define('GUEST', 1);
    define('REGISTRED', 2);
    define('REGULATOR', 3);
    define('ADMIN', 4);
    define('LEVEL', 1);

    /* === GENERATION OF A RANDOM NUMBER FOR  FILE .JSON CREATION === */ 
    define('RANDOM_ID', dechex(str_replace('.', '', $_SERVER['REMOTE_ADDR'])));

    /* === FILE REMOVAL FOR OLDEST .JSON FILES        === */
    $folder = new DirectoryIterator('tmp/');
    foreach($folder as $file) {
        if($file->isFile() && !$file->isDot() && (time() - $file->getMTime() > 86400)) {
            unlink($file->getPathname());
        }
    }
            