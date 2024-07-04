\# workshop2024

\## Prérequis

\- Docker - Docker Compose - PHP 8.0 ou supérieur - Composer

\## Démarrage

\### Cloner le dépôt

\`\`\`bash git clone \<rhttps://github.com/Haykes/workshop2024\> cd
\<workshop2024\>

Démarrez le conteneur Docker :

docker-compose up -d Installer les dépendances Exécutez la commande
suivante pour installer les dépendances PHP :

composer install

Mettre à jour le schéma de la base de données Exécutez la commande
suivante pour mettre à jour le schéma de la base de données :

php bin/console doctrine:schema:update --force

Charger les fixtures Exécutez la commande suivante pour charger les
fixtures dans la base de données :

php bin/console doctrine:fixtures:load

Démarrer le serveur Symfony Vous pouvez démarrer l'application Symfony
en utilisant le serveur PHP intégré :

bash Copier le code php -S localhost:8000 -t public
