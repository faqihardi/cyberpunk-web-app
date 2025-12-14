<?php

class User
{
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function create($data)
    {
        $this->db->query('INSERT INTO users (name, username, email, password, is_admin) VALUES (:name, :username, :email, :password, :is_admin)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':is_admin', isset($data['is_admin']) ? $data['is_admin'] : 0);
        return $this->db->execute();
    }

    public function findById($id)
    {
        $this->db->query('SELECT * FROM users WHERE user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function findByUsernameOrEmail($ident)
    {
        $this->db->query('SELECT * FROM users WHERE username = :ident OR email = :ident LIMIT 1');
        $this->db->bind(':ident', $ident);
        return $this->db->result();
    }

    public function existsByUsernameOrEmail($username, $email)
    {
        $this->db->query('SELECT user_id FROM users WHERE username = :username OR email = :email');
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);
        return $this->db->result() ? true : false;
    }
}