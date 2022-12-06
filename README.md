# my_project

Projet symfony: 'Séries', Matthieu SIEGEL & Jérémy ROBERT

- 4 contraintes différentes
- ORM pour la création de tables
- 2 Triggers
- 1 procédure stockée

Le fichier ```sql.sql``` contient le script sql pour la création des triggers et de la procédure

## Tables

| Serie  | episode  | plafrome | saison |
| :--------------- |:---------------:| -----:|-----:|
| id  |   id        |  id | id |
| nom  |   nom        |  nom | numéro |
| #plafrome_id  | numéro            |   url | #serie_id | 
|   | note         |     | |
|   | #saison_id         |     | |
