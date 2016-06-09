<?php
class MediasModel extends Model {

  /**
   * upload method.
   * @brief handles the upload of a media.
   * @param [in] $data data to add into database.
   */
  public function upload($data) {
    // Save destination dir
    $dest_dir = $_SERVER['DOCUMENT_ROOT'].BASE_URL.'/webroot/img/'.$data['type'];

    // Create destination dir if not exists
    if (!file_exists($dest_dir)) {
      if(!mkdir($dest_dir, 0777, true)) {
        die('Echec lors de la création de '.$dest_dir);
      }
    }

    // Create new file name
    $file_ext = end(explode('.', $data['title']));
    $file_name = $data['type'].$data['post_id'].'.'.$file_ext;

    // Move file to destination dir
    if (move_uploaded_file($data['file'], $dest_dir.'/'.$file_name)) {
      // Update 'title' and 'file'
      $data['title'] = $file_name;
      $data['file'] = $dest_dir;

      // Save file une database
      parent::save($data);
    } else {
      die('Echec lors du déplacement de '.$data['file'].' vers '.$dest_dir.'/'.$file_name);
    }
  }

  /*
   * delete method.
   * @brief deletes file + media entry in database.
   * @param [in] $entry entry to delete.
   */
  public function delete($entry) {
    unlink($entry->file.'/'.$entry->title);
    parent::delete($entry->id);
  }
}
