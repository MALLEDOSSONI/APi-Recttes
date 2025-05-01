<?php

class RecetteController {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getAllRecettes() {
        $query = "SELECT * FROM recettes";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function getRecetteById($id) {
        $query = "SELECT * FROM recettes WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function addRecette($data) {
        $query = "INSERT INTO recettes (nom, pays, difficulte, detail) VALUES (:nom, :pays, :difficulte, :detail)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':pays', $data['pays']);
        $stmt->bindParam(':difficulte', $data['difficulte'], PDO::PARAM_INT);
        $stmt->bindParam(':detail', $data['detail']);
        
        if ($stmt->execute()) {
            return json_encode(['message' => 'Recette ajoutée avec succès']);
        } else {
            return json_encode(['message' => 'Erreur lors de l\'ajout de la recette']);
        }
    }
}