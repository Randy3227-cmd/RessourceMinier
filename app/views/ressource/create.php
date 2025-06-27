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
        letter-spacing: 1px;
    }
    form {
        background: #fff;
        max-width: 480px;
        margin: 0 auto 2rem auto;
        padding: 2.5rem 2.5rem 2rem 2.5rem;
        border-radius: 14px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.09);
    }
    label {
        display: block;
        margin-top: 1.2rem;
        font-weight: 600;
        color: #7b4f29;
        letter-spacing: 0.5px;
    }
    input[type="text"], input[type="file"], input[type="number"], textarea, select {
        width: 100%;
        padding: 10px 12px;
        margin-top: 0.3rem;
        border: 1px solid #d2b48c;
        border-radius: 6px;
        font-size: 1.05rem;
        background: #f9f5f0;
        box-sizing: border-box;
        transition: border 0.2s;
    }
    input[type="text"]:focus, textarea:focus, select:focus {
        border: 1.5px solid #f9c74f;
        outline: none;
    }
    textarea {
        min-height: 70px;
        resize: vertical;
    }
    button[type="submit"] {
        margin-top: 2rem;
        background: linear-gradient(90deg, #7b4f29 60%, #f9c74f 100%);
        color: #fff;
        border: none;
        padding: 12px 28px;
        border-radius: 6px;
        font-size: 1.15rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        box-shadow: 0 2px 8px rgba(123,79,41,0.08);
    }
    button[type="submit"]:hover {
        background: linear-gradient(90deg, #9b6937 60%, #f9c74f 100%);
        color: #3e3e3e;
    }
    a {
        display: block;
        text-align: center;
        margin-top: 1.8rem;
        color: #7b4f29;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.05rem;
        letter-spacing: 0.5px;
    }
    a:hover {
        text-decoration: underline;
        color: #9b6937;
    }
</style>
<h1>Ajouter une ressource minière</h1>
<form method="post" enctype="multipart/form-data">
    <label>Nom du site</label>
    <input type="text" name="nom_site" required>
    <label>Description</label>
    <textarea name="description"></textarea>
    <label>Type</label>
    <select name="id_type_ressource" required>
        <?php foreach ($types as $t): ?>
            <option value="<?= $t['id_type'] ?>"><?= htmlspecialchars($t['nom_type']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Statut</label>
    <select name="id_statut_ressource" required>
        <?php foreach ($statuts as $s): ?>
            <option value="<?= $s['id_statut'] ?>"><?= htmlspecialchars($s['nom_statut']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Latitude</label>
    <input type="text" name="latitude" required>
    <label>Longitude</label>
    <input type="text" name="longitude" required>
    <label>Lien</label>
    <input type="text" name="lien">
    <label>Image</label>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Enregistrer</button>
</form>
<a href="ressources">Retour à la liste</a>
