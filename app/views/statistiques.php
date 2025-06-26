<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques Ressources Minières</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #8B4513 0%, #A0522D 25%, #CD853F  50%, #D2B48C 100%);
            min-height: 100vh;
            color: #2C1810;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            background: rgba(139, 69, 19, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px 0;
            margin-bottom: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border-bottom: 3px solid #A0522D;
        }

        .header h1 {
            color: #F5DEB3;
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .header .subtitle {
            color: #DEB887;
            font-size: 1.2rem;
            text-align: center;
            margin-top: 10px;
            font-weight: 300;
        }

        .chart-section {
            background: rgba(245, 222, 179, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 12px 40px rgba(139, 69, 19, 0.15);
            border: 1px solid rgba(160, 82, 45, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .chart-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 50px rgba(139, 69, 19, 0.25);
        }

        .chart-section h2 {
            color:rgb(255, 255, 255);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .chart-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #A0522D, #CD853F);
            border-radius: 2px;
        }

        .chart-container {
            position: relative;
            height: 400px;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            box-shadow: inset 0 2px 8px rgba(139, 69, 19, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(222, 184, 135, 0.9);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(139, 69, 19, 0.15);
            border: 1px solid rgba(160, 82, 45, 0.2);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(139, 69, 19, 0.25);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #8B4513;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #654321;
            font-weight: 500;
        }

        .footer {
            background: rgba(139, 69, 19, 0.95);
            color: #F5DEB3;
            text-align: center;
            padding: 30px 0;
            margin-top: 60px;
            border-top: 3px solid #A0522D;
        }

        .loading {
            display: none;
            text-align: center;
            padding: 40px;
            color: #8B4513;
            font-size: 1.2rem;
        }

        .spinner {
            border: 4px solid rgba(139, 69, 19, 0.3);
            border-top: 4px solid #8B4513;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2.2rem;
            }
            
            .chart-section {
                padding: 25px;
                margin-bottom: 25px;
            }
            
            .chart-container {
                height: 300px;
                padding: 15px;
            }
            
            .stat-card {
                padding: 20px;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }

        /* Couleurs personnalisées pour les graphiques */
        .chart-colors {
            --primary: #8B4513;
            --secondary: #A0522D;
            --accent: #CD853F;
            --light: #DEB887;
            --lighter: #F5DEB3;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container">
            <h1>Statistiques des Ressources Minières</h1>
            <p class="subtitle">Analyse complète des données d'exploitation minière</p>
        </div>
    </div>

    <div class="container">
        <!-- Section statistiques rapides -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" id="totalSites">--</div>
                <div class="stat-label">Sites Totaux</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalRegions">--</div>
                <div class="stat-label">Régions</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalTypes">--</div>
                <div class="stat-label">Types de Ressources</div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="chart-section">
            <h2> Sites par Région</h2>
            <div class="loading" id="loading1">
                <div class="spinner"></div>
                Chargement des données...
            </div>
            <div class="chart-container">
                <canvas id="regionTypeChart"></canvas>
            </div>
        </div>

        <div class="chart-section">
            <h2> Répartition des Types de Ressources</h2>
            <div class="loading" id="loading2">
                <div class="spinner"></div>
                Chargement des données...
            </div>
            <div class="chart-container">
                <canvas id="typeChart"></canvas>
            </div>
        </div>

        <div class="chart-section">
            <h2> Répartition des Statuts</h2>
            <div class="loading" id="loading3">
                <div class="spinner"></div>
                Chargement des données...
            </div>
            <div class="chart-container">
                <canvas id="statutChart"></canvas>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <p>&copy; 2025 Système de Gestion des Ressources Minières</p>
        </div>
    </div>

    <script>
        // Palette de couleurs dans les tons marron
        const brownPalette = [
            '#8B4513', '#A0522D', '#CD853F', '#DEB887', '#F5DEB3',
            '#D2691E', '#BC8F8F', '#F4A460', '#DAA520', '#B8860B',
            '#9ACD32', '#8FBC8F', '#20B2AA', '#4682B4', '#9370DB'
        ];

        // Intégration des données PHP
        const rawRegionType = <?= json_encode($regionType) ?>;
        const typeData = <?= json_encode($typeRessource) ?>;
        const statutData = <?= json_encode($statutRessource) ?>;

        // Fonction pour afficher les statistiques rapides
        function displayQuickStats() {
            const totalSites = rawRegionType.reduce((sum, item) => sum + parseInt(item.nombre_sites), 0);
            const totalRegions = [...new Set(rawRegionType.map(item => item.nom_region))].length;
            const totalTypes = typeData.length;

            document.getElementById('totalSites').textContent = totalSites;
            document.getElementById('totalRegions').textContent = totalRegions;
            document.getElementById('totalTypes').textContent = totalTypes;
        }

        // 1. Graphique en barres par région
        function createRegionChart() {
            // Extraire la liste unique de régions
            const regions = [...new Set(rawRegionType.map(item => item.nom_region))];

            // Additionner les sites par région
            const regionCounts = regions.map(region => {
                return rawRegionType
                    .filter(item => item.nom_region === region)
                    .reduce((sum, item) => sum + parseInt(item.nombre_sites), 0);
            });

            new Chart(document.getElementById('regionTypeChart'), {
                type: 'bar',
                data: {
                    labels: regions,
                    datasets: [{
                        label: 'Nombre de sites par région',
                        data: regionCounts,
                        backgroundColor: brownPalette.slice(0, regions.length),
                        borderColor: brownPalette.slice(0, regions.length).map(color => color + 'CC'),
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(139, 69, 19, 0.9)',
                            titleColor: '#F5DEB3',
                            bodyColor: '#F5DEB3',
                            borderColor: '#A0522D',
                            borderWidth: 1,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(139, 69, 19, 0.1)'
                            },
                            ticks: {
                                color: '#8B4513',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#8B4513',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        }
                    }
                }
            });
        }

        // 2. Graphique en camembert des types
        function createTypeChart() {
            const typeLabels = typeData.map(t => t.type_ressource);
            const typeValues = typeData.map(t => parseInt(t.nombre_sites));

            new Chart(document.getElementById('typeChart'), {
                type: 'pie',
                data: {
                    labels: typeLabels,
                    datasets: [{
                        data: typeValues,
                        backgroundColor: brownPalette.slice(0, typeLabels.length),
                        borderColor: '#FFFFFF',
                        borderWidth: 3,
                        hoverBorderWidth: 5,
                        hoverBorderColor: '#8B4513'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#8B4513',
                                font: {
                                    size: 13,
                                    weight: '500'
                                },
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(139, 69, 19, 0.9)',
                            titleColor: '#F5DEB3',
                            bodyColor: '#F5DEB3',
                            borderColor: '#A0522D',
                            borderWidth: 1,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }

        // 3. Graphique en anneau des statuts
        function createStatutChart() {
            const statutLabels = statutData.map(s => s.statut);
            const statutValues = statutData.map(s => parseInt(s.nombre_sites));

            new Chart(document.getElementById('statutChart'), {
                type: 'doughnut',
                data: {
                    labels: statutLabels,
                    datasets: [{
                        data: statutValues,
                        backgroundColor: brownPalette.slice(0, statutLabels.length),
                        borderColor: '#FFFFFF',
                        borderWidth: 4,
                        hoverBorderWidth: 6,
                        hoverBorderColor: '#8B4513',
                        cutout: '60%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#8B4513',
                                font: {
                                    size: 13,
                                    weight: '500'
                                },
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(139, 69, 19, 0.9)',
                            titleColor: '#F5DEB3',
                            bodyColor: '#F5DEB3',
                            borderColor: '#A0522D',
                            borderWidth: 1,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            displayQuickStats();
            
            // Chargement des graphiques
            setTimeout(() => {
                createRegionChart();
                document.getElementById('loading1').style.display = 'none';
            }, 500);
            
            setTimeout(() => {
                createTypeChart();
                document.getElementById('loading2').style.display = 'none';
            }, 1000);
            
            setTimeout(() => {
                createStatutChart();
                document.getElementById('loading3').style.display = 'none';
            }, 1500);
        });
    </script>

</body>

</html>