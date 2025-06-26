-- mbola
INSERT INTO ressource_miniere (
    nom_site, description, id_type_ressource, id_statut_ressource, geom, lien
) VALUES
('Norcross Madagascar', 'Mine de nickel et cobalt, grande exploitation industrielle.', 2, 3,
    ST_SetSRID(ST_MakePoint(47.1237814, -18.809629), 4326), 'https://www.facebook.com/MadagascarMinerals/?locale2=zh_CN&_rdr');

-- oui
INSERT INTO ressource_miniere (
    nom_site, description, id_type_ressource, id_statut_ressource, geom, lien
) VALUES
('Andrafiamena Andavakoera Protected Area', 'Or alluvionnaire', 1, 3,
    ST_SetSRID(ST_MakePoint(49.2323121, -13.0079407), 4326), 'https://www.fapbm.org/en/aire_protegee/andrafiamena-andavakoera-2/');


INSERT INTO ressource_miniere (
    nom_site, description, id_type_ressource, id_statut_ressource, geom, lien
) VALUES
('Sahamamy project (Tirupati Graphite PLC)', 'Nickel latéritique', 2, 2,
    ST_SetSRID(ST_MakePoint(48.1058163, -18.5914427), 4326), 'https://tirupatigraphite.co.uk/');
