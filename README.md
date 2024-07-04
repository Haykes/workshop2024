# Workshop

Cette application est r un site web permettant de
présenter et vendre ses œuvres d'art. Le site inclura une galerie en ligne où les visiteurs
pourront découvrir les peintures et éventuellement les acheter. Dans ce cadre, nous devons
également développer un panel administrateur qui permettra à l'artiste de gérer ses
peintures et de générer des certificats d'authenticité pour chaque vente

## Fonctionnalités

- Offrir une interface utilisateur intuitive pour la gestion de l'inventaire de
peintures.
- Automatiser la génération de certificats d'authenticité pour chaque peinture
vendue.
- Assurer une gestion efficace et sécurisée des données.
- 
## Prérequis

- Docker
- Docker Compose
- PHP 8.0 +
- Composer

## Installation

1. Clonez le dépôt :

    ```bash
    git clone https://github.com/Haykes/workshop2024
    cd workshop2024
    ```

## Lancer l'application

1. Assurez-vous que Docker et Docker Compose sont installés sur votre machine.

2. Lancez les services Docker :

    ```bash
    docker-compose up -d
    ```

   Cette commande va construire les conteneurs Docker pour la base de donnée.

    ```bash
    composer install
    ```

    ```bash
    php bin/console doctrine:schema:update --force
    ```

    ```bash
    php bin/console doctrine:fixtures:load
    ```

    ```bash
    php -S localhost:8000 -t public
    ```

## Utilisation

1. Ouvrez votre navigateur et accédez à l'URL suivante pour le frontend :

    ```
    http://localhost:8000
    ```