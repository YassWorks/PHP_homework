# TP PHP – Student Management System

### Réalisé par :
- **Aymen ABID**  
- **Mohamed Yassine KALLEL**

---

## 📌 Prérequis

- Créez la base de données **`managementDB`** en local avant de lancer les exercices liés à PDO.
- Assurez-vous que le serveur MySQL est accessible sur **`localhost:3306`**.
- Le serveur PHP doit être lancé depuis le dossier racine de chaque exercice. Exemple :

```bash
cd NomExercice  # Exemple : cd PDO
php -S localhost:8000
```

---

## 🧪 Données de test

Avant de pouvoir tester la plateforme du **Student Management System**, vous devez remplir la base de données avec des données fictives.

Un script est déjà prêt pour cela :  
👉 [localhost:8000/Database/manageDB.php](http://localhost:8000/Database/manageDB.php)

> ⚠️ **Important** : Ce script ne doit être exécuté **qu’une seule fois**, afin d’éviter l’insertion multiple des mêmes utilisateurs dans la base de données.

---

## ⚙️ Configuration

Si besoin, vous pouvez modifier :
- le **port de connexion** à la base de données
- le **nom de la base**

Ces paramètres se trouvent dans le fichier suivant :  
`Classes/ConnectionDB.php`
