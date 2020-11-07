<?php
/* Web-based Server Logfile
   Fabian Faul (faullab.com) */

if(!defined('INC_HTML')){
  define('INC_HTML', true);


  class CHtml
  {
    var $title;
    var $content;


    public function __construct() {
      $this->title = 'Web-based Server Logfile';
			$this->content = '';
    }

    // print HTML code
    public function make() {
?>
      <!doctype html>
      <html lang="en">
        <head>
          <meta charset="utf-8">

          <!-- project of faullab.com -->

          <title><?=$this->title ?></title>
          <meta name="language" content="en">
          <meta name="author" content="faullab.com">
          <meta name="description" content="<?=$this->title ?>">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

          <style type="text/css">
            html, body {
              padding: 5px;
              font-size: 1em;
              background-color: #FFF;

              font-family: 'Courier New', serif;
            }

            div#header h1 {
              margin: 5px 2px;
              font-size: 3em;
              font-weight: bold;
              color: #EEE;
            }

            .table {
              display: table;
              border-spacing: 0;
            }
            .table-row {
              display: table-row;
            }
            .table-cell {
              display: table-cell;
              padding: 2px 7px;
            }

            .red {
              background-color: #f55;
            }
          </style>
        </head>
        <body>
          <h1><?=$this->title ?></h1>
          <div id="wrapper">
            <?=$this->content ?>
          </div>
        </body>
      </html>
<?php
    }

  };
}
?>