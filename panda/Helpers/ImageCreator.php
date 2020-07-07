<?php

namespace Helpers;

use Utils\Util;
use Utils\Image as UtilsImage;


/**
 * Class ImageCreator
 * @package Helpers
 */
class ImageCreator
{
    private $Id;

    private $Src;
    private $Size = KT_WP_IMAGE_SIZE_MEDIUM;
    private $Alt;
    private $Srcset;
    private $Sources;

    private $Class;
    private $Title;
    private $Draggable = true;
    private $AriaHidden = false;
    private $NoScript = true;

    private $Sizes;

    public function __construct(int $Id = null)
    {
        if (Util::issetAndNotEmpty($Id)) {
            $this->setId($Id);
        }
    }


    //* ---- Public functions --------------

    /**
     *
     * @param string $Size
     * @param string|null $Postfix
     * @return array
     */
    public function addToSrcsetBySize($Size, $Postfix = null)
    {
        if ($this->isId()) {
            if (!$this->isSrcset()) {
                $Item = $this->getSrc() . " 1x";
                $this->setSrcset([$Item]);
            }

            $SrcSet = UtilsImage::getImageSrc($this->getId(), $Size);
            if (!Util::issetAndNotEmpty($Postfix)) {
                $Postfix = UtilsImage::getImageWidth($this->getId(), $Size) . "w";
            }
            $Item = $SrcSet . " " . $Postfix;
            $Srcset = $this->getSrcset();
            array_push($Srcset, $Item);
            return $this->setSrcset($Srcset);
        }
    }

    public function addToSrcset($Url, $Postfix)
    {
        if ($this->isId()) {
            if (!$this->isSrcset()) {
                $Item = $this->getSrc() . " 1x";
                $this->setSrcset([$Item]);
            }
            $Item = $Url . " " . $Postfix;
            $Srcset = $this->getSrcset();
            array_push($Srcset, $Item);
            return $this->setSrcset($Srcset);
        }
    }

    /**
     * @param string $Size
     * @param string $Media
     * @return array
     */
    public function addSourceBySize($Size, $Media)
    {
        if ($this->isId()) {
            if (!$this->isSources()) {
                $this->setSources([]);
            }
            $Srcset = UtilsImage::getImageSrc($this->getId(), $Size);
            $Item = [
                "Srcset" => $Srcset,
                "Media" => $Media
            ];
            $Sources = $this->getSources();
            array_push($Sources, $Item);
            return $this->setSources($Sources);
        }
    }


    //* ---- Private functions --------------

    /** @return string  */
    private function toStringSrcset()
    {
        if ($this->isSrcset()) {
            return $Srcset = implode(", ", $this->getSrcset());
        }
    }

    private function initSrc()
    {
        if ($this->isId()) {
            return $this->setSrc(
                UtilsImage::getImageSrc(
                    $this->getId(),
                    $this->getSize()
                )
            );
        }
    }

    private function initAlt()
    {
        if ($this->isId()) {
            $Alt = get_post_meta($this->getId(), '_wp_attachment_image_alt', true);
            if (Util::issetAndNotEmpty($Alt)) {
                return $this->setAlt($Alt);
            } else {
                $Alt = get_the_title($this->getId());
                return $this->setAlt($Alt);
            }
        }
    }

    /**
     * @param string $key
     * @param string $value
     * @return null|string
     */
    private function tryGetImageParam($key, $value)
    {
        if (isset($value)) {
            return "$key=\"$value\" ";
        }
        return null;
    }

    //* ---- Render functions --------------

    private function renderImgTag()
    {
        $Src = $this->getSrc();
        $Srcset = $this->toStringSrcset();
        $Alt = $this->getAlt();

        $Class = $this->getClass();
        $Title = $this->getTitle();
        $Draggable = $this->getDraggable();
        $AriaHidden = $this->getAriaHidden();

        $Sizes = $this->getSizes();


        $html = "";

        $html .= "<img ";

        $html .= "src=\"\" ";
        $html .= $this->tryGetImageParam("data-src", $Src);

        if ($Srcset) {
            $html .= "srcset=\"\" ";
            $html .= $this->tryGetImageParam("data-srcset", $Srcset);
        }

        if ($this->isSizes()) {
            $html .= $this->tryGetImageParam("sizes", $Sizes);
        }

        $html .= $this->tryGetImageParam("class", $Class);

        if (!$Draggable) {
            $html .= $this->tryGetImageParam("draggable", "false");
        }

        if ($AriaHidden) {
            $html .= $this->tryGetImageParam("aria-hidden", "true");
        }

        $html .= $this->tryGetImageParam("title", $Title);
        $html .= $this->tryGetImageParam("alt", $Alt);


        $html .= ">"; // Closing img tag

        return $html;
    }


