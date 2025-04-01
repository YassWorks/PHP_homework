<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2 class="text-center mb-4">Gestion des Notes des étudiants</h2>

    <div class="d-flex flex-wrap gap-4 p-3 ">

        <?php
            require 'Etudiant.php';
            $etudiants = [
                new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
                new Etudiant("Skander", [15, 9, 8, 16]),
                
            ];
            
            foreach ($etudiants as $etudiant) {
                $etudiant->afficherEtudiant();
            }
            

        ?>
    </div>
</body>
</html>
