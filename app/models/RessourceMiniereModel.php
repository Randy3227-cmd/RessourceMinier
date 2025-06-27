<?php

namespace app\models;

use Exception;

class RessourceMiniereModel
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    
    public function getFilteredRessources($region, $type, $statut, $search, $refLatitude, $refLongitude, $distance = 10000)
    {
        $sql = "SELECT 
                    rm.nom_site, 
                    rm.description, 
                    r.des_region, 
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
            $sql .= " AND r.id = ?";
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

    public function getById($id)
    {
        $sql = "SELECT * FROM ressource_miniere WHERE id_ressource = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
        ;
    }

    public function create($data)
    {
        $sql = "INSERT INTO ressource_miniere (nom_site, description, id_type_ressource, id_statut_ressource, image, geom, lien)
                VALUES (?, ?, ?, ?, ?, ST_SetSRID(ST_MakePoint(?, ?), 4326), ?)";
        $params = [
            $data['nom_site'],
            $data['description'],
            $data['id_type_ressource'],
            $data['id_statut_ressource'],
            $data['image'],
            $data['longitude'],
            $data['latitude'],
            $data['lien']
        ];
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);

    }

    public function update($id, $data)
    {
        $sql = "UPDATE ressource_miniere SET nom_site=?, description=?, id_type_ressource=?, id_statut_ressource=?, image=?, geom=ST_SetSRID(ST_MakePoint(?, ?), 4326), lien=?
                WHERE id_ressource=?";
        $params = [
            $data['nom_site'],
            $data['description'],
            $data['id_type_ressource'],
            $data['id_statut_ressource'],
            $data['image'],
            $data['longitude'],
            $data['latitude'],
            $data['lien'],
            $id
        ];
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ressource_miniere WHERE id_ressource = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getAll()
    {
        $sql = "SELECT 
                    rm.*, 
                    tr.nom_type, 
                    sr.nom_statut, 
                    ST_Y(rm.geom) AS latitude,
                    ST_X(rm.geom) AS longitude
                FROM ressource_miniere rm
                JOIN type_ressource tr ON rm.id_type_ressource = tr.id_type
                JOIN statut_ressource sr ON rm.id_statut_ressource = sr.id_statut";
        return $this->db->fetchAll($sql);
    }

    // Ajoute un historique de modification
    public function addHistoriqueModification($id_ressource, $description_modification)
    {
        $sql = "INSERT INTO historique_modification (id_ressource, description_modification) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_ressource, $description_modification]);
    }

    // Récupère l'historique des modifications pour une ressource
    public function getHistoriques($id_ressource)
    {
        $sql = "SELECT * FROM historique_modification WHERE id_ressource = ? ORDER BY date_modification DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ressource]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getStatpar_ressource_par_region()
    {
        $sql = "
        SELECT 
            r.nom_region,
            t.nom_type,
            COUNT(*) AS nombre_sites
        FROM 
            ressource_miniere rm
        JOIN 
            region r ON ST_Contains(r.geom, rm.geom)
        JOIN 
            type_ressource t ON rm.id_type_ressource = t.id_type
        GROUP BY 
            r.nom_region, t.nom_type
        ORDER BY 
            r.nom_region, t.nom_type
    ";

        $stat = $this->db->fetchAll($sql);
        return $stat;
    }

    public function get_repartition_type_resource()
    {
        $sql = " SELECT 
                t.nom_type AS type_ressource,
                COUNT(*) AS nombre_sites
            FROM 
                ressource_miniere rm
            JOIN 
                type_ressource t ON rm.id_type_ressource = t.id_type
            GROUP BY 
                t.nom_type
            ORDER BY 
                nombre_sites DESC
            ";
        $stat = $this->db->fetchAll($sql);
        return $stat;
    }

    public function get_repartition_par_statut()
    {
        $sql = " SELECT 
                s.nom_statut AS statut,
                COUNT(*) AS nombre_sites
            FROM 
                ressource_miniere rm
            JOIN 
                statut_ressource s ON rm.id_statut_ressource = s.id_statut
            GROUP BY 
                s.nom_statut
            ORDER BY 
                nombre_sites DESC
            ";
        $stat = $this->db->fetchAll($sql);
        return $stat;
    }



}