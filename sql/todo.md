# Fonctionnalités du Système d'Information Géographique (SIG) - Ressources Minières à Madagascar

## 🎯 Objectif
Créer une application SIG interactive permettant de visualiser, filtrer, rechercher et obtenir des détails sur les ressources minières à Madagascar via une carte dynamique.

---

## ✅ Fonctionnalités principales

### 1. 🔍 Filtres 
L'utilisateur peut filtrer les données selon :
- **Région** : Affiche uniquement les ressources situées dans une région sélectionnée.
- **Type de ressource** : Or, Nickel, Bauxite, etc.
- **Statut d'exploitation** : En prospection, En exploitation, Épuisée, etc.

---

### 2. 🧠 Recherche intelligente
- Barre de recherche textuelle permettant de trouver des ressources selon des mots-clés.
- Exemple d'utilisation :
  - Recherche par nom de la ressource : `Ambatovy`
  - Recherche par site ou nom du projet : `Toliara Sands`

---

### 3. 🗺️ Carte interactive avec pop-up 
- **Affichage des ressources sur carte** avec des marqueurs par type/statut.
- **Popup de détails** lorsqu'on clique sur un point/zone :
  - Nom du site
  - Type de ressource
  - Statut
  - Région
  - Coordonnées GPS
  - Description / Infos complémentaires

---

### 4. 🖨️ Affichage & Impression de la carte
- Possibilité d'afficher la carte en plein écran.
- Bouton pour **imprimer la carte** ou exporter en PDF avec les filtres appliqués.

---

## 💡 Suggestions complémentaires
- Intégration de **légendes dynamiques** selon les types de ressources.
- Couleurs différentes pour chaque statut (ex: vert = exploitation, rouge = épuisée).
- Export des résultats filtrés en **CSV ou Excel**.

---

## 🛠️ Technologies proposées
- **Frontend** : HTML, JavaScript (Leaflet.js ou OpenLayers), Bootstrap
- **Backend** : PHP (Flight, Laravel...)
- **Base de données** : PostgreSQL avec extension PostGIS

---

## 📌 Remarques
- Toutes les actions (filtrage, recherche, impression) doivent être réactives et se faire sans rechargement de page (AJAX recommandé).
- La carte doit être responsive (fonctionnelle sur mobile et desktop).

