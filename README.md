
# 📅 myAgenda

Bienvenue sur myAgenda - Votre agenda personnel en ligne ! 🚀

## Description
myAgenda est une application web développée en Symfony 6 qui vous permet de gérer vos contacts de manière simple et efficace. Ajoutez, supprimez, modifiez et consultez les détails de vos contacts en un clin d'œil !

## Fonctionnalités
- 📇 Ajoutez des contacts avec facilité
- ✏️ Modifiez un contact
- ❌ Supprimez des contacts dont vous n'avez plus besoin
- 🔍 Consultez les détails complets de chaque contact


## 🛠️ Prérequis

### 💻 Technologies
- Symfony 6.0
- Php 8.0
- WampServer

## 🧑‍💻 Installations

1. Se rendre dans le projet :

    ```bash
    cd myagenda
    ```
2. Créer la base de données :

    ```bash
    php bin/console doctrine:database:create
    ```
3. Réaliser la migration des données :

    ```bash
    php bin/console make:migration
    ```

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

## 🚀 Lancer le projet 

```bash
symfony serve
```

## Documentation

- [Symfony](https://symfony.com/)


## Authors

- [@armanceau](https://www.github.com/armanceau)
- [![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/arthur-manceau/)

