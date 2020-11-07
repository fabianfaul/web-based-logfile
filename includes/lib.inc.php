<?php
/* Web-based Server Logfile
   Fabian Faul (faullab.com) */

if(!defined('INC_LIB')){
  define('INC_LIB', true);

  // delete all HTML-Tags
  function del_html($str) {
    $str = strip_tags(trim($str));
    return $str;
  }

  // delete all HTML-Tags and linebreak
  function del_all($str) {
    $str = strip_tags(trim($str));
    $str = str_replace(array('\n', '\r'), array('', ''), $str);
    return $str;
  }
}
?>