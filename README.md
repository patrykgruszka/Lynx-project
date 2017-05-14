# Lynx #

## Wymagania ##
1. Serwer WWW z PHP w wersji 5.6 i bazą danych MySQL
2. Composer - Menadżer zależności dla PHP.
3. Node.js - Środowisko programistyczne dla skalowalnych aplikacji internetowych.
4. Grunt - JavaScript'owy system automatyzacji pracy.

## Instalacja wymagań ##

### Serwer WWW ###
Można korzystać z dowolnego serwera WWW, który posiada PHP w wersji 5.6 i serwer baz danych MySQL. 
W przykładach będziemy korzystali z serwera [XAMPP](https://www.apachefriends.org/pl/index.html) - należy pobrać wersję z PHP 5.6 i zainstalować w systemie.

### Composer ###
#### Instalacja globalna w systemie ####
Jedną z opcji jest zainstalowanie composera globalnie w systemie operacyjnym, w tym celu należy pobrać i zainstalować odpowiedni plik ze strony internetowej [Composera](https://getcomposer.org/)

### Node.js ###
Środowisko programistyczne node.js należy pobrać ze [strony internetowej](https://nodejs.org/) i zainstalować w systemie operacyjnym.

### Grunt ###
Grunt jest instalowany globalnie za pomocą wiersza poleceń. Więcej informacji na stronie internetowej [Grunta](http://gruntjs.com/) 

`npm install -g grunt-cli`

## Instalacja projektu ##

### Konfiguracja vhostów (na przykładzie serwera XAMPP) ###
Konfiguracja vhostów serwera XAMPP znajduje się w katalogu serwera, np. 
`C:\xampp\apache\conf\extra\httpd-vhosts.conf`

Do pliku należy dodać wpis vhost dla przykładowej domeny lynx.dev oraz lynx.prod dla katalogu w którym znajduje się projekt
```

<VirtualHost *:80>
    DocumentRoot "SCIEZKA/DO/PROJEKTU/web"
    ServerName lynx.dev
    ErrorLog "logs/lynx.dev-error.log"
    CustomLog "logs/lynx.dev-access.log" common
    DirectoryIndex "app_dev.php"
    <Directory "SCIEZKA/DO/PROJEKTU">
        AllowOverride All
        Order allow,deny
        Allow from all

        Require all granted
    </Directory>
</VirtualHost>


<VirtualHost *:80>
    DocumentRoot "SCIEZKA/DO/PROJEKTU/web"
    ServerName lynx.prod
    ErrorLog "logs/lynx.prod-error.log"
    CustomLog "logs/lynx.prod-access.log" common
    DirectoryIndex "app.php"
    <Directory "SCIEZKA/DO/PROJEKTU>
        AllowOverride All
        Order allow,deny
        Allow from all

        Require all granted
    </Directory>
</VirtualHost>
```

Przy wykorzystaniu vhosta należy pamietać o przekierowaniu domen na adres lokalny w pliku hosts. W systemach Windows znajduje się on w folderze:

```
#C:\Windows\System32\drivers\etc\hosts
127.0.0.1       lynx.dev
127.0.0.1       lynx.prod
```

### Utworzenie bazy danych ###
Należy utworzyć bazę danych dla projektu lynx. Dla serwera XAMPP jest dostępny panel phpMyAdmin.

### Instalacja bazy danych oraz wymaganych bibliotek przed pierwszym uruchomieniem ###
* `composer install` - Jeśli composer został zainstalowany globalnie
* W czasie instalacji zostanie wygenerowany także plik konfiguracyjny na podstawie podanych informacji.
* Po udanej instalacji należy wykonać następującą komendę aby utworzyć tablice na podstawie wstępnych encji: `php app/console doctrine:database:create`

### Instalacja zależności projektu Node.js ###
Aby zainstalować zależności projektu Node.js w głównym katalogu projektu należy wykonać polecenie:
`npm install`

W katalogu projektu zostanie utworzony folder 'node_modules' zawierający określone paczki npm wykorzystywane w projekcie.

### Budowanie projektu za pomocą Grunt'a ###
Aby zbudować odpowiednie pliki końcowe (np. CSS i JavaScript) należy w głównym katalogu projektu uruchomić polecenie:
`grunt`

`grunt watch` - Tryb obserwacji zmian w plikach źródłowych (js, scss) - automatycznie wygeneruje odpowiednie pliki: skompilowane pliki CSS oraz pliki JS. Umożliwia także korzystanie z livereload: https://github.com/gruntjs/grunt-contrib-watch#optionslivereload.

### Praca nad projektem ###
Po każdej aktualizacji gita należy wykonać poniższe polecenia w podanej kolejności:
```
composer update
php app/console doctrine:schema:update -f
php app/console clear:cache --env=prod
npm install
grunt

```

### Dodatkowe pomocne informacje ###
Wszystkie polecenia można wykonać z poziomu Netbeans IDE poprzez PPM na projekcie w przypadku:
*`php app/console` po wybraniu z menu `Symfony` polecenia `Run Command...`
*`composer` po wybraniu z menu `Composer` podanego polecenia
*`grunt` po wybraniu z menu `Grunt Tasks` podanego polecenia
*`npm install` po wybraniu polecenia `npm Install`

### Wstępny podział projektu ###
`App/BootBundle` - Bundle odpowiedzialny za logowanie do serwisu, stronę startową oraz menu
`App/ManagerBundle` - Bundle odpowiedzialny za obsługę zdarzeń w serwisie
`App/UserBundle` - Bundle odpowiedzialny za użytkowników, ich rejestrację i podstawowe operacje związane z kontem
`Lynx/ProjectBundle` - Bundle odpowiedzialny za Projekt i wszystkie rzeczy z nim związane
`Lynx/TaskBundle` - Bundle odpowiedzialny za pojedyńczy Task i wszystkie rzeczy z nim związane (wyświetlanie i edycja)
`Lynx/TaskboardBundle` - Bundle odpowiedzialny za wyświetlanie listy tasków
`Lynx/UserpanelBundle` - Bundle odpowiedzialny za ustawienia dotyczące Taskboardu związane z użytkownikiem