    private function renderSources()
    {
        if ($this->isSources()) {
            $html = "";

            foreach ($this->getSources() as $Source) {
                $Srcset = $Source["Srcset"];
                $Media = $Source["Media"];

                $html .= "<source srcset=\"\" data-srcset=\"{$Srcset}\" media=\"{$Media}\">";
            }
            return $html;
        }
    }

    private function renderNoScript()
    {
        if ($this->getNoScript()) {
            $html = "";

            $Src = $this->getSrc();
            $Alt = $this->getAlt();

            $html .= "<noscript>";
            $html .= "<img src=\"{$Src}\" alt=\"{$Alt}\">";
            $html .= "</noscript>";

            return $html;
        }
    }

    public function render()
    {
        $html = "";

        if ($this->isSources()) {
            $html .= "<picture>";
        }

        $html .= $this->renderSources();
        $html .= $this->renderImgTag();
        $html .= $this->renderNoScript();

        if ($this->isSources()) {
            $html .= "</picture>";
        }

        return $html;
    }



    //* ---- Getters --------------

    private function getId()
    {
        return $this->Id;
    }

    private function getSrc()
    {
        if (!Util::issetAndNotEmpty($this->Src)) {
            $this->initSrc();
        }
        return $this->Src;
    }

    private function getSize()
    {
        return $this->Size;
    }

    private function getAlt()
    {

        if (!Util::issetAndNotEmpty($this->Alt)) {
            $this->initAlt();
        }
        return $this->Alt;
    }

    private function getSrcset()
    {
        return $this->Srcset;
    }

    private function getSources()
    {
        return $this->Sources;
    }

    /** @return bool */
    private function getNoScript()
    {
        return $this->NoScript;
    }

    private function getClass()
    {
        return $this->Class;
    }

    private function getTitle()
    {
        return $this->Title;
    }

    private function getDraggable()
    {
        return $this->Draggable;
    }

    private function getAriaHidden()
    {
        return $this->AriaHidden;
    }

    public function getSizes()
    {
        return $this->Sizes;
    }


    //* ---- Setters --------------

    public function setId($Id)
    {
        return $this->Id = $Id;
    }

    public function setSrc($Src)
    {
        return $this->Src = $Src;
    }

    public function setSize($Size)
    {
        $this->Size = $Size;

        return $this;
    }

    public function setAlt($Alt)
    {
        return $this->Alt = $Alt;
    }

    /**
     * @param array $Srcset
     * @return array
     */
    public function setSrcset($Srcset)
    {
        return $this->Srcset = $Srcset;
    }

    /**
     * @param array $Sources
     * @return array
     */
    private function setSources($Sources)
    {
        return $this->Sources = $Sources;
    }

    /**
     * @param bool $NoScript
     * @return bool
     */
    public function setNoScript($NoScript)
    {
        return $this->NoScript = $NoScript;
    }

    public function setClass($Class)
    {
        return $this->Class = $Class;
    }

    public function setTitle($Title)
    {
        return $this->Title = $Title;
    }

    /**
     * @param bool $Draggable
     * @return bool
     */
    public function setDraggable($Draggable)
    {
        return $this->Draggable = $Draggable;
    }

    /**
     * @param bool $AriaHidden
     * @return bool
     */
    public function setAriaHidden($AriaHidden)
    {
        return $this->AriaHidden = $AriaHidden;
    }

    public function setSizes($Sizes)
    {
        return $this->Sizes = $Sizes;
    }


    //* ---- Issets --------------

    private function isId()
    {
        return Util::issetAndNotEmpty($this->getId());
    }

    private function isSrc()
    {
        return Util::issetAndNotEmpty($this->getSrc());
    }

    private function isSize()
    {
        return Util::issetAndNotEmpty($this->getSize());
    }

    private function isAlt()
    {
        return Util::issetAndNotEmpty($this->getAlt());
    }

    private function isSrcset()
    {
        return Util::arrayIssetAndNotEmpty($this->getSrcset());
    }

    private function isSources()
    {
        return Util::arrayIssetAndNotEmpty($this->getSources());
    }

    private function isClass()
    {
        return Util::issetAndNotEmpty($this->getClass());
    }

    private function isTitle()
    {
        return Util::issetAndNotEmpty($this->getTitle());
    }

    private function isSizes()
    {
        return Util::issetAndNotEmpty($this->getSizes());
    }
}
