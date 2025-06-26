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

    

}