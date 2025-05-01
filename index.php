<?php
header('Content-Type: application/json');
require_once __DIR__ . '/src/config/database.php';

// Crée une seule instance de la connexion DB, utilisable partout
$database = new Database();
$pdo = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

// Vérifiez si PATH_INFO est défini
if (!isset($_SERVER['PATH_INFO'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request. PATH_INFO is missing.']);
    exit;
}

$path = isset($_SERVER['PATH_INFO']) ? explode('/', trim($_SERVER['PATH_INFO'], '/')) : [];

$resource = $path[0] ?? null;
$id = $path[1] ?? null;

// Traitement GET direct via fonction
if ($resource === 'recettes' && $id && $method === 'GET') {
    getRecetteById($pdo, $id);
    exit;
}

// Switch par méthode
switch ($method) {
    case 'GET':
        if ($resource === 'recettes') {
            if ($id) {
                $stmt = $pdo->prepare('SELECT * FROM recettes WHERE id = :id');
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $recette = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($recette) {
                    echo json_encode($recette);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Recette not found']);
                }
            } else {
                $stmt = $pdo->query('SELECT * FROM recettes');
                $recettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($recettes);
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Resource not found']);
        }
        break;

    case 'POST':
        if ($resource === 'recettes') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['nom'], $data['pays_origine'], $data['difficulte'], $data['details'])) {
                $stmt = $pdo->prepare('INSERT INTO recettes (nom, pays_origine, difficulte, details) VALUES (:nom, :pays_origine, :difficulte, :details)');
                $stmt->bindParam(':nom', $data['nom']);
                $stmt->bindParam(':pays_origine', $data['pays_origine']);
                $stmt->bindParam(':difficulte', $data['difficulte'], PDO::PARAM_INT);
                $stmt->bindParam(':details', $data['details']);

                if ($stmt->execute()) {
                    http_response_code(201);
                    echo json_encode(['message' => 'Recette added successfully']);
                } else {
                    http_response_code(500);
                    echo json_encode(['error' => 'Failed to add recette']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Resource not found']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}

// Correction : passer $pdo comme paramètre
function getRecetteById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM recettes WHERE id = ?");
    $stmt->execute([$id]);
    $recette = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recette) {
        echo json_encode($recette);
    } else {
        echo json_encode(['error' => 'Recette introuvable']);
    }
}
?>
