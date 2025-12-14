<?php
class Submission {
    private $db;
    public function __construct() {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function getAll() {
        $this->db->query('SELECT s.*, u.username as uploader FROM submissions s LEFT JOIN users u ON s.user_id = u.user_id ORDER BY s.created_at DESC');
        return $this->db->results();
    }

    public function findById($id) {
        $this->db->query('SELECT s.*, u.username as uploader FROM submissions s LEFT JOIN users u ON s.user_id = u.user_id WHERE s.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function create($data) {
        $this->db->query('INSERT INTO submissions (title, image, resolution, theme, author, user_id) VALUES (:title, :image, :resolution, :theme, :author, :user_id)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':resolution', $data['resolution']);
        $this->db->bind(':theme', $data['theme']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':user_id', $data['user_id']);
        return $this->db->execute();
    }

    public function update($id, $data) {
        $this->db->query('UPDATE submissions SET title = :title, image = :image, resolution = :resolution, theme = :theme, author = :author, user_id = :user_id, updated_at = NOW() WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':resolution', $data['resolution']);
        $this->db->bind(':theme', $data['theme']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM submissions WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
