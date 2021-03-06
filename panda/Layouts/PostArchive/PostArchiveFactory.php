<?php


namespace Layouts\PostArchive;

use Components\Post\Term\CategoryFactory;
use Layouts\Blog\BlogFactory;

/**
 * Class PostArchiveFactory
 * @package Layouts\PostArchive
 */
class PostArchiveFactory
{

    public static function create(): PostArchiveModel
    {
        $PostArchiveModel = new PostArchiveModel();

        if (is_tag() || is_category()) {
            $CategoryModel = CategoryFactory::create();

            $PostArchiveModel->setTitle($CategoryModel->getTitle());
            $PostArchiveModel->setContent($CategoryModel->getContent());

            return $PostArchiveModel;
        }

        $BlogModel = BlogFactory::create();

        $PostArchiveModel->setTitle($BlogModel->getTitle());
        $PostArchiveModel->setContent($BlogModel->getContent());

        return $PostArchiveModel;
    }
}
