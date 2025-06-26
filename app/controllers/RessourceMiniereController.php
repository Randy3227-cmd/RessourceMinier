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

        $ressources = $ressourceMinierModel->getFilteredRessources($region, $type, $statut, $search);
        Flight::json($ressources);
    }

    

}