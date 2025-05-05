=========================
Projet Restaurant MVC PHP
=========================

Description du projet
---------------------
Ce projet est un site web pour un restaurant, développé en architecture MVC (Modèle-Vue-Contrôleur). 
Il permet à des utilisateurs de consulter les prestations proposées et de créer un compte, 
et aux administrateurs de gérer dynamiquement toutes les données liées aux prestations du restaurant via une interface d'administration.

Fonctionnalités
---------------
1. Partie Utilisateur :
   - Création de compte et connexion.
   - Visualisation des prestations avec tarifs.

2. Partie Administrateur :
   - Authentification sécurisée.
   - Affichage de toutes les tables de la base de données.
   - Ajout, modification et suppression des entrées de chaque table.

Technologies utilisées
----------------------
- HTML5 / CSS3
- Bootstrap 5
- PHP (POO)
- MySQL
- XAMPP (local) / LWS (hébergement)
- GitHub pour le versioning

Structure des dossiers (Arborescence)
-------------------------------------
.
├── controller/
│   ├── authController.php
│   ├── prestationsController.php
│   └── adminController.php
│
├── model/
│   ├── database.php
│   ├── userModel.php
│   └── prestationModel.php
│
├── view/
│   ├── front/
│   │   ├── accueil.php
│   │   ├── login.php
│   │   ├── register.php
│   │   └── prestations.php
│   │
│   ├── admin/
│   │   ├── dashboard.php
│   │   ├── edit.php
│   │   └── tables/
│   │       ├── prestations.php
│   │       └── users.php
│   │
│   └── template/
│       ├── header.php
│       ├── footer.php
│       └── nav.php
│
├── public/
│   ├── css/
│   ├── js/
│   └── images/
│
├── index.php
└── .htaccess

Schéma de la base de données
----------------------------
+--------------+           +-----------+           +--------------+
|   droits     |           | categories|           | prestations  |
+--------------+           +-----------+           +--------------+
| id (PK)      |           | id (PK)   |           | id (PK)      |
| nom          |           | nom       |           | nom          |
+--------------+           +-----------+           +--------------+
       ^                          ^                       ^
       |                          |                       |
       |                          |                       |
       |         +-------------------------------+        |
       |         |                               |        |
       |         |                               |        |
       |   +------------------+           +------------------+
       |   |      users       |           |       prix       |
       |   +------------------+           +------------------+
       +---| id_droit  (FK)   |           | id_prestation(FK)|
           | id_categorie(FK) |-----------| id_categorie (FK)|
           | id (PK)          |           | id (PK)          |
           | nom              |           | prix             |
           | prenom           |           +------------------+
           | email            |
           | password         |
           | date_creation    |
           +------------------+


Note : Les administrateurs sont des utilisateurs avec le champ "role" à "admin".

Installation locale
-------------------
1. Cloner le dépôt GitHub :
   git clone https://github.com/LksRolls/ProjetRestaurantExamen.git

2. Copier le projet dans le dossier `htdocs` de XAMPP.

3. Créer une base de données `restaurant` dans phpMyAdmin.

4. Importer le fichier `restaurant.sql` fourni dans le dépôt.

5. Lancer le serveur Apache et MySQL via XAMPP.

6. Accéder au site à l’adresse : http://localhost/ProjetRestaurantExamen/

Hébergement en ligne
--------------------
Le site est hébergé sur LWS à l'adresse suivante :
https://portfolio.lukasrolland.fr/Restaurant/

Dépôt GitHub
------------
Le projet est disponible à l'adresse :
https://github.com/LksRolls/ProjetRestaurantExamen

Auteur
------
Lukas Rolland  
BTS SIO SLAM – Projet Personnel 2025