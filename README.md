## À propos de Petit Prono

Petit Prono est un outil qui permet de jouer à faire des pronos sur l'Euro 2024 de football.<br><br>
L'idée vient de "Mon Petit Gazon" (props to them) qui avait lancé une appli du même genre pour l'Euro 2020 mais, entre temps, celle-ci est devenue une usine à gaz et a perdu de sa simplicité/convivialité (AMHA).<br><br>
J'ai donc recréé une sorte de "Mon Petit Prono" tel qu'il était (à peu près) à l'époque, histoire d'y rejouer avec des collègues.<br>

## Prérequis

Les équipes/matches/résultats sont issus et actualisés à partir des API de **[Football Data](https://www.football-data.org/)**, une clé API est donc fortement conseillée pour faire fonctionner l'appli (le plan gratuit est suffisant).<br><br>
L'application est basée sur le framework PHP Laravel (v10), une base de donnée relationnelle est nécessaire pour la faire fonctionner (testé avec PHP v8.2, MySQL/MariaDB et PostgreSQL).

## Fonctionnement

### Jeu de base
Chaque joueur peut pronostiquer le résultat d'un match et choisir de jouer un de ses boosters sur ce match. <br>
Il ne peut le faire qu'avant le début du match (une tentative de création/modification de prono après le début du match associé entraine une pénalité pour tentatvie de tricherie).<br><br>
Si son prono est bon, il gagne des points en fonction du résultat du match (il recevra plus de points pour un score exact), sinon il ne gagne pas de points.<br><br>
S'il a joué un booster, son score pour le match est multiplié par le multiplicateur.

### Ligues
Par défaut, chaque joueur fait partie du "classement général" qui regroupe tous les joueurs inscrits.<br><br>
Un joueur peut créer des ligues qui vont regrouper les joueurs qui les rejoignent. Le score d'un joueur dans une ligue est le même que dans le classement général, seuls les "adversaires" sont limités aux participants de la ligue.<br><br>
Du fait que n'importe qui peut rejoindre n'importe quelle ligue, le joueur qui a créé la ligue a la possibilité d'en exclure des membres.<br>
Il a également la possibilité de supprimer la ligue.

### Actualisations
Il existe 2 routes permettant de mettre à jour l'appli depuis Football Data (sous réserve d'avoir fourni une clé API dans la variable d'environnement **API_KEY**) :
- ***update-teams*** : pour actualiser les équipes et leur classement en poule
- ***update-matches*** : pour actualiser les matches et leur résultat, ainsi qu'attribuer les points aux joueurs suite à leurs pronos

Ces routes étant accessibles sans authentification, pour éviter les crawls intempestifs il est nécessaire d'y ajouter un paramètre d'url nommé "*token*" avec la valeur de la variable d'environnement **UPDATE_TOKEN**.

## Personnalisation

Les paramètres suivants sont personnalisables : 
- Fuseau horaire des matches (variable d'environnement **APP_TIMEZONE**), par défaut Europe/Paris
- Nombre de points gagnés par les joueurs
    - pour un score exact (variable d'environnement **EXACT_SCORE_POINTS**), par défaut 30
    - pour un prono gagné (variable d'environnement **WINNING_PRONO_POINTS**), par défaut 10
    - pour le vainqueur final (variable d'environnement **WINNER_PRONO_POINTS**), par défaut 50
    - pour le multiplicateur des boosters (variable d'environnement **BOOSTER_MULTIPLIER**), par défaut 2
    - pour une tentative de tricherie (points perdus pour le coup) (variable d'environnement **CHEATING_POINTS_TO_REMOVE**), par défaut 15
- Nombre de boosters disponibles par joueur (variable d'environnement **INITIAL_BOOSTER_QUANTITY**), par défaut 3

## Licence

PetitProno est open-source et est concédé sous licence selon les termes de la [licence MIT](https://opensource.org/licenses/MIT).<br>
En plus de pouvoir l'utiliser, copier, partager, modifier etc, reçois des gros bisous si tu as lu jusqu'ici (et si tu es d'accord).
