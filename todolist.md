
# LKW DÍLY

1. stránky
2. e-shop


## Dokončeno

1. __hlavní stránka__

* qtc odstranit z katalogů
* email do registrace

2. __e-shop__

* part modal
    * popis jenom jeden
    * znemožnit přidání do košíku, pokud je počet roven nule
    * kód produktu
* kód produktu na kartě
* loading na každej modal
* order overview
* form na fakturační údaje
    * validace fakt. údajů
    * pokud zvalidováno, pokračovat na plat. údaje
* fakturační a doručovací adresa
* volba dopravy
* platební metody 
* zobrazovat produkty podle otevřené kategorie
* dynamická velikost obrázků na kartě
* stránkování
    * nechat uloženou kategorii i přes jiné číslo stránky
* ovládací panel e-shopu
    1. řazení
        * dropdown
        * status
    2. info
        * počet položek v košíku
        * suma
        * počet položek
        * počet stránek
    3. košík button
        * ikonka místo textu


## Probíhající




## To-do list

1. __Zadáno nové__

* original čísla místo popisu produktu
* kategorie všechny, krom: motorové díly, filtry, návěsy

2. __Moje__

* pod výrobcem je kategorie (checknout)? 
* v detailu produktu je empty row nad kodem produktu, odstranit hover effect
* "potvrdit objednávku" bttn - backend záležitosti
* sizeování obrázků v košíku a dále 
* typografická úprava obchodních podmínek
* ikonky
* barvy tlačítek


## Připnuté

* `APSI` účetní sys. p. Kotek __+420777160206__
* `Pevaro` David __+420730173311__
* možná funkční odesílání mailu:
    ``` php
    ini_set("SMTP", "aspmx.l.google.com");
    ini_set("sendmail_from", "divokyvojta@gmail.com");
    ini_set("smtp_port", "25");
    $to = "divokyvojta@gmail.com";
    $subject = "This is subject";

    $message = "<b>This is HTML message.</b>";
    $message .= "<h1>This is headline.</h1>";

    $retval = mail ($to,$subject,$message);

    if( $retval == true ) {
    echo "Message sent successfully...";
    }else {
    echo "Message could not be sent...";
    }
    ```
* načítání tabulky do databáze
    * excel sheet uložit jako __txt oddeleny tabulatory__, kodovani __unicode utf-8__
    ``` sql
    LOAD DATA INFILE "C:/Users/Datart - Krakov/Desktop/part.txt" INTO TABLE part
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    IGNORE 1 LINES
    (@col1, @col2, @col3, @col4, @col5, @col6, @col7, @col8) SET id=@col1, img_path=@col2, name=@col3, code=@col4, category=@col5, price=@col6, storage=@col8;
    ```