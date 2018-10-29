<?php
/* =================================================== **
**                  SPLCLASSLOADER                     **
** =================================================== */
/* Author    : Thierry CHARPENTIER                      *
*  Date      : 28.10.2018                               *
*  Version   : V1R0                                     *
* ==================================================== */
class SplClassLoader {
  /* ------------------------------------------------- **
  ** register method                                   **
  ** Record our autoloader                             **
  ** ------------------------------------------------- */
  static function register() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }

  /* ------------------------------------------------- **
  ** autoload method                                   **
  ** Included the file corresponding to our class      **
  ** @param $class string : The name of the class to be** 
  **  charged                                          **
  ** ------------------------------------------------- */
  static function autoload($class) {
    require_once('model/' . $class . '.php');
  }
}
