<?php

class Recette {
    private $id;
    private $nom;
    private $paysOrigine;
    private $difficulte;
    private $detail;

    public function __construct($id, $nom, $paysOrigine, $difficulte, $detail) {
        $this->id = $id;
        $this->nom = $nom;
        $this->paysOrigine = $paysOrigine;
        $this->difficulte = $difficulte;
        $this->detail = $detail;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPaysOrigine() {
        return $this->paysOrigine;
    }

    public function getDifficulte() {
        return $this->difficulte;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPaysOrigine($paysOrigine) {
        $this->paysOrigine = $paysOrigine;
    }

    public function setDifficulte($difficulte) {
        $this->difficulte = $difficulte;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }
}