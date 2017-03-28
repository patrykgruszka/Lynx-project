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

Do pliku należy dodać wpis vhost dla przykładowej domeny lynx.dev znajdującej się w katalogu C:/development/polsl/lynx
```
<VirtualHost *:80>
    DocumentRoot "C:/development/polsl/lynx/web/app_dev.php"
    ServerName lynx.dev
    ErrorLog "logs/lynx.dev-error.log"
    CustomLog "logs/lynx.dev-access.log" common
    
    <Directory "C:/development/polsl/lynx">
        AllowOverride All
        Order allow,deny
        Allow from all

        Require all granted
    </Directory>
</VirtualHost>
```

Przy wykorzystaniu vhosta należy pamietać o przekierowaniu domeny na adres lokalny w pliku hosts. W systemach Windows:
` C:\Windows\System32\drivers\etc\hosts`


### Utworzenie bazy danych ###
Należy utworzyć bazę danych dla projektu lynx. Dla serwera XAMPP jest dostępny panel phpMyAdmin.

### Instalacja bazy danych oraz wymaganych bibliotek przed pierwszym uruchomieniem ###
* `composer install` - Jeśli composer został zainstalowany globalnie
* W czasie instalacji zostanie wygenerowany także plik konfiguracyjny na podstawie podanych informacji.

### Instalacja zależności projektu Node.js ###
Aby zainstalować zależności projektu Node.js w głównym katalogu projektu należy wykonać polecenie:
`npm install`

W katalogu projektu zostanie utworzony folder 'node_modules' zawierający określone paczki npm wykorzystywane w projekcie.

### Budowanie projektu za pomocą Grunt'a ###
Aby zbudować odpowiednie pliki końcowe (np. CSS i JavaScript) należy w głównym katalogu projektu uruchomić polecenie:
`grunt`

`grunt watch` - Tryb obserwacji zmian w plikach źródłowych (js, scss) - automatycznie wygeneruje odpowiednie pliki: skompilowane pliki CSS oraz pliki JS. Umożliwia także korzystanie z livereload: https://github.com/gruntjs/grunt-contrib-watch#optionslivereload.