<?php

class User
{
    private $db;

    public function __construct()
    {
        // TODO: Setup database connection
        // $this->db = new PDO(...);
    }

    public function getAll()
    {
        // SELECT * FROM users ORDER BY username
    }

    public function getById($id)
    {
        // SELECT * FROM users WHERE id = ?
    }

    public function emailExists($email, $excludeId = null)
    {
        // SELECT COUNT(*) FROM users WHERE email = ? AND id != ?
    }

    public function create($data)
    {
        // INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)
    }

    public function update($id, $data)
    {
        // UPDATE users SET username = ?, email = ?, ... WHERE id = ?
    }

    public function delete($id)
    {
        // DELETE FROM users WHERE id = ?
    }
}