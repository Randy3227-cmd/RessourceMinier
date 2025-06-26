<?php
namespace app\models;

class AccueilModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRegions() {
        return $this->db->fetchAll("SELECT id_region, nom_region FROM region ORDER BY nom_region");
    }

    public function getTypes() {
        return $this->db->fetchAll("SELECT id_type, nom_type FROM type_ressource ORDER BY nom_type");
    }

    public function getStatuts() {
        return $this->db->fetchAll("SELECT id_statut, nom_statut FROM statut_ressource ORDER BY nom_statut");
    }
}
