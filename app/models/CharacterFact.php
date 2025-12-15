<?php
class CharacterFact {
    private $db;
    public function __construct() {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function getByCharacterId($character_id) {
        $this->db->query('SELECT fact FROM character_facts WHERE character_id = :character_id ORDER BY id ASC');
        $this->db->bind(':character_id', $character_id);
        return $this->db->results();
    }
}
