<?php

use Components\PostQuery\PostQueryFactory;
use Components\ProductQuery\ProductQueryFactory;
use Components\SchemaGenerator\SchemaGenerator;

get_template_part(COMPONENTS_PATH . "Header/Header");

$Posts = PostQueryFactory::create();
$Products = ProductQueryFactory::create();


// dump($Posts->getPosts());
// dump($Products->getPosts());

get_template_part(COMPONENTS_PATH . "EmployeesSection/EmployeesSection");
get_template_part(COMPONENTS_PATH . "PostSection/PostSection");

SchemaGenerator::addOrganization();

get_template_part(COMPONENTS_PATH . "Footer/Footer");
