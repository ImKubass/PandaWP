<?php

use Components\PostsQuery\PostsQueryFactory;
use Components\ProductsQuery\ProductsQueryFactory;
use Components\SchemaGenerator\SchemaGenerator;


get_template_part(COMPONENTS_PATH . "Header/Header");

$Posts = PostsQueryFactory::create();
$Products = ProductsQueryFactory::create();


dump($Posts->getPosts());
dump($Products->getPosts());

get_template_part(COMPONENTS_PATH . "EmployeesSection/EmployeesSection");

SchemaGenerator::addOrganization();

get_template_part(COMPONENTS_PATH . "Footer/Footer");
