<?php
/* Web-based Server Logfile
   Fabian Faul (faullab.com) */

if(!defined('INC_DB')){
  define('INC_DB', true);

  class CDBSQLite extends SQLite3
  {
    public function __construct($dbname) {
      $dbname = preg_replace('/[^a-z0-9:;,_!\? \.\-|\r|\n]/i', '', $dbname);
      $file = "data/".$dbname.".db";

      $this->open($file, $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
    }

  };
}
?>