**Evolution du site Cooking**

L’entreprise Cooking depuis 8 ans maintenant possède un site qui doit évoluer car il ne respecte pas
les standards du web actuel. En effet, il n’est pas utilisable sur les mobiles ou tablettes et manque de
dynamisme.
Page d’accueil de l’ancien site à moderniser:
 
![ancien site](https://imgur.com/a/dtOfbEu)

Il vous est donc demandé de :

• Réaliser la maquette d’un nouveau site qui permettra de visualiser les différentes
modifications en terme de mise en page :

    ◦ mobile

    ◦ tablette

    ◦ PC


• de créer la page d’accueil en fonction de la maquette que vous aurez réalisé

• de créer les différentes pages du front-office dans le respect de votre maquette et en utilisant
la BDD fournie

    ◦ index.php
    ◦ recette-detail.php
    ◦ membre-detail.php

• La recherche sur le site devra être fonctionnelle afin de pouvoir retrouver une ou des recettes

• il est recommandé d’utiliser un framework css comme bootstrap (https://getbootstrap.com/)
ou foundation (https://foundation.zurb.com/)

• Afin de rendre également le site plus dynamique (ex : slider, affichage de recettes, ...) il est
conseillé d’utiliser du javascript.

Résultats à fournir :

    1. les maquettes du nouveau site
    2. les pages au format html (web statique adaptable)
    3. les pages au format php (web dynamique)

L’intégralité des fichiers sera disponible sur un dépôt git à communiquer avant votre présentation.
Vous devrez utiliser les images et les données actuelles fournies en accompagnement de ce
document.

- répertoire images : contient les éléments visuels du site.

- répertoire photos : contient les éléments graphiques du site liés aux données de la base.

- fichier AAA-site complet-cooking.sql : contient les données à importer dans votre serveur de BDD.

Notes de sécurité :

1. Il est interdit d’utiliser directement les superglobales $_POST et $_GET directement dans
les requêtes SQL.

2. Il est interdit de passer directement les valeurs de $_POST et $_GET à des variables PHP
Il ne faut jamais faire confiance aux données provenant d’un navigateur et chaque données arrivant
sur un serveur web doit être vérifiée avec par exemple l’utilisation des fonctions :

    • filter_input (http://php.net/manual/fr/function.filter-input.php)
    
    • filter_input_array (http://php.net/manual/fr/function.filter-input-array.php)

• votre site doit être mis en production sur un serveur apache

    ◦ soit en utilisant votre dépôt git

    ◦ soit en utilisant une méthode reposant sur un protocole sécurisé