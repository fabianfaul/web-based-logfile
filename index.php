<?php
  /* Web-based Server Logfile
     Fabian Faul (faullab.com) */

  require('includes/html.cls.php');
  require('includes/list.cls.php');
  require('includes/lib.inc.php');


  // ********** CONFIGURATION *********** //

  // key that is used as authentication for the logfile
  // generate a key using https://tools.faullab.com/keygenerator
  $key = 'KEY';

  // specify number of days after which logfile entries are deleted
  $del_older_days = 7;

  // *********************************** //


  // check if correct key has been stated
  $provkey = (isset($_GET['key'])) ? del_all(trim($_GET['key'])) : '';
  ($provkey == $key) or die('ERROR: Wrong key provided!');


  // get script parameters
  $mode = (isset($_GET['mode'])) ? del_all(trim($_GET['mode'])) : 'view';
  $dev = (isset($_GET['dev'])) ? del_all(trim($_GET['dev'])) : '';
  $type = (isset($_GET['type'])) ? del_all(trim($_GET['type'])) : '';
  $msg = (isset($_GET['msg'])) ? del_all(trim($_GET['msg'])) : '';


  $list = new CLog();
  $html = new CHtml();

  if($mode == 'view') {
    $html->content .= $list->listEntries();
    $html->make();

    // delete old entries from database
    $list->delOldEntries($del_older_days);
  }
  elseif($mode == 'add') {
    if(!empty($dev) || !empty($type) || !empty($msg)) {
      if($list->addEntry($dev, $type, $msg)) {
        echo 'add_successful';
      }
      else {
        echo 'add_failed';
      }
    }
    else {
      echo 'invalid_command';
    }
  }
  elseif($mode == 'clear') {
    if($list->delAllEntries()) {
      echo 'clear_successful';
    }
    else {
      echo 'clear_failed';
    }
  }
  elseif($mode == 'init') {
    if(file_exists('INITIALIZE')) {
      $list->initialize();
      echo 'init_successful';
    }
    else {
      echo 'init_failed';
    }
  }

?>