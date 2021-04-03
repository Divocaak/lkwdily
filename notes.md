
# LKW DÍLY

1. stránky
2. e-shop



## To-do list

1. __Zadáno nové__

    - [x] original čísla místo popisu produktu
    - [x] kategorie všechny, krom: motorové díly, filtry, návěsy
    - [ ] vyhledávání podle jména a original čísla

2. __Moje__

    - [ ] kategorie
        - [x] databáze
        - [x] seznam na stránce
        - [ ] zobrazování
    - [x] v detailu produktu je empty row nad kodem produktu, odstranit hover effect
    - [ ] upravit vypisování zobrazená kategorie v controll panelu
    - [ ] sizeování obrázků v košíku a dále 
    - [ ] typografická úprava obchodních podmínek
    - [ ] ikonky
    - [ ] organizace a přehlednost
        - [ ] rozsložkovat soubory
        - [ ] include page.php
    - [ ] "potvrdit objednávku" bttn - backend záležitosti
    - [ ] napsat si sem do notes.md nějaká úvodní slova do hlavičky

3. __Na schůzce__

    - [ ] zobrazovat výrobce a značku?
        - [ ] pod výrobcem je kategorie (checknout)? 
    - [ ] barvy


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


## Kategorie

("Home"),
("Všechny produkty"),
    ("Karosářské díly"),
        ("DAF"),
            ("XF 106"),
                ("Karosářské díly"),
                ("Elektroinstalační dí­ly"),
                ("Doplňky"),
            ("XF 105"),
            ("XF 95"),
            ("CF"),
            ("CF 6"),
            ("LF 45/55"),
            ("LF 6"),
        ("Iveco"),
            ("Stralis Hi-Way"),
            ("Stralis"),
            ("New EuroCargo"),
            ("Daily UniJet"),
            ("Eurotech"),
            ("EuroTrakker"),
            ("EuroCargo"),
            ("Daily 2006, 2014"),
            ("Eurostar"),
        ("MAN"),
            ("TGX Euro 6"),
            ("TGA"),
            ("TGX"),
            ("TGL Euro 6"),
            ("TGL"),
            ("TGS"),
            ("F2000"),
            ("L2000"),
        ("Mercedes Benz"),
            ("Actros I"),
            ("Actros II"),
            ("Actros III"),
            ("Actros IV"),
            ("Atego Euro 6"),
            ("Atego"),
            ("Axor"),
            ("LN"),
        ("Renault"),
            ("New Premium"),
            ("Premium"),
            ("Magnum"),
            ("Midlum"),
            ("Master 3 2010"),
            ("Range T Euro 6"),
        ("Scania"),
            ("4"),
            ("R"),
            ("R 2010"),
        ("Volvo"),
            ("FH"),
            ("FH 3"),
            ("FH 4"),
            ("FM"),
            ("FE, FL"),
    ("Osvětlení"),
        ("Hlavní světlomety"),
        ("Koncová světla"),
        ("Přídavné světlomety"),
        ("Směrová světla"),
        ("Poziční světla"),
        ("Osvětlení SPZ"),
        ("Výstražné majáky"),
        ("Žárovky"),
    ("Brzdové segmenty"),
        ("Brzdové desky"),
        ("Brzdové kotouče"),
    ("Autokosmetika"),
    ("Autobaterie"),
    ("Elektroinstalace"),
    ("Použité náhradní díly"),
    ("Příslušenství"),
    ("Sněhové řetězy"),
    ("Výprodej skladových zásob"),
    ("Nezařazené"),
    

## Připnuté

* `APSI` účetní sys. p. Kotek __+420777160206__
* `Pevaro` David __+420730173311__
* kategorie a jejich počet
    ``` sql
    SELECT category, COUNT(*) FROM part GROUP BY category;
    ```

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