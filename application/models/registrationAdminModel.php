<?php
class registrationAdminModel extends CI_Model {
    public function save_admin($data) {
        return $this->db->insert('adminregistration', $data);
    }
}
?>