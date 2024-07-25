Beauty Salon Finder API
=======================
Opis Projektu
-------------
Projekt udostępnia listę salonów beauty wraz z ich usługami.

Technologie
-----------

*   **PHP**: wersja 8.3.9
*   **Laravel**: wersja 11
*   **Biblioteki**:
    *   [Spatie Query Builder](https://github.com/spatie/laravel-query-builder)
    *   [DarkaOnline Swagger](https://github.com/DarkaOnLine/L5-Swagger)
        

Instalacja
----------
1.  Klonowanie repozytorim
```git clone https://github.com/TwojeRepo/beauty-salons-api.gitcd beauty-salons-api```
2.  Instalacja zależności
```composer install```
3.  Konfiguracja pliku env
Skopiuj plik .env.example do .env i wypełnij odpowiednimi danymi
4. Wykonaj migrację bazy danych
```php artisan migrate```

Dokumentacja API
----------------
Dokumentacja API jest dostępna pod adresem /api/documentation po uruchomieniu serwera. Wykorzystuje ona bibliotekę Swagger do generowania interaktywnej dokumentacji. Użyj komendy ```php artisan l5:generate``` aby wygenerować nową dokumentację.

Zadania cykliczne
-----------------
Aby uruchomić zadanie cykliczne do importowania salonów na hostingu, dodaj następujące polecenie do cron'a:
```* * * * */cron/import-salons```