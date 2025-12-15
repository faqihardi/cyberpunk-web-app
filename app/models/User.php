    
<?php

class User
{
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->query('SELECT user_id as id, name, username, email, is_admin FROM users ORDER BY user_id ASC');
        return $this->db->results();
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
        $this->db->query('SELECT user_id as id, name, username, email, is_admin FROM users WHERE user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->result();
    }

    public function findByUsername($username)
    {
        $this->db->query('SELECT user_id as id, name, username, email, is_admin FROM users WHERE username = :username');
        $this->db->bind(':username', $username);
        return $this->db->result();
    }

    public function findByEmail($email)
    {
        $this->db->query('SELECT user_id as id, name, username, email, is_admin FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->result();
    }

    public function update($id, $data)
    {
        $query = 'UPDATE users SET name = :name, username = :username, email = :email';
        
        // updaet admin
        if (isset($data['is_admin'])) {
            $query .= ', is_admin = :is_admin';
        }
        
        if (!empty($data['password'])) {
            $query .= ', password = :password';
        }
        
        $query .= ' WHERE user_id = :id';
        
        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        
        if (isset($data['is_admin'])) {
            $this->db->bind(':is_admin', $data['is_admin']);
        }
        
        if (!empty($data['password'])) {
            $this->db->bind(':password', $data['password']);
        }
        
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM users WHERE user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
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