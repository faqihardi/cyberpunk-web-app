<?php
class Character {
    private $db;
    public function __construct() {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM characters ORDER BY id ASC');
        return $this->db->results();
    }

    public function findById($id) {
        $this->db->query('SELECT * FROM characters WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function findByName($name) {
        $this->db->query('SELECT * FROM characters WHERE name = :name');
        $this->db->bind(':name', $name);
        return $this->db->result();
    }
}
