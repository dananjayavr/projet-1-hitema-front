**Evolution du site Cooking**
-----------------------------

L’entreprise Cooking depuis 8 ans maintenant possède un site qui doit évoluer car il ne respecte pas
les standards du web actuel. En effet, il n’est pas utilisable sur les mobiles ou tablettes et manque de
dynamisme.

Le page d’accueil de l’ancien site à moderniser:
 
![ancien site](https://i.imgur.com/ZQ6yW15.png)

Il vous est donc demandé de :

1. Réaliser la maquette d’un nouveau site qui permettra de visualiser les différentes
modifications en terme de mise en page :
    + mobile
    + tablette
    + PC
2. de créer la page d’accueil en fonction de la maquette que vous aurez réalisé
3. de créer les différentes pages du front-office dans le respect de votre maquette et en utilisant
la BDD fournie

        ◦ index.php
        ◦ recette-detail.php
        ◦ membre-detail.php


• La recherche sur le site devra être fonctionnelle afin de pouvoir retrouver une ou des recettes

• Il est recommandé d’utiliser un framework css comme bootstrap (https://getbootstrap.com/)
ou foundation (https://foundation.zurb.com/)

• Afin de rendre également le site plus dynamique (ex : slider, affichage de recettes, ...) il est
conseillé d’utiliser du javascript.

**Résultats à fournir :**

   1. les maquettes du nouveau site
   2. les pages au format html (web statique adaptable)
   3. les pages au format php (web dynamique)

L’intégralité des fichiers sera disponible sur un dépôt git à communiquer avant votre présentation.
Vous devrez utiliser les images et les données actuelles fournies en accompagnement de ce
document.

   - répertoire images : contient les éléments visuels du site.

   - répertoire photos : contient les éléments graphiques du site liés aux données de la base.

   - fichier AAA-site complet-cooking.sql : contient les données à importer dans votre serveur de BDD.

**Notes de sécurité :**

1. Il est interdit d’utiliser directement les superglobales $_POST et $_GET directement dans
les requêtes SQL.

2. Il est interdit de passer directement les valeurs de $_POST et $_GET à des variables PHP
Il ne faut jamais faire confiance aux données provenant d’un navigateur et chaque données arrivant
sur un serveur web doit être vérifiée avec par exemple l’utilisation des fonctions :

        • filter_input (http://php.net/manual/fr/function.filter-input.php)
    
        • filter_input_array (http://php.net/manual/fr/function.filter-input-array.php)

• votre site doit être mis en production sur un serveur apache;

  - soit en utilisant votre dépôt git

   - soit en utilisant une méthode reposant sur un protocole sécurisé
   
 Phase 2
-----------

BRAVO ! Cooking a validé votre nouveau design et la maquette du site que vous avez présenté.
Maintenant il faut avancer vite car la date de mise en production approche et il faut que Cooking puisse gérer les recettes et ses membres.
   
   **Il vous est donc demandé de** :
   - Réalisez le back-office de la page recette (insertion, mise à jour, effacement)
   avec upload d’image.
   - Protégez l'accès du back-office par un login et mot de passe en utilisant password_hash dans la table membre.
   - L’inscription d’un membre est possible depuis le site et un membre doit pouvoir modifier son profil (informations, photo, …), supprimer son compte et dans un contexte RGPD un membre doit pouvoir exporter les données le concernant (traces
   si existantes, recettes, …) une piste pour cela est l’export de données dans un fichier CSV.
   - le back-office permet aux administrateur de gérer les membres (blocage, modification,
   suppression, …)
   - le back-office permet aux administrateus de gérer les recettes (vues, modification,
   suppression, modération, etc ...)
   - l’utilisation de requêtes ajax est un plus pour la gestion du back-office
   - il est possible de modifier la structure de la BDD afin de prendre en compte les nouvelles fonctionnalités du back-office.
   - Il faut également penser à effectuer la mise à jour des anciens mots de passe en utilisant la nouvelle méthode de cryptographie.
   
   **Résultats à fournir** :
   
   1. les maquettes du nouveau site
   2. les pages au format html (web statique adaptable)
   3. les pages au format php (web dynamique)
   