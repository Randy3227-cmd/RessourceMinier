<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte des Ressources Minières - Madagascar</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f1ec;
            color: #2f2f2f;
        }

        h2 {
            background-color: #3e3e3e;
            color: #f9c74f;
            padding: 1rem;
            margin: 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        #map {
            height: 600px;
            width: 100%;
        }

        .controls {
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            justify-content: center;
        }

        .controls select, .controls input, .controls button {
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.95rem;
        }

        .controls select {
            background-color: #f9f5f0;
        }

        .controls button {
            background-color: #7b4f29;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .controls button:hover {
            background-color: #9b6937;
        }

        .leaflet-popup-content {
            font-size: 0.9rem;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <h2>🪨 Carte des Ressources Minières à Madagascar</h2>
    <div style="text-align:center; margin: 1.2rem 0;">
        <a href="ressources" style="
            background: #7b4f29;
            color: #fff;
            padding: 10px 22px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.08rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
            transition: background 0.2s;
            display: inline-block;
        " onmouseover="this.style.background='#9b6937'" onmouseout="this.style.background='#7b4f29'">
            ➕ Gérer les ressources minières
        </a>
    </div>

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
            <input type="text" name="latitude" id="latitude" placeholder="Latitude" readonly>
            <input type="text" name="longitude" id="longitude" placeholder="Longitude" readonly>
            <input type="number" name="rayon" id="rayon" placeholder="Rayon en metre (default : 10000m)">
            <input type="text" id="recherche" placeholder="🔍 Nom du site">
            <button type="button" onclick="filtrer()">Filtrer</button>
            <button type="button" onclick="window.print()">🖨️ Imprimer</button>
            <button type="button" onclick="geolocaliser()">📍 Ma position</button>
            <button type="button" onclick="statistiques()">📊 Statistiques</button>
        </form>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>

        function statistiques() {
            window.location.href = 'statistiques';
        }
        
    function geolocaliser() {
    navigator.geolocation.getCurrentPosition(
        position => {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            ajouterMarqueurUtilisateur(document.getElementById('latitude').value, document.getElementById('longitude').value);
        }
    );
    let markerUtilisateur = null;

    function ajouterMarqueurUtilisateur(lat, lon) {
        if (markerUtilisateur) {
            carte.removeLayer(markerUtilisateur);
        }

        markerUtilisateur = L.marker([lat, lon], {
            title: "Votre position",
            icon: L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            })
        }).addTo(carte).bindPopup("📍 Vous êtes ici").openPopup();
    }
}
    </script>
    <script>


        const carte = L.map('map').setView([-18.8792, 47.5079], 6); // Centre Madagascar

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
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;
            const rayon = document.getElementById('rayon').value;
            fetch(`api/ressources?region=${region}&type=${type}&statut=${statut}&search=${recherche}&latitude=${latitude}&longitude=${longitude}&rayon=${rayon}`)
                .then(res => res.json())
                .then(data => afficherRessources(data));
        }

        filtrer(); // Chargement initial

        let markerClic = null;

        carte.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(6);
            const lon = e.latlng.lng.toFixed(6);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;

            if (markerClic) {
                carte.removeLayer(markerClic);
            }

            markerClic = L.marker([lat, lon], {
                title: "Position sélectionnée"
            }).addTo(carte).bindPopup("📍 Position choisie").openPopup();
        });
    </script>
</body>
</html>
