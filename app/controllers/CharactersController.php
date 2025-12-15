<?php

class CharactersController extends Controller
{
    public function index() 
    {
           require_once __DIR__ . '/../models/Character.php';
           $characterModel = new Character();
           $characters = $characterModel->getAll();
           $slides = array_chunk($characters, 2);
           $this->view('characters/index', compact('slides'));

        // pecah 2 per page
        $slides = array_chunk($characters, 2);
        $this->view('characters/index', compact('slides'));    
    }

    public function detail($id = 0)
    {
        require_once __DIR__ . '/../models/Character.php';
        require_once __DIR__ . '/../models/CharacterFact.php';
        $characterModel = new Character();
        $factModel = new CharacterFact();
        $character = $characterModel->findById($id);
        if (!$character) {
            $this->view('characters/not_found', [
                'charId' => $id
            ]);
            return;
        }
        $facts = $factModel->getByCharacterId($id);
        $this->view('characters/detail', [
            'data' => $character,
            'facts' => $facts
        ]);
    }
}