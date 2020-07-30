# PandaWP
PandaWP je Wordpress framework, jehož cílem je otrhnout se od struktury a workflow nativního wordpressu. Základním pilířem je **komponentární** struktura.
Framework PandaWP má zavislost (dočastně) na [WPframework](http://www.wpframework.cz/), který poskytuje sadu komponent na vytváření formulářů, metaboxů a sadu základních presentérů a modulů.


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
	"editor.insertSpaces": true,
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
	},

