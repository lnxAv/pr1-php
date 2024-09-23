Produre de notre projet - Gestion des étudiants - PHP.

- Premiere étape - établir la partie Front-End, le forme sur HTML: 

Nous avons commencé par créer la structure de base de notre page HTML5, en veillant à inclure les balises essentielles et à configurer correctement les métadonnées pour assurer une bonne compatibilité et un affichage optimal sur différents appareils.
Pour garantir un design moderne et responsive, nous avons fait le choix d'intégrer Bootstrap via CDN. Cela nous permet de bénéficier d'un framework CSS robuste sans avoir à gérer les fichiers localement.
Nous avons structuré notre page en plusieurs sections distinctes :

Un en-tête avec le titre "Maquette, Un formulaire pour la gestion des étudiants
Une section pour afficher la liste des étudiants

Le formulaire de gestion comprend des champs pour l'email, le nom, le prénom et la date de naissance de l'étudiant. Nous avons également ajouté des boutons pour ajouter et modifier les informations, ainsi qu'une zone d'alerte pour les messages d'erreur ou de confirmation.
Pour la liste des étudiants, nous avons opté pour un tableau qui affiche clairement toutes les informations. Chaque ligne du tableau comporte des boutons "Modifier" et "Supprimer" pour permettre une gestion facile des données.
Afin de préparer l'intégration future avec le back-end, nous avons attribué des identifiants spécifiques à nos éléments HTML clés. Par exemple, le corps du tableau a l'id "etudiantsList", ce qui nous permettra de le manipuler dynamiquement avec JavaScript et PHP.
Nous avons inclus plusieurs fichiers JavaScript personnalisés (liveTable.js, app.js, controls.js, et des fichiers de routage) pour gérer les interactions côté client. Ces fichiers sont prêts à être implémentés pour assurer une expérience utilisateur fluide.
Pour la gestion des événements, nous avons utilisé l'attribut onclick sur nos boutons. Cela nous permettra de lier facilement les actions de l'utilisateur aux fonctions JavaScript correspondantes.












- Deuxieme étape - création de l'API: 

Après avoir mis en place le front-end de notre application de gestion des étudiants, nous avons procédé à la deuxième étape cruciale de notre projet : la création de l'API. Voici comment nous avons abordé cette partie :

Structure de l'API :
Nous avons créé un fichier PHP nommé "etudiant.php" qui sert de point d'entrée pour toutes les opérations liées aux étudiants. Ce fichier gère les requêtes HTTP et coordonne les interactions avec notre gestionnaire de fichiers d'étudiants.
Gestion des requêtes :
Nous avons implémenté un système qui traite les quatre types de requêtes HTTP principales :

GET : pour récupérer les informations des étudiants
POST : pour ajouter un nouvel étudiant
PUT : pour modifier les informations d'un étudiant existant
DELETE : pour supprimer un étudiant

Routage :
Nous avons mis en place un système de routage simple basé sur l'URI de la requête. Cela nous permet de diriger les requêtes vers les bonnes fonctions de traitement.
Traitement des données :
Pour chaque type de requête, nous avons implémenté une logique spécifique :

Pour GET, nous permettons de récupérer tous les étudiants ou de filtrer par email.
Pour POST, nous récupérons les données du corps de la requête pour créer un nouvel étudiant.
Pour PUT, nous utilisons l'email dans l'URI pour identifier l'étudiant à modifier.
Pour DELETE, nous utilisons également l'email dans l'URI pour identifier l'étudiant à supprimer.

Gestion des erreurs :
Nous avons mis en place un système de gestion des erreurs avec des blocs try-catch pour capturer et retourner les erreurs de manière appropriée.
Format de réponse :
Toutes nos réponses sont formatées en JSON pour une intégration facile avec le front-end. Nous utilisons un format cohérent avec des clés "res" pour les résultats et "error" pour les messages d'erreur.
Sécurité :
Nous avons veillé à valider les entrées et à utiliser des méthodes sécurisées pour traiter les données des utilisateurs.
Persistance des données :
Conformément aux exigences du projet, nous avons implémenté un système de stockage des données dans un fichier texte via notre classe GestionnaireDesFichiersEtudiants.

Cette API nous permet maintenant de réaliser toutes les opérations CRUD (Create, Read, Update, Delete) sur nos données d'étudiants, tout en respectant les principes d'une architecture RESTful.
La prochaine étape consistera à intégrer cette API avec notre interface utilisateur pour créer une application web complète et fonctionnelle.







- Troisieme étape - création et implementations de nos Javascript: 

Après avoir mis en place le front-end et l'API back-end de notre application de gestion des étudiants, nous avons procédé à la troisième étape cruciale de notre projet : la création des fichiers JavaScript pour gérer l'interaction côté client. Voici comment nous avons structuré et implémenté cette partie :

