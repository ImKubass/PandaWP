# PandaWP
Wordpress framework, který se snaží otrhnout od strukutry a workflow nativního wordpressu. Snaha o přiblížení více symfony workflow a komponentnární strukturu.
PandaWP je prozatím zavislá na [WPframeworku](http://www.wpframework.cz/), poskytující sadu komponent na vytváření formulářů, metaboxů. Nebo sadu základních presentérů a modulů.



## Obecná struktura šablony

	wp-content/themes/theme-root/
	|--images/
	|--pages/
	|--singles/
	|--taxonomies/
	|--categories/
	|--archives/
	|--panda/

- images (obrázky pro layout šablony)
- pages (soubory pro stránky – Templates)
- singles (soubory pro detaily post_type)
- taxonomies (soubory pro výpis taxonomy)
- categories (soubory pro výpis kategorií)
- archives (soubory pro zobrazení archivů)
- panda (= projekt, viz [Rozložení projektu](#rozložení-projektu))
- index.php
- functions.php
- style.css

Přičemž není třeba definovat všechny tyto adresáře, ale pouze ty, které jsou zrovna skutečně potřeba. Framework s tímto rozložením adresářů a souborů počítá a umí ho dále zpracovávat.

### Nazývání souborů

Zde obecně platí, že jednotlivé soubory šablony začínají prefixem, který určuje o jaký typ souboru jde, takže např. pro jednotlivé různé stránky (rozuměj page templaty) budou začínat jejich soubory vždy „page-“ atd., viz:


- **page**-{*template_name*}.php
- **sidebar**-{*type/location*}.php
- **single**-{*post_type*}_php

## Rozložení projektu

	panda/
	|--Assets/
	|--Components/
	|--Extensions/
	|--Js/
	|--Requires/
	|--Utils/
	|--Presenters/


- [Assets](#Assets)
- [Components](#Components)
- [Enums](#Enums)
- [Extensions](#Extensions)
- [Js](#Js)
- [Requires](#Requires)
- [Utils](#Utils)
- [Models](#Models)
- [Presenters](#Presenters)
- [Init.php](#Init.php)
- [ProjectContstants.php](#ProjectContstants.php)
- [ThemeSetup.php](#ThemeSetup.php)

### Assets
Svět kodéra. Netřeba řešit. 🚷
### Components
Jenda z nejdůležitejších složek. Společný svět kodéra a programátora.
Co je to komponenta? Odpověd v sekci [Komponenta](#Komponenta).

 >❗ Zde je potřeba zajistit stejně pojmenování komponent s kodérem aby nedocházelo přehlcení počtu složek.
### Enums
Soubory s pevnými výčtovými typy
### Extensions
Rozšíření tříd třetích stran např. GoogleApi nebo Twig.
### Js
Speciální JavaScriptové soubory, například pro AjaxHandle. Nebo JavaScript na straně administrace.

> pozn.: JavaScript na straně frontendu si řeší kodér. Neměli by si vyskytovat soubory ovlivnující DOM. Případně směřovat na kodéra.

### Requires
Shame složka pro soubory, které je potřeba includovat. Např. obecné wordpress Hooky nebo Metaboxy. Postupem času by mělo dojít k odstranění této složky.
### Utils
Složka pro pomocné třídy. Např. práce s polem nebo stringů.
### Models
Soubory s obecnými modely
### Presenters
Soubory s obecnými presentery
### Init.php
Inicializační soubor. Řeší includování souborů. Časem je se potřeba tohoto zbavit.
### ProjectContstants.php
Konstanty projektu. Názvy slugů,klíču PostTypů nebo rozměry obrázků.
### ThemeSetup.php
Soubor s konfigurací šablony. Používá prozatím pomocná třída **KT_WP_Configurator**. Zde se inicialuzují CSS, JS, rozměry obrázků, navigace, nastavení wordpressu

## Architekrura
Nestabilní a prudce se měnící. Kdo ví, jak to bude zítra 🙄

### Model
Objekt slouží pro přípravu dat. Model data stahuje z DB, připravuje do potřebných struktur a pomocí připravených funkcí je vrací. Velmi často využívá definované data z Configu.

### Config
Zde jsou definované formuláře, různé statické prvky, názvy tabulek nebo sloupců (v případě využití vlastní tabulkové struktury) a řada potřebných constant.
### Factory
Objekt sloužící k přípravě vytvoření objektu.
### Presenter

> Měl by být nahrazen Controlerem, který bude používat šablonovací systém (Twig) 

Když už se Model a Config postarají o přípravu dat, presenter je bude všechny vracet a zobrazovat na frontendu vašeho webového projektu.


## Komponenta
Mystická bytost nebývalích rozměrů a tvarů.

Logická část, která obsahuje veškeré potřebné části architektury(Model, Config), které s komponentou přímo souvísí. Název souborů odpovídá názvu složky(komponenty).

	PageContact/
	|--PageContact.php
	|--PageContactConfig.php
	|--PageContactModel.php
	|--PageContactFactory.php

Do komponenty zasahuje i kodér. Nic méně, vzajemně si nezasahujete do "svých" souborů. Je potřeba dbát na stejné pojmenování komponent, aby nevznikaly dvě složky se stejným významem. Proto je potřeba spolupracovat s kodérem.

	Post/
	|--Post.scss
	|--Post.js
	|--Post.html
	|--Post.php
	|--PostConfig.php
	|--PostModel.php
	|--PostFactory.php


## Konvence psaní kódu

PSR-2

Používáme 4 mezery k odsazení, ne tabulátory.

## Wordpress pluginy
Wordpress pluginům se snažíme vyhýbat. Nicméně pár jich používáme.

 - Yoast - SEO, pro programátora slouží více méně akorát pro generovaní drobečkové navigace.

 - WP Tracy - Tracy pro Wordpress (Pouze na localhostu) zachytávání chyb.

 - TinyMce Advanced - Rozšiřuje zádladní WYSIWIG Editor.

 - Safe SVG - Podpora uploadu SVG formátu.

 - Regenerate Thumbnails - Přeregeneruje rozměry obrázků.

 - Klasický editor - Prozatím nepoužíváme Gutenberg, proto tohle.

## Příprava prostředí

### Mac OS

1. Stáhnout MAMP
2. Změnit porty
3. Změnit Document Root podle chuti
4. Rozchodit posílání Mailu //TODO

### Windows
1. Stáhnout WAMP
2. Kuknout na tento [Tutoriál](http://blog.netcorex.cz/php5/jak-na-php-pod-windows-xampp/)

## Instalace
1. Stáhnout repozitář
2. Nahrát do šablony
3. pustit composer install (panda/)

## Příprava celého projektu
1. Založit složku s název projektu (nazevprojektu)
2. Inicializovat/naklonovat repo
3. Nakopírovat Wordpress
4. Vytvořit databázi (Název ddatabáze by měl odpovídat názvu projektové složky {*nazevprojektu*})
5. Nainstalovat wordpress (konfigurace wordpressu)
6. [Instalace PandaWP](#Instalace)

Docela otrava ne? Co to zkrátit na tři kroky? Pomocí WP-CLI
1. Inicializovat/naklonovat repozitář projektu
2. [Spustit script](#wp-cli)
3. Napsat název složky projektu

## WP CLI

Zakládání nového projektu je celkem otrava plná dokola opakujících se paternů. Pomocí scriptu, stačí napsat název projektu a o všechno je postaráno. 

### Úlohy scriptu
1. výběr složky s projektem (z adresáře pro weby)
2. **Stáhne** nejnovejší Wordpress
3. **Vytvoří** wordpress konfiguraci
4. **Vytvoří** databázi
5. **Nainstaluje** wordpress a vytvoří admina
6. **Smaže** nepotřebné pluginy
7. Stáhne repozitář PandaWP do složky s šablonama.
8. Spustí **composer install** a aktivuje šablonu.
7. Připadně doinstaluje češtinu a nastaví ji.
8. Zruší **revize** a zapne WP_DEBUG v wp-config.php
9. Nainstaluje používané pluginy a aktivuje je.
10. Nastaví strukturu linků na *'/%postname%'*

MAC OS:

//TODO link here

Windows:
not yet... sorry

## WorkFlow
Vývoj by se dal rozdělit na dvě části. Definice a Nasazení

### Definice
Definice je první část vývoje, při němž se definují CustomPostTypy, Configy, Modely. Připrava administrace, aby se dala naplnit a připrava backendu. Podklady pro definice zajištuje projektový manážer. Který určuje, co všechno je potřeba nadefinovat a nastavit. V této části vývoje není potřeba výstup od kodéra, jelikož zatím nic nevypisujeme.


### Nasazení
Část vývoje již závislá kodérovi. Používáme připravené komponenty od kodéra, které měníme ze statických šablon na dynamicky chovajíci se komponenty a začínáme oživovat web k životu. Od projektového manažera máme k dispozici jakou si "mapu" (marvelapp), kde je popsané, kde se co má vypisovat.

![Vertical grid example](https://i.imgur.com/KHyzHdA.png)




## Nasazení na work
[Návod zde](https://docs.google.com/document/d/1Mr0yezJXPcblc6HL1OCLKL7THuPD9lYXjZInNQOn0ww/edit)