<?php
class RecetteController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getRecetteById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM recettes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $recette = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($recette) {
            echo json_encode($recette);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Recette non trouvée']);
        }
    }

    public function getAllRecettes() {
        $stmt = $this->conn->query("SELECT * FROM recettes");
        $recettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($recettes);
    }

    public function addRecette() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['nom'], $data['pays_origine'], $data['difficulte'], $data['details'])) {
            $stmt = $this->conn->prepare("INSERT INTO recettes (nom, pays_origine, difficulte, details) VALUES (:nom, :pays_origine, :difficulte, :details)");
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':pays_origine', $data['pays_origine']);
            $stmt->bindParam(':difficulte', $data['difficulte']);
            $stmt->bindParam(':details', $data['details']);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(["message" => "Recette ajoutée avec succès"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Erreur lors de l'ajout de la recette"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Champs requis manquants"]);
        }
    }
}
    