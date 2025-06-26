<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte des Ressources Minières - Madagascar</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
            margin-top: 1rem;
        }
        .controls {
            margin: 10px;
        }
        .controls select, .controls input {
            margin-right: 10px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h2>Carte des Ressources Minières à Madagascar</h2>

    <div class="controls">
        <form id="filterForm">
            <select name="region" id="region">
                <option value="">-- Région --</option>
                <?php foreach ($regions as $region): ?>
                    <option value="<?= $region['id_region'] ?>"><?= $region['nom_region'] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="type" id="type">
                <option value="">-- Ressource --</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= $type['id_type'] ?>"><?= $type['nom_type'] ?></option>
                <?php endforeach; ?>
            </select>

            <select name="statut" id="statut">
                <option value="">-- Statut --</option>
                <?php foreach ($statuts as $statut): ?>
                    <option value="<?= $statut['id_statut'] ?>"><?= $statut['nom_statut'] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="text" id="recherche" placeholder="🔍 Nom du site">
            <button type="button" onclick="filtrer()">Filtrer</button>
            <button type="button" onclick="window.print()">🖨️ Imprimer</button>
        </form>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        const carte = L.map('map').setView([-18.8792, 47.5079], 6); // centre Madagascar

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap',
        }).addTo(carte);

        let marqueurs = [];

        function afficherRessources(data) {
            marqueurs.forEach(m => carte.removeLayer(m));
            marqueurs = [];

            data.forEach(ressource => {
                const marker = L.marker([ressource.latitude, ressource.longitude])
                    .addTo(carte)
                    .bindPopup(`
                        <strong>${ressource.nom_site}</strong><br>
                        ${ressource.description}<br>
                        <em>${ressource.nom_region} | ${ressource.nom_type} | ${ressource.nom_statut}</em>
                    `);

                marqueurs.push(marker);
            });
        }

        function filtrer() {
            const region = document.getElementById('region').value;
            const type = document.getElementById('type').value;
            const statut = document.getElementById('statut').value;
            const recherche = document.getElementById('recherche').value;

            fetch(`api/ressources?region=${region}&type=${type}&statut=${statut}&search=${recherche}`)
                .then(res => res.json())
                .then(data => afficherRessources(data));
        }

        // Charger les données initialement
        filtrer();
    </script>
</body>
</html>
