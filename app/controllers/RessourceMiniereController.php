<?php

namespace app\controllers;
use app\models\RessourceMiniereModel;
use Exception;
use Flight;

class RessourceMiniereController {

    public function __construct() {
    }

    public function getRessources() {
        $ressourceMinierModel = new RessourceMiniereModel(Flight::db());
        $region = Flight::request()->query['region'] ?? null;
        $type = Flight::request()->query['type'] ?? null;
        $statut = Flight::request()->query['statut'] ?? null;
        $search = Flight::request()->query['search'] ?? null;
        $latitude = Flight::request()->query['latitude'] ?? null;
        $longitude = Flight::request()->query['longitude'] ?? null;
        $rayon = Flight::request()->query['rayon'] ?? null; 

        $ressources = $ressourceMinierModel->getFilteredRessources($region, $type, $statut, $search,$latitude,$longitude, $rayon);
        Flight::json($ressources);
    }

    public function index() {
        $model = new \app\models\RessourceMiniereModel(\Flight::db());
        $ressources = $model->getAll();
        \Flight::render('ressource/index.php', ['ressources' => $ressources]);
    }

    public function createForm() {
        $db = \Flight::db();
        $types = $db->fetchAll("SELECT id_type, nom_type FROM type_ressource ORDER BY nom_type");
        $statuts = $db->fetchAll("SELECT id_statut, nom_statut FROM statut_ressource ORDER BY nom_statut");
        \Flight::render('ressource/create.php', ['types' => $types, 'statuts' => $statuts]);
    }

    public function create() {
        $data = $_POST;
        $image = null;
        if (!empty($_FILES['image']['name'])) {
            $targetDir = 'public/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = $targetFile;
            }
        }
        $data['image'] = $image;
        $model = new \app\models\RessourceMiniereModel(\Flight::db());
        $model->create($data);
        \Flight::redirect('/ressources');
    }

    public function editForm($id) {
        $db = \Flight::db();
        $model = new \app\models\RessourceMiniereModel($db);
        $ressource = $model->getById($id);
        $types = $db->fetchAll("SELECT id_type, nom_type FROM type_ressource ORDER BY nom_type");
        $statuts = $db->fetchAll("SELECT id_statut, nom_statut FROM statut_ressource ORDER BY nom_statut");
        \Flight::render('ressource/edit.php', ['ressource' => $ressource, 'types' => $types, 'statuts' => $statuts]);
    }

    public function update($id) {
        $data = $_POST;
        $model = new \app\models\RessourceMiniereModel(\Flight::db());
        $ressource = $model->getById($id);
        $image = $ressource['image'];
        if (!empty($_FILES['image']['name'])) {
            $targetDir = 'public/uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $filename = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetFile = $targetDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                $image = $targetFile;
            }
        }
        $data['image'] = $image;
        $model->update($id, $data);

        // Ajout historique modification
        if (!empty($data['raison_modification'])) {
            $model->addHistoriqueModification($id, $data['raison_modification']);
        }

        \Flight::redirect('/ressources');
    }

    // Affichage de l'historique pour une ressource
    public function historique($id) {
        $model = new \app\models\RessourceMiniereModel(\Flight::db());
        $historiques = $model->getHistoriques($id);
        $ressource = $model->getById($id);
        \Flight::render('ressource/historique.php', [
            'historiques' => $historiques,
            'ressource' => $ressource
        ]);
    }

    public function delete($id) {
        $model = new \app\models\RessourceMiniereModel(\Flight::db());
        $model->delete($id);
        \Flight::redirect('/ressources');
    }

}