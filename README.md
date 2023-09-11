# Application de gestion de projets

## 1.	Techniques

### 1.1.    Front-end (interface user) : 

###    o	HTML + CSS (+ framework Bootstrap)

###    o	Javascript

###    o	Librairie SweetAlert2

### 1.2.    Back-end :

###    o	PHP + framework Laravel

### 1.3.    Base de données : MySQL. Le diagramme UML est joint dans le fichier .pdf.

### 1.4.    Maquettage : figma. Les maquettes sont jointes dans le fichier .pdf.

## 2.	Réalisation
- Un user peut lire les projets qu’il a créé ou participé.

- Mais il ne peut modifier ou supprimer que les projets qu’il a créé. Lors de la création d’un projet, le créateur peut inviter les participants (via email, le participant doit avoir un compte user).

- Dans un projet, on peut créer plusieurs tâches. 

- Chaque tâche peut être faite par un ou plusieurs participants invités/enregistré de ce projet.

### 2.1.     Code (laravel) organisation :

    a.	Module User : pages Inscription + Login (+ forgot password et envoyer les emails) et les validations des données input + la page profil (modifier le profil + ajouter les photos par FileManager).

    b.	Module Project : toutes les pages  + les opérations CRUD des projets.

    c.	Module Tâche : toutes les pages  + les opérations CRUD des tâches.

### 2.2.    Démonstration :

![UML_database](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/5a6c2157-74d1-4f44-a11d-fe8c30d6cf01)

![login](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/72f99a92-39d2-447b-8d14-aeae44639e56)

![signup](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/47d459ce-f23f-427c-83a6-4715896e3fd1)

![VerifyEmail](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/7982d06c-52c7-4556-9fc0-d4320752587c)

![forgotpassword](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/d2ca598d-bff5-48e5-b641-e8ef353fa001)

![resetpasswordEmail](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/42db223c-580c-4f58-b917-f992201f2f44)

![userHomepage](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/b04b85bb-4d80-4786-9308-d427e8fa79c8)

![projects](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/d273fa8b-6e98-43d7-9cf7-f46b20488599)

![projectDetail](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/3e25af4b-1375-4969-8e0f-4de96555197b)

![addModifyProject](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/a2fc5067-bb76-4450-92c8-3c88fc2b1391)

![inviteEmail](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/6947929b-c757-497b-bbe9-2b403b58077d)

![deleteProject](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/1e9a62ca-da31-4aa3-8c86-4c0b8fd3451a)

![tasks](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/afef8236-f030-4136-8f29-78063ca72b11)

![addModifyTask](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/2c67f9c2-8d21-45bd-9914-7aa7fe7c283c)

![profil](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/6c0c5265-2e25-4858-a043-40fb86ae6d62)

![changePasswordErrors](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/4a19a30a-c044-4084-9ecb-a10c55e6acad)

![ModifyProfil](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/a9eed83e-7c31-479e-850c-0a6d0b355d12)

![addAvatar](https://github.com/Project-Task-Management-App/project_manage_app/assets/107623849/a94a270c-a42d-4b15-a9f9-0ecb049e778e)





