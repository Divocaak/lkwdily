
# LKW DÍLY

1. stránky
2. e-shop



## To-do list

1. __Zadáno nové__

    - [] original čísla místo popisu produktu
    - [] kategorie všechny, krom: motorové díly, filtry, návěsy

2. __Moje__

    - [ ] pod výrobcem je kategorie (checknout)? 
    - [ ] v detailu produktu je empty row nad kodem produktu, odstranit hover effect
    - [ ] "potvrdit objednávku" bttn - backend záležitosti
    - [ ] sizeování obrázků v košíku a dále 
    - [ ] typografická úprava obchodních podmínek
    - [ ] ikonky
    - [ ] barvy tlačítek
    - [ ] rozsložkovat soubory
    - [ ] napsat si sem do notes.md nějaká úvodní slova do hlavičky



## Předvedeno

1. __e-shop__

    - [x] part modal
        - [x] popis jenom jeden
        - [x] znemožnit přidání do košíku, pokud je počet roven nule
        - [x] kód produktu
    - [x] kód produktu na kartě
    - [x] loading na každej modal
    - [x] order overview
    - [x] form na fakturační údaje
        - [x] validace fakt. údajů
        - [x] pokud zvalidováno, pokračovat na plat. údaje
    - [x] fakturační a doručovací adresa
    - [x] volba dopravy
    - [x] platební metody 
    - [x] zobrazovat produkty podle otevřené kategorie
    - [x] dynamická velikost obrázků na kartě
    - [x] stránkování
        - [x] nechat uloženou kategorii i přes jiné číslo stránky
    - [x] ovládací panel e-shopu
        - [x] řazení
            - [x] dropdown
            - [x] status
        - [x] info
            - [x] počet položek v košíku
            - [x] suma
            - [x] počet položek
            - [x] počet stránek
        - [x] košík button
            - [x] ikonka místo textu

2. __hlavní stránka__

    - [x] qtc odstranit z katalogů
    - [x] email do registrace



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