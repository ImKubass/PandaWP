# PandaWP
PandaWP je Wordpress framework, jehož cílem je otrhnout se od struktury a workflow nativního wordpressu. Základním pilířem je **komponentární** struktura.
Framework PandaWP má zavislost (dočastně) na [WPframework](http://www.wpframework.cz/), který poskytuje sadu komponent na vytváření formulářů, metaboxů a sadu základních presentérů a modulů.

&nbsp;
## Obecná struktura šablony (nativní)

 Není třeba definovat všechny tyto adresáře, ale pouze ty, které budou využívány.
 
	wp-content/themes/{theme-name}/
	|--images/
	|--pages/
	|--singles/
	|--taxonomies/
	|--categories/
	|--archives/
	|--panda/
	|--kt/

- images (statické obrázky šablony)
- pages (soubory pro stránky – Templates)
- singles (soubory pro detaily **post_type**)
- taxonomies (soubory pro výpis taxonomy)
- categories (soubory pro výpis kategorií)
- archives (soubory pro zobrazení archivů)
- panda (Hlavní projektová složka v rámci Frameworku PandaWP, viz [Rozložení projektu](#rozložení-projektu))
- kt (Legacy součást WPframeworku)
- index.php
- functions.php (Inicializace PandaWP)
- style.css 
- functions.js 



### Nazývání souborů

Obecně platí, že názvy jednotlivých souborů šablony začínají prefixem, který určuje o jaký typ souboru se jedná.

Např:
- **page**-{*template_name*}.php
- **sidebar**-{*type/location*}.php
- **single**-{*post_type*}.php

&nbsp;
## Rozložení projektu

	panda/
	|--Admin/
	|--Components/
	|--Helpers/
	|--Interfaces/
	|--Layouts/
	|--Presenters/
	|--Requires/
	|--Utils/
	|--Vendor/


### Components
Jedna z nejdůležitejších složek. Společný svět kodéra a programátora.
Co je to komponenta? Odpověd v sekci [Komponenta](#Komponenta).

### Enums
Soubory s pevnými výčtovými typy.
### Extensions
Rozšíření tříd třetích stran např. GoogleApi nebo Twig.

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
### ProjectConstants.php
Konstanty projektu. Názvy slugů,klíču PostTypů nebo rozměry obrázků.
### ThemeSetup.php
Soubor s konfigurací šablony. Používá prozatím pomocná třída **KT_WP_Configurator**. Zde se inicialuzují CSS, JS, rozměry obrázků, navigace, nastavení wordpressu

&nbsp;
## Architektura

### Model
Objekt slouží pro přípravu dat. Model data stahuje z DB, připravuje do potřebných struktur a pomocí připravených funkcí je vrací. Velmi často využívá definované data z Configu.

### Config
Zde jsou definované formuláře, různé statické prvky, názvy tabulek nebo sloupců (v případě využití vlastní tabulkové struktury) a řada potřebných constant.
### Factory
Objekt sloužící k přípravě vytvoření objektu.
### Presenter

> Měl by být nahrazen Controlerem, který bude používat šablonovací systém (Twig) 

Když už se Model a Config postarají o přípravu dat, presenter je bude všechny vracet a zobrazovat na frontendu vašeho webového projektu.

&nbsp;
## Komponenta
Mystická bytost nebývalích rozměrů a tvarů.

Logická část, která obsahuje veškeré potřebné části architektury(Model, Config), které s komponentou přímo souvísí. Název souborů odpovídá názvu složky(komponenty).

	Post/
	|-- Term/
		|-- Category.php
		|-- CategoryConfig.php
		|-- CategoryFactory.php
		|-- CategoryModel.php
	|-- templates/
		|-- Post.php
		|-- asidePost.php
		|-- gridPost.php
	|-- Post.php
	|-- PostConfig.php
	|-- PostModel.php
	|-- PostFactory.php
	|-- PostHook.php

&nbsp;
## Konvence psaní kódu ✍️

PSR-2

Používáme 4 mezery k odsazení, ne tabulátory.

- [PSR-1](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
- [PSR-2](https://www.php-fig.org/psr/psr-2/)
- [PSR-4](https://www.php-fig.org/psr/psr-4/)


## Wordpress pluginy
Wordpress pluginům se snažíme vyhýbat. Nicméně pár jich používáme.

 - [Yoast](https://cs.wordpress.org/plugins/wordpress-seo/) - SEO, pro programátora slouží více méně akorát pro generovaní drobečkové navigace.

 - [WP Tracy](https://cs.wordpress.org/plugins/wp-tracy/) - Tracy pro Wordpress (Pouze na localhostu) zachytávání chyb.

 - [Safe SVG](https://cs.wordpress.org/plugins/safe-svg/) - Podpora uploadu SVG formátu.

 - [Regenerate Thumbnails](https://cs.wordpress.org/plugins/regenerate-thumbnails/) - Přeregeneruje rozměry obrázků.

 - [Klasický editor](https://cs.wordpress.org/plugins/classic-editor/) - Prozatím nepoužíváme Gutenberg.

&nbsp;
## Příprava prostředí

### Mac OS

1. Stáhnout MAMP
2. Změnit porty
3. Změnit Document Root podle osobních preferencí
4. Rozchodit posílání Mailu //TODO

### Windows
 [Tutoriál](http://blog.netcorex.cz/php5/jak-na-php-pod-windows-xampp/)


&nbsp;
## WP CLI

Zakládání nového projektu je celkem otrava plná dokola opakujících se paternů. Pomocí scriptu, stačí napsat název projektu a o všechno je postaráno. 

### Úlohy scriptu
1. Výběr složky s projektem (z adresáře pro weby)
2. **Stáhne** nejnovejší Wordpress
3. **Vytvoří** wordpress konfiguraci
4. **Vytvoří** databázi
5. **Nainstaluje** wordpress a vytvoří admina
6. **Smaže** nepotřebné pluginy
7. Zruší **revize** a zapne WP_DEBUG v wp-config.php
8. Nainstaluje používané pluginy a aktivuje je.
9. Nastaví strukturu linků na *'/%postname%'*

MAC OS:

//TODO link here

Windows:
not yet... sorry

&nbsp;
## WorkFlow
Vývoj by se dal rozdělit na dvě části. Definice a Nasazení

### Definice
Definice je první část vývoje, při němž se definují CustomPostTypy, Configy, Modely. Připrava administrace, aby se dala naplnit a připrava backendu. Podklady pro definice zajištuje projektový manážer. Který určuje, co všechno je potřeba nadefinovat a nastavit. V této části vývoje není potřeba výstup od kodéra, jelikož zatím nic nevypisujeme.


### Nasazení
Část vývoje již závislá kodérovi. Používáme připravené komponenty od kodéra, které měníme ze statických šablon na dynamicky chovajíci se komponenty a začínáme oživovat web k životu. Od projektového manažera máme k dispozici jakou si "mapu" (marvelapp), kde je popsané, kde se co má vypisovat.

![Marvelapp example](https://i.imgur.com/KHyzHdA.png)

&nbsp;
## Nasazení na work
[Návod zde](https://docs.google.com/document/d/1Mr0yezJXPcblc6HL1OCLKL7THuPD9lYXjZInNQOn0ww/edit)

## Editor

### VsCode

#### Potřebné rozšíření

[PHP Intelephense](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)


#### Doporučené rozšíření

[VSCode Great Icons](https://marketplace.visualstudio.com/items?itemName=emmanuelbeziat.vscode-great-icons)

[Better Align](https://marketplace.visualstudio.com/items?itemName=wwm.better-align)

[PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)

[PHP Namespace Resolver](https://marketplace.visualstudio.com/items?itemName=MehediDracula.php-namespace-resolver)

[Auto Rename Tag](https://marketplace.visualstudio.com/items?itemName=formulahendry.auto-rename-tag)

[Beautify](https://marketplace.visualstudio.com/items?itemName=HookyQR.beautify)

[Better Comments](https://marketplace.visualstudio.com/items?itemName=aaron-bond.better-comments)

[Bracket Pair Colorizer 2](https://marketplace.visualstudio.com/items?itemName=CoenraadS.bracket-pair-colorizer-2)

[CSS Peek](https://marketplace.visualstudio.com/items?itemName=pranaygp.vscode-css-peek)

[Formatting Toggle](https://marketplace.visualstudio.com/items?itemName=tombonnike.vscode-status-bar-format-toggle)

[Highlight Matching Tag](https://marketplace.visualstudio.com/items?itemName=vincaslt.highlight-matching-tag)

[Path Intellisense](https://marketplace.visualstudio.com/items?itemName=christian-kohler.path-intellisense)

[Sass](https://marketplace.visualstudio.com/items?itemName=robinbentley.sass-indented)

[SCSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=mrmlnc.vscode-scss)

[open in browser](https://marketplace.visualstudio.com/items?itemName=techer.open-in-browser)

[Markdown Preview Github Styling](https://marketplace.visualstudio.com/items?itemName=bierner.markdown-preview-github-styles)


#### Potřebné nastavení
	"[php]": {
	"editor.insertSpaces": true,
	"editor.tabSize": 4,
	},

#### Doporučené nastavení
	/*Editor*/
	"window.zoomLevel": 0,
	"editor.minimap.enabled": false,
	"editor.renderWhitespace": "none",
	"editor.renderControlCharacters": false,
	"editor.detectIndentation": false,
	"editor.tabSize": 2,
	"editor.insertSpaces": false,
	"[php]": {
		"editor.insertSpaces": true,
		"editor.tabSize": 4,
	},
	"editor.formatOnSave": true,
	"editor.suggestOnTriggerCharacters": true,
	"editor.fontSize": 14,
	"editor.quickSuggestions": {
		"other": true,
		"comments": false,
		"strings": false
	},
	"editor.suggest.snippetsPreventQuickSuggestions": false,
	"editor.showFoldingControls": "always",
	"editor.wordBasedSuggestions": false,
	"editor.formatOnType": false,
	"editor.smoothScrolling": true,

	/* HTML */
	"html.format.wrapLineLength": 0,
	"html.format.preserveNewLines": true,
	"html.suggest.html5": true,
	"html.format.indentInnerHtml": false,
	"html.format.indentHandlebars": false,
	"html.format.contentUnformatted": "pre,code,textarea",

	/*Workbench*/
	"workbench.statusBar.visible": true,
	"workbench.activityBar.visible": false,
	"workbench.startupEditor": "newUntitledFile",
	"workbench.editor.enablePreview": false,

	//Your path to php
	"php.validate.executablePath": "/Applications/MAMP/bin/php/php7.4.2/bin/php",
	"php.suggest.basic": false,

	/*SCSS*/
	"scss.scannerExclude": [
		".git",
		"**/node_modules",
		"**/bower_components",
		"**/bootstrap"
	],


	/*Emmet*/
	"emmet.triggerExpansionOnTab": true,
	"emmet.syntaxProfiles": {
		"postcss": "css"
	},
	"emmet.includeLanguages": {
		"postcss": "css",
		"twig": "html",
		"njk": "html"
	},



	// A list of extensions that should be tried for finding peeked files.
	"css_peek.searchFileExtensions": [
		".scss",
		".less"
	],

	/*GIT*/
	"git.autofetch": true,

	"formattingToggle.activateFor": [
		"formatOnSave"
	],


	"files.associations": {
		".php_cs": "php",
		"*.php": "php",
		// "*.njk": "njk"
	},

