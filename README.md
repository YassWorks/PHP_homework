# TP PHP

Travail par:
- Aymen ABID
- Mohamed Yassine KALLEL

Quelques notes:
- Veuillez créer la base de données "managementDB" en local avant de lancer l’exercice de PDO.
- La connexion à la base se fait sur localhost:3306.
- Les chemins des fichiers supposent que le serveur est démarré depuis le dossier de chaque exercice :
```bash
cd NomExercice # exemple cd PDO
php -S localhost:8000
```
- Pour tester la plateforme du Student Management System, vous devrez d’abord ajouter manuellement des données fictives dans les tables.
Un script est déjà disponible pour vous faciliter la tâche à l’adresse : localhost:8000/Database/manageDB.php.
Veuillez noter que cette page ne doit être consultée qu’une seule fois, afin d’éviter l’ajout en double des utilisateurs dans la base.
- Enfin, le port ainsi que le nom de la base de données peuvent être modifiés dans le fichier Classes/ConnectionDB.php, si nécessaire.
