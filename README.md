# Installation

Importer le projet dans votre github

En local Modifier la variable `DATABASE_URL` de votre fichier `.env`, nous conseillons de nommer votre base de donnée todoList

Lancer la commande
`composer install`
Lancer la commande
`yarn install ou npm install`

Créer la base de donnée
`php bin/console doctrine:database:create`

Récupérer la structure de la base de donnée
`php bin/console doctrine:migrations:migrate`

Récupérer les données
`php bin/console doctrine:fixtures:load`

Mettre en place votre virtualHost

Démarrer le server node, vérifier la ligne 11 du package.json
`yarn dev-server ou yarn build`
