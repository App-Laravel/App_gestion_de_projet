# Application de gestion de projets

## 1.	Techniques

### -	Front-end (interface user) : 

###    o	HTML + CSS (+ framework Bootstrap)

###    o	Javascript

###    o	Librairie SweetAlert2

### -	Back-end :

###    o	PHP + framework Laravel

### -	Base de données : MySQL. Le diagramme UML est joint dans le fichier .pdf.

### -	Maquettage : figma. Les maquettes sont jointes dans le fichier .pdf.

## 2.	Réalisation
- Un user peut lire les projets qu’il a créé ou participé.

- Il peut modifier ces projets. 

- Mais il ne peut supprimer que les projets qu’il a créé. Lors de la création d’un projet, le créateur peut inviter les participants (via email, le participant doit avoir un compte user).

- Dans un projet, on peut créer plusieurs tâches. 

- Chaque tâche peut être faite par un ou plusieurs participants invités/enregistré de ce projet.

### Code (laravel) organisation :

    a.	Module User : pages Inscription + Login (+ forgot password) et les validations des données. Le profil + fonction DELETE sont à faire.

    b.	Module Project : j’ai réalisé toutes les pages et les opérations CRUD des projets. 100% fini.

    c.	Module Tâche : à faire
