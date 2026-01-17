URL: localhost

Gebruikersgegvens:
Hoofdaccount: colin.bloemendaal@gmail.com - password123

Alle andere accounts (Vindbaar in het admin portaal onder leden):
- email lid - password123

Instructies starten applicaties.
1. clone the repository van: https://github.com/ColinBloemendaal-Inholland/WebDevelopment1-ColinBloemendaal-Alvoco.git
2. navigeer naar de repository
3. Run "docker compuse up --build" in de root van de repository
4. navigeer nu naar /app
5. Run "docker exec -it webdevelopment1-colinbloemendaal-alvoco-php-1 bash"
5. Run "composer install
6. ga naar localhost:8080
7. log in met developer - secret123
8. import the database vanuit the repository genaamd project.sql
9. Het project is klaar om gebruik van te maken.


MVC (higher level patterns):
-   Er is gebruik gemaakt van een automatische view mapper die ik zelf heb geschreven.
    Deze mapper bestaat uit View (app/src/models/view/View.php) en een global helper View (app/src/helpers/View.php)

Routes zijn geregistreerd in app/src/routes/web.php


WCAG:
-   Gebruik gemaakt van Aria-controls, aria-expanded, aria-label en nog meer door het hele project heen in alle views
-   Gebruik gemaakt van html label tag
-   alerts (popup modals) maken gebruik van de role attribute in ForceDeleteModal en DeleteModal
-   gebruik gemaakt van de alt tag bij afbeelding in app/src/views/admin/teams/post.php en app/src/views/teams/post.php
-   Gebruik gemaakt van de TinyMCE WYSIWYG editor waardoor nieuwsberichten duidelijke leesbare teksten kunnen hebben.
    Dit is te zien in app/src/views/dashboard/home.php, app/src/views/dashboard/index.php, app/src/views/nieuwsberichten/index.php, app/src/views/nieuwsberichten/post.php

GDPR / AVG:
-   Gebruik gemaakt van softdeletes in alle modellen. Je kan hier op filteren in het admin paneel bij de modellen.
    Hierdoor worden alleen soft deleted entiteiten laten zien. Hier nog de optie om ze permanent te verwijderen.
-   Voor de Leden een extra view aangemaakt in het admin paneel waar alle leden op een rijtje staan die langer dan 3
    3 maanden zijn gesoftdelete
-   Voor een lid het mogelijk gemaakt om zijn/haar eigen account te kunnen verwijderen.