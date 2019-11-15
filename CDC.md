# Cahier des charges


## Contexte

Le BDE (Bureau des Etudiants) d'une école d'ingénieur communique les évènements et actualités de leur formation par envoi d'e-mails. Ces e-mails sont envoyés sur l'adresse mail étudiante des étudiants. Ces mails sont donc souvent noyés parmi d'autres notifications, et le BDE doit souvent faire du cas par cas pour obtenir des réponses.

Chaque année le nombre d'étudiants augmente et l'association a aujourd'hui besoin d'une application web pour simplifier la publication de ses évènements et actualités.


## Problématiques

7 personnes s'occupent à la fois de la communication des évènements, de la préparation de ceux-ci et de la promotion de la formation. Avec le nombre croissant d'étudiants dans la formation, la préparation des évènements prend beaucoup plus de temps et d'énergie à cette petite équipe.

Les problématiques rencontrées sont :
* Comment gérer plus simplement la publications d'évènements et actualités ?
* Comment être plus efficace lors de la relance d'étudiants ?
* Comment gagner du temps sur la préparation des évènements ?


## Besoins

Les besoins qui en découlent sont les suivants :
* Pour les administrateurs, savoir qui a répondu aux évènements.
* Pour les administrateurs, publier les actualités et évènements.
* Pour les étudiants, voir les actualités et évènements.
* Pour les étudiants, répondre aux évènements.


## Solutions fonctionnelles

D'un point de vue fonctionnel, ces besoins sont traduits par :
* Avoir un espace de connexion pour les étudiants et administrateurs du site.
* Une interface visiteur qui permet aux étudiants à la fois de visionner les actualités et évènements, et à la fois de répondre à ceux-ci.
* Une interface d'administration qui permet de publier les évènements et les actualités.
* Une interface d'administration qui permet de savoir qui a répondu aux évènements, et donc d'avoir accès aux réponses.


## Solutions techniques

Les étudiants qui vont travailler sur cette solution vont utiliser leur expérience dans l'utilisation du framework PHP [Symfony](https://symfony.com/) et de l'environnement suivant :
* HTML5 / CSS3 / JavaScript
* [jQuery](https://jquery.com/) : Framework JavaScript
* [Twig](https://twig.symfony.com/doc/2.x/) : Moteur de template traditionnel de Symfony
* [Bootstrap](https://getbootstrap.com/) : Framework CSS et JavaScript permettant de créer plus facilement des interfaces web responsives et mobile-first
* [Composer](https://getcomposer.org/) : Gestionnaire de dépendances pour PHP
* [PostgreSQL](https://www.postgresql.org/) : SGBD pour le stockage et la manipulation
* [Git](https://git-scm.com/) : Gestionnaire de versions
* [Docker](https://www.docker.com/) : Gestionnaire de conteneurs

Cet environnement permet d'assurer aux développeurs un développement plus rapide de la solution, mais également une maintenance et une évolutivité plus aisées.


## Livrables

Les développeurs livreront les éléments suivants :
* Les documents permettant la bonne compréhension de la base de données (MEA, dictionnaire des données, matrice des dépendances fonctionnelles, liste des contraintes, MLD, MCD)
* Le cahier des charges qui permettra aux utilisateurs de comprendre le fonctionnement global de la solution.
* La documentation qui permettra aux développeurs qui seront amenés à travailler sur la solution de comprendre le fonctionnement du code et les choix techniques.

De manière générale les normes de développement des technologies utilisées et de conception de la base de données seront respectées.