# Schema.org průvodce


## Třída SchemaGenerator
Třída "SchemaGenerator" se stará o plnění dat a následně k renderovaní dat do stránky do script tagu.
```
<script type="application/ld+json">
[
	...Data
]
</script>
```


## Vykreslení dat
V souboru _footer.php_ před tím než končí tag `</body>` a za funkcí `wp_footer();` zavolat metodu  `SchemaGenerator::render()`. Než se kód dostane k této metodě, tak do té doby třída **SchemaGenerator** sbírá data a a při volání metody `SchemaGenerator::render()` vykreslí sesbíraná data.

```
<?php
use Components\SchemaGenerator\SchemaGenerator; 
wp_footer();
SchemaGenerator::render();
?>
</body>
</html>
```


## Společný základ 
Každá stránka má informace o webu. Stačí mít v souboru _header.php_ volání metody

```
SchemaGenerator::addSite();
```
více o metodě [addSite()](#addSite())

## Úvodní stránka
Použít metodu `SchemaGenerator::addOrganization()` před Footerem
```
SchemaGenerator::addOrganization();

get_template_part(COMPONENTS_PATH . "Footer/Footer");
```

## Blog/Archiv článků
Přidat za Header metodu: `SchemaGenerator::addArchive(Post::KEY)`

Použít z `PostModel` metodu `addItemToSchema()` při výpisu v archívech (blog, kategorie, tagy)


> ❗ Podobné články sem nepatří. Př. Detail článků mývá pod obsahem podobné články. Tyto články se do Items nepřidávájí.


```
public function addItemToSchema()
{
	SchemaGenerator::addItem([
		"@type" => "ListItem",
		"url" => $this->permaLink(),
		"name" => $this->title(),
	]);
}
```

Použít metodu v šabloně Postu

```
$Post = PostFactory::create();
$Post->addItemToSchema();
```

## Detail článků
Použít metodu v `PostModel->addPostDetailToSchema()` a poté na detailu zavolat:

```
$Post = PostFactory::create();
$Post->addPostDetailToSchema();
```

## Stránka s kontakty
Použít metodu `SchemaGenerator::addOrganization()` před Footerem.

Pokud existují kontaktní osoby(zaměstnanci), je potřeba přidat seznam zaměstnanců do Objektu Organizace v datech. Do metody `addOrganization()` implementovat přidání osob. [Jak naplnit osobama?](#přidání-osoby-do-pole-person)

```
if (is_page_template("pages/page-contact.php")) {
	if (Util::arrayIssetAndNotEmpty(self::$persons)) {
		foreach (self::$persons as $person) {
			$values["employees"][] = $person;
		}
	}
}
```

### Přidání osoby do pole $person
Při výpisu osob/zaměstnanců mít u procházené položky metodu napřidání do `SchemaGenerator::$persons`
```
public function tryAddPersonJsonLdData()
{
	SchemaGenerator::addPerson([
		"@type" => "Person",
		"name" => $this->getTitle(),
		"jobTitle" => $this->getParamJob(),
		"email" => $this->getParamEmail(),
		"telephone" => $this->getParamPhone(),
	]);
}
```

Poté už jen metodu při výpisu zavolat. Např. _employee.php_
```
$Employee = EmployeeFactory::create();
$Employee->tryAddPersonJsonLdData();
```

## Detail produktu

V případě pokud má stránka produkty. Např Rolig.cz

připravit v SchemaGenerator metodu `addProduct(ProductModel $Product)` a doupravit si použité metody, které vyplňují data ⬇️

```
    public static function addProduct(ProductModel $Product)
    {
        $ProductThumbnail = Util::getImageSrc($this->getThumbnailId(), KT_WP_IMAGE_SIZE_THUBNAIL)
        $url = $ProductModel->getPermalink();
        $Theme = PageThemeFactory::create();

        if ($Theme->isContactLogoId()) {
            $logoImage = $Theme->getContactLogoSrc();
        } else {
            $logoImage = Util::imageGetUrlFromTheme("favicon/android-chrome-192x192.png");
        }
        $Pageurl = get_home_url();

        self::addCustom([
            "@context" => "http://schema.org",
            "@type" => "Product",
            "image" => $ProductThumbnail,
            "url" => $url,
            "name" => $Product->getTitle(),
            "brand" => [
                "@type" => "Organization",
                "logo" => $logoImage,
                "name" => $Theme->getContactCompanyName(),
                "description" => $Theme->getContactDescription(),
                "email" => $Theme->getContactEmail(),
                "url" => $Pageurl,
                "telephone" => $Theme->getContactPhoneClean(),
                "taxID" => $Theme->getContactDic(),
                "sameAs" =>  $Theme->getSocialsSameAsData(),
            ],
            "offers" => [
                "@type" => "Offer",
                "priceCurrency" => "CZK",
                "price" => $ProductModel->getPriceBasicPrice(),
                "seller" => [
                    "@type" => "Organization",
                    "name" => $Theme->getContactCompanyName(),
                ]
            ]
        ]);
    }
```

Pak na detailu produktu použít:
```
$Product = ProductFactory::create();
SchemaGenerator::addProduct($Product);
```


## addOrganization()
Data se plní z Nastavení šablony z fieldsetu **Kontaktní údaje pro vyhledávače**

![Nastaveni sablony](https://i.imgur.com/PyWMzq9.png)

**Na stránkách:**
* [Úvodní stránka](#Úvodní-stránka)
* [Stránka s kontakty](#stránka-s-kontakty)

```
{
	"@context": "http://schema.org",
	"@type": "Organization",
	"logo": "OrganizationLogo.png",
	"name": "Moje Firma s.r.o",
	"description": "Firma zabývající se tím a tím a proto jsme tak dobrý",
	"email": "mojefirma@bt.cz",
	"url": "http://localhost/brilotheme",
	"telephone": "78946123",
	"taxID": "CZ55890955",
	"sameAs": 	[
	"https://www.facebook.com/ - social network profile (Facebook)",
	"https://twitter.com/ - social network profile (Twitter)",
	"https://www.instagram.com/ - social network profile (Instagram)"
	],
	"address": 	{
		"@type": "PostalAddress",
		"streetAddress": "Horákova 18",
		"postalCode": "39402",
		"addressLocality": "Praha 3",
		"addressCountry": 		{
			"@type": "Country",
			"name": "CZ"
		}
	}
}
```

## addSite()

```
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	"name": "nazevmojistranky",
	"url": "http://mojeurlwebu",
	"description": "Popis webu"
}
```
### Atributy

* **name** -        get_bloginfo("name")
* **description** - get_bloginfo("description")
* **url** -         get_home_url()








