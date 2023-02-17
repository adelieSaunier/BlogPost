# Blog PHP

## Pour faire fonctionner le projet, vous devez :
        - Avoir installé composer
        - Cloner le code 
        - Éxecuter la commande composer install
        - Éxecuter la commande composer dump-autoload
        - Créer une base de données avec le nom : blog_database, ou changer le nom dans database/DB.php à la ligne 'database' => 'blog_database'
        - Éxecuter la commande php create-table.php pour créer les différentes tables du projet
        - Créer un utlisateur sur la page register
        - Pour avoir un admin, vous pouvez changer le role de votre utilisateur à 1
        - Une fois connecté, l'administrateur peut voir tous ces articles sur une page admin et rédiger, éditer, supprimer des articles (nouveaux onglets dans la navigation)
        - Créer un profil utilisateur pour créer un commentaire sur un article créer
        - Aller sur la page d'administration des commentaires, vous pourrez valider ou supprimer le commentaire
        - Une fois validé, le commentaire apparaitra sous l'article concerné

## À noter : Utilisation du query builder de Laravel : Eloquent

Ce blog a été développé dans le cadre de la formation Openclassroom.

## En tant qu'administrateur on doit pouvoir : 
        - créer/modifier/supprimer des articles 
        - modérer des commentaires

## En tant qu'utilisateur non authentifié, on doit pouvoir :
        - lire les articles 
        - lire les commentaires

## En tant qu'utilisateur authentifié, on doit pouvoir : 
        - laisser un commentaire
        - recevoir une alerte sur son commentaire