<style>
    body {
        background: #f4f1ec;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        color: #2f2f2f;
    }
    h1 {
        background: #3e3e3e;
        color: #f9c74f;
        padding: 1rem;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    table {
        width: 90%;
        margin: 0 auto 2rem auto;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        padding: 10px 8px;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
    }
    th {
        background: #f9c74f;
        color: #3e3e3e;
        font-weight: 600;
    }
    tr:last-child td {
        border-bottom: none;
    }
    a {
        display: inline-block;
        background: #7b4f29;
        color: #fff;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 500;
        transition: background 0.2s;
    }
    a:hover {
        background: #9b6937;
    }
</style>
<h1>Historique des modifications<br>
    <small><?= htmlspecialchars($ressource['nom_site']) ?></small>
</h1>
<a href="<?= BASE_URL?>/ressources">← Retour à la liste</a>
<table>
    <thead>
        <tr>
            <th>Date de modification</th>
            <th>Raison / Description</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($historiques)): ?>
            <tr><td colspan="2">Aucune modification enregistrée.</td></tr>
        <?php else: ?>
            <?php foreach ($historiques as $h): ?>
                <tr>
                    <td><?= htmlspecialchars($h['date_modification']) ?></td>
                    <td><?= nl2br(htmlspecialchars($h['description_modification'])) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
