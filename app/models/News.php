<?php
class News {
    private $db;
    public function __construct() {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM news ORDER BY updated_at DESC, created_at DESC');
        return $this->db->results();
    }

    public function findById($id) {
        $this->db->query('SELECT * FROM news WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function create($data) {
        $this->db->query('INSERT INTO news (version, header, content, updated_by) VALUES (:version, :header, :content, :updated_by)');
        $this->db->bind(':version', $data['version']);
        $this->db->bind(':header', $data['header']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':updated_by', $data['updated_by']);
        return $this->db->execute();
    }

    public function update($id, $data) {
        $this->db->query('UPDATE news SET version = :version, header = :header, content = :content, updated_by = :updated_by, updated_at = NOW() WHERE id = :id');
        $this->db->bind(':version', $data['version']);
        $this->db->bind(':header', $data['header']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':updated_by', $data['updated_by']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
