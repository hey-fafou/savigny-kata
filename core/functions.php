<?php

/**
 * Debug function. 
 * @brief pretty print arrays and variables.
 * @param [in] $var variable to print.
 * @param [in] $file file in which variable is printed.
 * @param [in] $line line where variable is printed.
 */
function debug($var, $file = "", $line = 0) {
  if ($file != "" && $line != 0) {
    echo "<strong>".$file."(".$line."):</strong>";
  }
  echo "<pre style='font-weight:bold;'>";
    print_r($var);
  echo "</pre>";
}

/**
 * Pagination function.
 * @brief Gives pagination on a view.
 * @param [in] $currentPage number of the current sub-page.
 * @param [in] $totalPages number of sub-pages.
 * @param [in] $view view on which apply pagination.
 */
function pagination($currentPage, $totalPages, $view) {
  // Printing pagination only if there is more than one sub-page.
  if ($totalPages > 1) {
    // Link to previous sub-page from current sub-page.
    echo  "<div class=\"pagination\">
            <ul>
              <li><a href=\"".BASE_URL.'/'.$view.'?page='.max(($currentPage-1), 1)."\">
                Prec.
                </a></li>";

    // Link to each sub-page.
    for($i = 1; $i <= $totalPages; $i++) {
      echo    "<li><a href=\"".BASE_URL.'/'.$view.'?page='.$i."\">
              ".$i."
              </a></li>";
    }

    // Link to next sub-page from current sub-page
    echo      "<li> <a href=\"".BASE_URL.'/'.$view.'?page='.min(($currentPage+1), $totalPages)."\">
               Suiv.
               </a> </li>
            </ul>
          </div>";
  }
}

/**
 * thumbnail function.
 * @brief Make thumbnail from picture.
 * @param [in] $filename file path of the picture.
 * @param [in] $max_width max width (px) of the picture.
 * @param [in] $max_height max height (px) of the picture.
 */
function thumbnail($filename, $max_width = 240, $max_height = 180) {
  // Compute new dimension
  list($width, $height) = getimagesize($_SERVER['DOCUMENT_ROOT'].$filename);
  $ratio = $width/$height;

  // If width > height
  if ($ratio > 1) {
    $max_height = ($height*$max_width)/$width;
  } else {
    $max_width = ($width*$max_height)/$height;
  }

  // Loading
  $thumb = imagecreatetruecolor($max_width, $max_height);
  $source = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].$filename);

  // Resizing image
  if (!imagecopyresampled($thumb, $source, 0, 0, 0, 0, $max_width, $max_height, $width, $height)) {
    die('imagecopyresampled failed.');
  }

  // Destroy previous image
  imagedestroy($source);

  // Save
  if (!imagejpeg($thumb, $_SERVER['DOCUMENT_ROOT'].$filename, 100)) {
    die('imagejpeg failed.');
  }
}
