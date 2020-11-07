<?php
/* Web-based Server Logfile
   Fabian Faul (faullab.com) */

if(!defined('INC_LOG')){
  define('INC_LOG', true);

  require('includes/dbsqlite.cls.php');


  class CLog
  {
    private $db;

    // open database
    public function __construct() {
	  	$this->db = new CDBSQLite('logdata');
	  }

    // drop table and initialize database
    public function initialize() {
      $sql = "DROP TABLE IF EXISTS logs";
      $this->db->exec($sql)
        or die('DATABASE ERROR!');

      $sql = "CREATE TABLE logs (
                logtime DATETIME DEFAULT CURRENT_TIMESTAMP,
                device VARCHAR(20) NOT NULL,
                type VARCHAR(20) NOT NULL,
                message LONGTEXT
              )";
	  	return $this->db->exec($sql)
        or die('DATABASE ERROR!');
	  }

    // add entry to database
    public function addEntry($dev, $type, $msg) {
      $sql = "INSERT INTO logs (device, type, message)
              VALUES ('$dev', '$type', '$msg')";
	  	return $this->db->exec($sql);
	  }

    // list all entries in ascending order regarding time
    public function listEntries() {
      $sql = "SELECT *
              FROM logs
              ORDER BY logtime ASC";
	  	$results = $this->db->query($sql)
        or die('DATABASE ERROR!');

      $content = "<div class=\"table\">";
      while ($row = $results->fetchArray()) {
        $style = (strtolower($row['type']) == 'error')?'red':'';
        $content .= "<div class=\"table-row $style\">
                       <div class=\"table-cell\">UTC {$row['logtime']}</div>
                       <div class=\"table-cell\">{$row['device']}</div>
                       <div class=\"table-cell\">{$row['type']}</div>
                       <div class=\"table-cell\">{$row['message']}</div>
                     </div>";
      }
      $content .= "</div>";

      return $content;
	  }

    // delete entries from database which are older than x days
    public function delOldEntries($olderthan = 5) {
      $sql = "DELETE FROM logs
              WHERE logtime <= DATE('NOW','-$olderthan DAY')";
      return $this->db->exec($sql)
        or die('DATABASE ERROR!');
	  }

    // delete all entries from database
    public function delAllEntries() {
      $sql = "DELETE FROM logs";
      return $this->db->exec($sql)
        or die('DATABASE ERROR!');
	  }

  };
}
?>