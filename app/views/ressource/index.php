<style>
    body {
        background: #f7f6f3;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        color: #2f2f2f;
    }
    h1 {
        background: #f9c74f;
        color: #3e3e3e;
        padding: 1rem;
        text-align: center;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        letter-spacing: 1px;
        font-weight: 700;
    }
    .actions-bar {
        text-align: center;
        margin-bottom: 2rem;
    }
    .actions-bar a {
        background: #fff;
        color: #7b4f29;
        padding: 10px 22px;
        border-radius: 7px;
        text-decoration: none;
        margin: 0 8px;
        font-weight: 600;
        font-size: 1.07rem;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        display: inline-block;
        box-shadow: 0 2px 8px rgba(123,79,41,0.06);
        border: 1.5px solid #f9c74f;
    }
    .actions-bar a:hover {
        background: #f9c74f;
        color: #3e3e3e;
        box-shadow: 0 4px 16px rgba(249,199,79,0.10);
    }
    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
        margin-bottom: 2rem;
    }
    .card {
        background: #fff;
        border-radius: 13px;
        box-shadow: 0 2px 12px rgba(60,60,60,0.07);
        width: 340px;
        padding: 1.5rem 1.3rem 1.2rem 1.3rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: relative;
        transition: box-shadow 0.2s, transform 0.2s;
        border: 1px solid #f3e7c9;
    }
    .card:hover {
        box-shadow: 0 6px 24px rgba(123,79,41,0.13);
        transform: translateY(-2px) scale(1.015);
        border-color: #f9c74f;
    }
    .card-title {
        font-size: 1.22rem;
        font-weight: 700;
        color: #7b4f29;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }
    .card-desc {
        font-size: 1.01rem;
        margin-bottom: 0.7rem;
        color: #444;
        min-height: 40px;
        background: #f8f6f1;
        border-radius: 6px;
        padding: 7px 10px;
        box-shadow: 0 1px 4px rgba(249,199,79,0.04);
    }
    .card-meta {
        font-size: 0.98rem;
        color: #b08a4a;
        margin-bottom: 0.5rem;
        font-weight: 600;
        letter-spacing: 0.2px;
    }
    .card-img {
        width: 100%;
        max-width: 120px;
        border-radius: 7px;
        box-shadow: 0 1px 8px rgba(249,199,79,0.07);
        margin-bottom: 0.7rem;
        align-self: center;
        border: 1.5px solid #f3e7c9;
        background: #fff;
    }
    .card-row {
        margin-bottom: 0.3rem;
        font-size: 0.97rem;
        color: #7b4f29;
        background: #f9f6ef;
        border-radius: 4px;
        padding: 2px 8px;
        display: inline-block;
    }
    .card-link {
        color: #fff;
        background: #b08a4a;
        padding: 4px 12px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        margin-right: 8px;
        font-size: 0.97rem;
        transition: background 0.2s, color 0.2s;
        border: none;
        box-shadow: 0 1px 4px rgba(249,199,79,0.06);
    }
    .card-link:hover {
        background: #7b4f29;
        color: #fffbe7;
    }
    .card-actions {
        margin-top: 1rem;
        width: 100%;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .card-actions a {
        background: #f3e7c9;
        color: #7b4f29;
        padding: 6px 14px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.97rem;
        font-weight: 500;
        transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        margin-right: 0.2rem;
        border: none;
        box-shadow: 0 1px 4px rgba(123,79,41,0.04);
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .card-actions a:hover {
        background: #f9c74f;
        color: #3e3e3e;
        box-shadow: 0 2px 8px rgba(249,199,79,0.10);
    }
</style>

<h1>Liste des ressources minières</h1>
<div class="actions-bar">
    <a href="<?= BASE_URL?>/">← Retour à l'accueil</a>
    <a href="<?= BASE_URL?>/ressources/create">Ajouter une ressource</a>
</div>
<div class="cards-container">
    <?php foreach ($ressources as $r): ?>
        <div class="card">
            <div class="card-title"><?= htmlspecialchars($r['nom_site']) ?></div>
            <?php if (!empty($r['image'])): ?>
                <img class="card-img" src="<?= BASE_URL?>/<?= htmlspecialchars($r['image']) ?>" alt="Image">
            <?php endif; ?>
            <div class="card-desc"><?= htmlspecialchars($r['description']) ?></div>
            <div class="card-meta">
                <?= htmlspecialchars($r['nom_type'] ?? '') ?> | <?= htmlspecialchars($r['nom_statut'] ?? '') ?>
            </div>
            <div class="card-row"><b>Latitude:</b> <?= htmlspecialchars($r['latitude'] ?? '') ?></div>
            <div class="card-row"><b>Longitude:</b> <?= htmlspecialchars($r['longitude'] ?? '') ?></div>
            <?php if (!empty($r['lien'])): ?>
                <div class="card-row">
                    <a class="card-link" href="<?= htmlspecialchars($r['lien']) ?>" target="_blank">Lien</a>
                </div>
            <?php endif; ?>
            <div class="card-actions">
                <a href="ressources/edit/<?= $r['id_ressource'] ?>" title="Modifier">
                    <!-- Icône crayon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" style="vertical-align:middle;margin-right:4px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H7v-3a2 2 0 01.586-1.414z"/>
                    </svg>
                    Modifier
                </a>
                <a href="/ressources/delete/<?= $r['id_ressource'] ?>" onclick="return confirm('Supprimer ?')" title="Supprimer">
                    <!-- Icône poubelle -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" style="vertical-align:middle;margin-right:4px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10"/>
                    </svg>
                    Supprimer
                </a>
                <a href="ressources/historique/<?= $r['id_ressource'] ?>">Voir historique</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
    
</div>
