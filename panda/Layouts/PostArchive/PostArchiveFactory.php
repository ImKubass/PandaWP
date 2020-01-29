<?php


namespace Layouts\PostArchive;

use Layouts\Page\PageModel;
use Components\Post\Term\CategoryFactory;

class PostArchiveFactory
{

    public static function create()
    {

        if (is_tag() || is_category()) {
            $CategoryModel = CategoryFactory::create();

            $PostArchiveModel = new PostArchiveModel();
            $PostArchiveModel->setTitle($CategoryModel->getTitle());
            $PostArchiveModel->setContent($CategoryModel->getContent());

            return $PostArchiveModel;
        }

        global $post;
        $PostsPageId = get_option(KT_WP_OPTION_KEY_POSTS_PAGE);

        if (isset($post) && $post->ID == $PostsPageId) {
            $PageModel = new PageModel($post);
        } else {
            $PageModel = new PageModel(get_post($PostsPageId));
        }

        $PostArchiveModel = new PostArchiveModel();
        $PostArchiveModel->setTitle($PageModel->getTitle());
        $PostArchiveModel->setContent($PageModel->getContent());

        return $PostArchiveModel;
    }
}
