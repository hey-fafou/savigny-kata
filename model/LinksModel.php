<?php
class LinksModel extends Model {

  /**
   * upload method.
   * @brief handles the upload of a document.
   * @param [in] $data information about the document.
   */
  public function upload($data) {
    // Save destination dir
    $dest_dir = $_SERVER['DOCUMENT_ROOT'].BASE_URL.'/webroot/doc/';

    // Move file to destination dir
    if (!move_uploaded_file($data['file'], $dest_dir.'/'.$data['title'])) {
      die('Echec lors du déplacement de '.$data['file'].' vers '.$dest_dir.'/'.$file_name);
    }
  }

  /*
   * delete method.
   * @brief deletes file + entry in database.
   * @param [in] $entry entry to delete.
   */
  public function delete($entry) {
    unlink($_SERVER['DOCUMENT_ROOT'].$entry->link);
    parent::delete($entry->id);
  }
}
