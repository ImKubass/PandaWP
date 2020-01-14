<?php

namespace Helpers;

use Utils\Util;

class Image
{
    private $Src;
    private $Alt;
    private $Srcset;
    private $Sizes; // size[Srcset,Media]

    public function __construct(string $Src, string $Alt, string $Srcset = null, array $Sizes = null)
    {
        $this->setSrc($Src);
        $this->setAlt($Alt);
        if (Util::issetAndNotEmpty($Srcset)) {
            $this->setSrcset($Srcset);
        }
        if (Util::arrayIssetAndNotEmpty($Sizes)) {
            $this->setSizes($Sizes);
        }
    }


    public function render()
    { ?>
        <?php if ($this->isSizes()) { ?><picture><?php } ?>

            <?php if ($this->isSizes()) { ?>
                <?php foreach ($this->getSizes() as $Size) { ?>
                    <source srcset="" data-srcset="<?= $Size["Srcset"]; ?>" media="<?= $Size["Media"]; ?>">
                <?php } ?>
            <?php } ?>

            <img src="" data-src="<?= $this->getSrc(); ?>" alt="<?= $this->getAlt(); ?>" <?php if ($this->isSrcset()) { ?> srcset="" data-srcset="<?= $this->getSrc(); ?>, <?= $this->getSrcset(); ?>" <?php } ?>>

            <noscript>
                <img src="<?= $this->getSrc(); ?>" alt="<?= $this->getAlt(); ?>">
            </noscript>

            <?php if ($this->isSizes()) { ?></picture><?php } ?>
<?php }

    //* ---- Getters --------------

    public function getSrc()
    {
        return $this->Src;
    }

    public function getAlt()
    {
        return $this->Alt;
    }

    public function getSrcset()
    {
        return $this->Srcset;
    }

    public function getSizes()
    {
        return $this->Sizes;
    }


    //* ---- Setters --------------

    public function setSrc($Src)
    {
        return $this->Src = $Src;
    }

    public function setAlt($Alt)
    {
        return $this->Alt = $Alt;
    }

    public function setSrcset($Srcset)
    {
        return $this->Srcset = $Srcset;
    }

    public function setSizes($Sizes)
    {
        return $this->Sizes = $Sizes;
    }


    //* ---- Issets --------------

    public function isSrc()
    {
        return Util::issetAndNotEmpty($this->getSrc());
    }

    public function isAlt()
    {
        return Util::issetAndNotEmpty($this->getAlt());
    }

    public function isSrcset()
    {
        return Util::issetAndNotEmpty($this->getSrcset());
    }

    public function isSizes()
    {
        return Util::arrayIssetAndNotEmpty($this->getSizes());
    }
}
