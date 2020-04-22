<?php

use Components\Post\Post;
use Components\SchemaGenerator\SchemaGenerator;


get_template_part(COMPONENTS_PATH . "Header/Header");
SchemaGenerator::addArchive(Post::KEY);

get_template_part(LAYOUTS_PATH . "PostArchive/PostArchiveHeader");
get_template_part(COMPONENTS_PATH . "PostSection/PostSection");

get_template_part(COMPONENTS_PATH . "Footer/Footer");
