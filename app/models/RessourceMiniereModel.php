<?php

namespace app\models;

use Exception;

class RessourceMiniereModel {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFilteredRessources($region, $type, $statut, $search, $refLatitude, $refLongitude, $distance = 10000) {
        $sql = "SELECT 
                    rm.nom_site, 
                    rm.description, 
                    r.nom_region, 
                    tr.nom_type AS nom_type,
                    sr.nom_statut AS nom_statut,
                    ST_Y(rm.geom) AS latitude, 
                    ST_X(rm.geom) AS longitude";
    
        $params = [];
    
        if ($refLatitude && $refLongitude) {
            $sql .= ", ST_DistanceSphere(rm.geom, ST_MakePoint(?, ?)) / 1000 AS distance_km";
            $params[] = $refLongitude;
            $params[] = $refLatitude;
        }
    
        $sql .= " 
            FROM ressource_miniere rm
            JOIN region r ON ST_Contains(r.geom, rm.geom)
            JOIN type_ressource tr ON rm.id_type_ressource = tr.id_type
            JOIN statut_ressource sr ON rm.id_statut_ressource = sr.id_statut
            WHERE 1=1";
    
        if ($refLatitude && $refLongitude) {
            $sql .= " AND ST_DistanceSphere(rm.geom, ST_MakePoint(?, ?)) <= ?";
            $params[] = $refLongitude;
            $params[] = $refLatitude;
            $params[] = $distance;
        }
    
        if ($region) {
            $sql .= " AND r.id_region = ?";
            $params[] = $region;
        }
    
        if ($type) {
            $sql .= " AND rm.id_type_ressource = ?";
            $params[] = $type;
        }
    
        if ($statut) {
            $sql .= " AND rm.id_statut_ressource = ?";
            $params[] = $statut;
        }
    
        if ($search) {
            $sql .= " AND LOWER(rm.nom_site) LIKE LOWER(?)";
            $params[] = "%" . $search . "%";
        }
    
        return $this->db->fetchAll($sql, $params);
    }
    
    
    
    
   
    
    
}