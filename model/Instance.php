<?php
/* =================================================== **
**             SINGLETON IMPLEMENTATION                **
** =================================================== */
/* Author    : Thierry CHARPENTIER                      *
*  Date      : 28.10.2018                               *
*  Version   : V1R0                                     *
* ==================================================== */
namespace OCFram\Blog\Model;
class Instance {
    /* =============================================== **
    **      CALL THIS METHOD TO GET SINGLETON          **
    ** =============================================== */
    public static function getInstance() {
        static $instance = false;
        if($instance === false) $instance = new static();
        return $instance;
    }
    /* =============================================== **
    **          MAKE CONSTRUCTOR PRIVATE               **
    ** -> nobody can call "new Instance"               **
    ** =============================================== */
    private function __construct() {}
    /* =============================================== **
    **      MAKE CLONE MAGIC METHOD PRIVATE            **
    ** -> nobody can clone instance                    **
    ** =============================================== */
    private function __clone() {}
    /* =============================================== **
    **      MAKE SLEEP MAGIC METHOD PRIVATE            **
    ** -> nobody can serialize instance                **
    ** =============================================== */    
    private function __sleep() {}
    /* =============================================== **
    **      MAKE WAKEUP MAGIC METHOD PRIVATE           **
    ** -> nobody can unserialize instance              **
    ** =============================================== */
    private function __wakeup() {}
}