Organisation des fichiers :
Nous avons divisé notre code JavaScript en trois fichiers principaux pour une meilleure organisation et maintenance :

controls.js : gère les interactions avec l'API.
liveTable.js : s'occupe de la mise à jour dynamique du tableau des étudiants.
app.js : initialise l'application et gère les éléments globaux.

Mise à jour dynamique du tableau (liveTable.js) :

Nous avons créé une fonction updateTable() qui met à jour le contenu du tableau des étudiants de manière dynamique.
Nous avons implémenté un système d'événements personnalisé ('update-table') pour déclencher la mise à jour du tableau après chaque opération.

Initialisation et gestion globale (app.js) :

Nous avons centralisé la sélection des éléments du DOM pour une meilleure gestion.
Nous avons implémenté des fonctions pour gérer les alertes (showAlert() et hideAlert()).
Nous avons mis en place un système de routage simple basé sur les paramètres de l'URL pour gérer les différentes vues de l'application.

Gestion des erreurs :
Nous avons implémenté des blocs try-catch et des .catch() sur nos promesses pour gérer les erreurs potentielles lors des requêtes API.
Modularité et réutilisabilité :
Notre approche modulaire permet une séparation claire des responsabilités et facilite la maintenance et l'extension future de l'application.
Intégration avec le HTML :
Nous avons lié nos fonctions JavaScript aux éléments HTML via des attributs onclick et des écouteurs d'événements, assurant une interaction fluide entre l'interface utilisateur et la logique de l'application.

Cette structure JavaScript nous permet maintenant de créer une expérience utilisateur dynamique et réactive, en synchronisant efficacement l'interface utilisateur avec les données stockées via notre API.








- Derniere étape - création et des fichier PHP du fichier GestionnaireDesEtudiants: 

Pour la dernière étape de notre projet de gestion des étudiants, nous avons procédé à la création de nos fichiers PHP contenant nos classes abstraites et interfaces. Cette étape était cruciale pour établir une structure solide et flexible pour notre application. Voici comment nous avons organisé et implémenté cette partie :

Structure des fichiers :
Nous avons créé quatre fichiers PHP principaux :

Etudiant.php : définit la classe Etudiant
OperationsEtudiantes.php : contient l'interface OperationEtudiant
GestionnaireDesEtudiants.php : implémente la classe abstraite GestionnaireDesEtudiants
GestionnaireFichiersEtudiants.php : étend GestionnaireDesEtudiants pour la gestion spécifique des fichiers

Classe Etudiant (Etudiant.php) :

Nous avons créé une classe simple pour représenter un étudiant avec ses attributs (nom, prénom, date de naissance, email).
Cette classe sert de modèle de données pour notre application.

Interface OperationEtudiant (OperationsEtudiantes.php) :

Nous avons défini une interface qui déclare les méthodes CRUD essentielles : getStudents, setStudents, putStudents, et deleteStudents.
Cette interface assure que toutes les classes de gestion d'étudiants implémenteront ces méthodes cruciales.

Classe abstraite GestionnaireDesEtudiants (GestionnaireDesEtudiants.php) :

Cette classe abstraite implémente l'interface OperationEtudiant et fournit une base commune pour la gestion des étudiants.
Elle contient des méthodes protégées pour la manipulation de fichiers (open, close, read, push, replace, remove).
Nous avons inclus des méthodes abstraites toString et fromString pour permettre différentes implémentations de sérialisation.
La classe gère également la recherche et le filtrage des étudiants.

Classe GestionnaireDesFichiersEtudiants (GestionnaireFichiersEtudiants.php) :

Cette classe étend GestionnaireDesEtudiants et implémente les méthodes spécifiques pour la gestion des fichiers.
Elle définit les méthodes toString et fromString pour convertir les objets Etudiant en chaînes de caractères et vice versa.
Elle implémente les méthodes CRUD en utilisant les fonctionnalités héritées de la classe abstraite.

Gestion des erreurs :

Nous avons intégré des mécanismes de gestion des erreurs, notamment pour les cas d'emails dupliqués ou inexistants.

Flexibilité et extensibilité :

Notre architecture permet d'ajouter facilement de nouvelles méthodes de stockage (par exemple, une base de données) en étendant simplement la classe abstraite GestionnaireDesEtudiants.

Cette structure orientée objet nous offre plusieurs avantages :

Une séparation claire des responsabilités
Une facilité de maintenance et d'extension
Une réutilisabilité du code
Une cohérence dans l'implémentation des opérations CRUD

En combinant ces classes PHP avec notre front-end et notre API, nous avons créé une application complète et robuste pour la gestion des étudiants, respectant les principes de la programmation orientée objet et les bonnes pratiques de développement.
Nous sommes convaincus que cette architecture fournit une base solide pour d'éventuelles extensions futures du projet.