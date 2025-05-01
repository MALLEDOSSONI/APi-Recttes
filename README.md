# Recettes API

Ce projet propose une API REST pour la gestion de recettes de cuisine à travers le monde. Les utilisateurs ont la possibilité de récupérer, d'ajouter et d'interagir avec des recettes stockées dans une base de données grâce à cette fonctionnalité.

 Structure du projet

Le projet est organisé comme suit :


recettes-api
├── database
│   └── recettes_api.sql          # Script SQL pour créer la base de données et la table des recettes
├── src
│   ├── recettes.php               # Point d'accès à l'API
│   ├── config
│   │   └── database.php           # Configuration de la connexion à la base de données
│   ├── controllers
│   │   └── RecetteController.php   # Contrôleur pour gérer les recettes
│   └── models
│       └── Recette.php            # Modèle de données pour une recette
├── composer.json                   # Configuration pour Composer
└── README.md                       # Documentation du projet


Installation

1. Decompresse sur votre machine locale.
2. Importez le fichier "database/recettes_api.sql" dans votre serveur MySQL pour créer la base de données et la table.
3. Configurez les paramètres de connexion à la base de données dans "src/config/database.php".


Utilisation de l'API

L'API offre les fonctionnalités suivantes :

-Récupérer toutes les recettes : Effectuez une requête GET sur "/src/recettes.php".
- "Récupérer une recette spécifique": Effectuez une requête GET sur "/src/recettes.php?id={id}" où "{id}" est l'identifiant de la recette.
- "Ajouter une nouvelle recette" : Effectuez une requête POST sur "/src/recettes.php" avec les données de la recette au format JSON.

http://localhost/API%20RECETTE/recettes-api/index.php/recettes

