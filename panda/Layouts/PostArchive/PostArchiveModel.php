<?php

namespace Layouts\PostArchive;

use Utils\Util;

/**
 * Class PostArchiveModel
 * @package Layouts\PostArchive
 */
class PostArchiveModel
{
    private $Title;
    private $Content;

    //* --- Getters ----------------------------


    public function getTitle()
    {
        return $this->Title;
    }

    public function getContent()
    {
        return $this->Content;
    }


    //* --- Setters ----------------------------


    public function setContent(string $Content)
    {
        return $this->Content = $Content;
    }

    public function setTitle(string $Title)
    {
        return $this->Title = $Title;
    }

    //* --- Issets ----------------------------

    public function isTitle()
    {
        return Util::issetAndNotEmpty($this->getTitle());
    }

    public function isContent()
    {
        return Util::issetAndNotEmpty($this->getContent());
    }
}
