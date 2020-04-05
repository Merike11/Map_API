<?php

/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */

require "./config.php";
require "./common.php";

if (isset($_GET['id'])) {
  echo $_GET['id']; // for testing purposes
} else {
    echo "Something went wrong!";
    exit;
}
?>