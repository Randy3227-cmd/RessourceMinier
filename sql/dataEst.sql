INSERT INTO ressource_miniere (
    nom_site, description, id_type_ressource, id_statut_ressource, geom, lien
) VALUES
('Ambatovy', 'Mine de nickel et cobalt, grande exploitation industrielle à Moramanga (Alaotra-Mangoro).', 2, 3,
    ST_SetSRID(ST_MakePoint(48.3000, -18.8167), 4326), 'https://en.wikipedia.org/wiki/Ambatovy_mine'),
    
('Sahamamy', 'Exploitation de graphite flake à Fetraomby (Brickaville, Atsinanana).', 6, 3,
    ST_SetSRID(ST_MakePoint(48.9167, -18.5833), 4326), 'https://www.mindat.org/loc-304454.html'),
    
('Bemainty', 'Zone d''exploitation artisanale de rubis et saphirs à Ambatondrazaka (Alaotra-Mangoro).', 7, 3,
    ST_SetSRID(ST_MakePoint(48.6383, -17.9522), 4326), 'https://en.wikipedia.org/wiki/Ambatondrazaka'),
    
('Didy', 'Exploitation artisanale de rubis et saphirs dans la région de Didy (Alaotra-Mangoro).', 7, 3,
    ST_SetSRID(ST_MakePoint(48.5333, -18.1167), 4326), 'https://en.wikipedia.org/wiki/Didy'),
    
('Sahanavo/Vohitasara', 'Site artisanal d''extraction de graphite flake à Brickaville (Atsinanana).', 6, 3,
    ST_SetSRID(ST_MakePoint(48.7712, -19.0481), 4326), 'https://www.mindat.org/locentry-1250194.html'),
    
('Antanambao-Manampotsy', 'Exploitation artisanale d''or alluvial et filonien dans l''Atsinanana.', 1, 3,
    ST_SetSRID(ST_MakePoint(48.5240, -19.4836), 4326), 'https://en.wikipedia.org/wiki/Antanambao_Manampotsy'),
    
('Vavatenina', 'Site artisanal d''extraction d''or alluvial et filonien dans l''Analanjirofo.', 1, 3,
    ST_SetSRID(ST_MakePoint(48.8667, -17.6333), 4326), 'https://en.wikipedia.org/wiki/Vavatenina'),
    
('Zahamena', 'Zone riche en rubis, or et résidus miniers, exploitation artisanale dans l''Analanjirofo.', 7, 3,
    ST_SetSRID(ST_MakePoint(48.8769, -17.6380), 4326), 'https://en.wikipedia.org/wiki/Zahamena'),
    
('Ambodimangavalo', 'Exploitation artisanale de rubis et minéraux divers dans la zone Zahamena (Analanjirofo).', 7, 3,
    ST_SetSRID(ST_MakePoint(48.8769, -17.6380), 4326), 'https://en.wikipedia.org/wiki/Zahamena'),
    
('Ampasimbe', 'Site artisanal d''extraction de graphite flake à Brickaville (Atsinanana).', 6, 3,
    ST_SetSRID(ST_MakePoint(48.7736, -19.0481), 4326), 'https://en.wikipedia.org/wiki/Vohibinany_(district)');