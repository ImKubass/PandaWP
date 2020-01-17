<?php

namespace Helpers;

use Utils\Util;
use Utils\Image as UtilsImage;

class Image
{
    private $Id;

    private $Src;
    private $SrcSize = KT_WP_IMAGE_SIZE_MEDIUM;
    private $Alt;
    private $SrcsetItems;
    private $Sources; // source[Srcset,Media]


    private $IsNoScript = true;

    public function __construct(int $Id)
    {
        $this->setId($Id);
    }



    //* ---- Public functions --------------

    public function addSrcsetItem($Size, $Postfix = null)
    {
        if ($this->isId()) {
            if (!$this->isSrcsetItems()) {
                $Item = $this->getSrc() . " 1x";
                $this->setSrcsetItems([$Item]);
            }
            $SrcSet = UtilsImage::getImageSrc($this->getId(), $Size);
            if (!Util::issetAndNotEmpty($Postfix)) {
                $Postfix = UtilsImage::getImageWidth($this->getId(), $Size) . "w";
            }
            $Item = $SrcSet . " " . $Postfix;

            $SrcsetItems = $this->getSrcsetItems();
            array_push($SrcsetItems, $Item);
            return $this->setSrcsetItems($SrcsetItems);
        }
    }

    public function addSourceItem($Size, $Media)
    {

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


    //* ---- Private functions --------------

    private function toStringSrcsetItems()
    {
        return $Srcset = implode(", ", $this->getSrcsetItems());
    }

    private function initSrc()
    {
        if ($this->isId()) {
            return $this->setSrc(
                UtilsImage::getImageSrc(
                    $this->getId(),
                    $this->getSrcSize()
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
        $Srcset = $this->toStringSrcsetItems();
        $Alt = $this->getAlt();

        $html = "";

        $html .= "<img ";

        $html .= "src=\"\" ";
        $html .= $this->tryGetImageParam("data-src", $Src);
        if ($Srcset) {
            $html .= "srcset=\"\" ";
            $html .= $this->tryGetImageParam("data-srcset", $Srcset);
        }
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
        if ($this->getIsNoScript()) {
            $html = "";

            $Src = $this->getSrc();
            $Alt = $this->getAlt();

            $html .= "<noscript>";
            $html .= "<img src=\"{$Src}\" alt=\"\">";
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

    public function getId()
    {
        return $this->Id;
    }

    public function getSrc()
    {
        if (!Util::issetAndNotEmpty($this->Src)) {
            $this->initSrc();
        }
        return $this->Src;
    }

    public function getSrcSize()
    {
        return $this->SrcSize;
    }

    public function getAlt()
    {

        if (!Util::issetAndNotEmpty($this->Alt)) {
            $this->initAlt();
        }
        return $this->Alt;
    }

    public function getSrcsetItems()
    {
        return $this->SrcsetItems;
    }

    public function getSources()
    {
        return $this->Sources;
    }

    public function getIsNoScript()
    {
        return $this->IsNoScript;
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

    public function setSrcSize($SrcSize)
    {
        $this->SrcSize = $SrcSize;

        return $this;
    }

    public function setAlt($Alt)
    {
        return $this->Alt = $Alt;
    }

    public function setSrcsetItems($SrcsetItems)
    {
        return $this->SrcsetItems = $SrcsetItems;
    }

    public function setSources($Sources)
    {
        return $this->Sources = $Sources;
    }

    public function setIsNoScript($IsNoScript)
    {
        return $this->IsNoScript = $IsNoScript;
    }



    //* ---- Issets --------------

    public function isId()
    {
        return Util::issetAndNotEmpty($this->getId());
    }

    public function isSrc()
    {
        return Util::issetAndNotEmpty($this->getSrc());
    }

    public function isSrcSize()
    {
        return Util::issetAndNotEmpty($this->getSrcSize());
    }

    public function isAlt()
    {
        return Util::issetAndNotEmpty($this->getAlt());
    }

    public function isSrcsetItems()
    {
        return Util::arrayIssetAndNotEmpty($this->getSrcsetItems());
    }

    public function isSources()
    {
        return Util::arrayIssetAndNotEmpty($this->getSources());
    }
}
