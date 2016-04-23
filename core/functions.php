<?php

/**
 * Debug function for printing variable.
 */
function debug($var, $file = "", $line = 0) {
  if ($file != "" && $line != 0) {
    echo "<strong>".$file."(".$line."):</strong>";
  }
  echo "<pre style='font-weight:bold;'>";
    print_r($var);
  echo "</pre>";
}

