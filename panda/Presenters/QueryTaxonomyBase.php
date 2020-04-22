<?php

namespace Presenters;

use Utils\Util;


class QueryTaxonomyBase
{

    const DEFAULT_COUNT = -1;

    private $Terms;
    private $TermsCount;
    private $maxCount;
    private $TaxonomyKey;
    private $TermsIds;
    private $HideEmpty = 1;
    private $Args;

    public function __construct($maxCount = self::DEFAULT_COUNT)
    {
        $this->maxCount = Util::tryGetInt($maxCount) ?: self::DEFAULT_COUNT;
        $this->setTaxonomyKey(KT_WP_CATEGORY_KEY);
    }


    public function initArgs()
    {

        $Args = [
            "taxonomy" => $this->getTaxonomyKey(),
            "hide_empty" => $this->getHideEmpty(),
        ];

        if ($this->isTermsIds()) {
            $Args["include"] = $this->getTermsIds();
        }

        return $this->setArgs($Args);
    }

    private function initTerms()
    {

        $this->initArgs();
        $Args = $this->getArgs();
        $Terms = get_terms($Args);
        if (Util::arrayIssetAndNotEmpty($Terms)) {
            $this->setTerms($Terms);
            $this->setTermsCount(count($Terms));
        } else {
            $this->setTerms([]);
            $this->setTermsCount(0);
        }
    }

    public function getTermsList()
    {
        $termsList = [];

        foreach ($this->getTerms() as $term) {
            $termLink = get_term_link($term);
            $termsList[$term->term_id] = [
                "Title" => $term->name,
                "Url" => $termLink
            ];
        }

        return $termsList;
    }

    //* --- Getters ------------------------------

    public function getTerms()
    {
        if (Util::issetAndNotEmpty($this->Terms)) {
            return $this->Terms;
        }
        $this->initTerms();
        return $this->Terms;
    }

    public function getTermsCount()
    {
        if (Util::issetAndNotEmpty($this->Terms)) {
            return $this->TermsCount;
        }
        $this->initTerms();
        return $this->TermsCount;
    }

    public function getMaxCount()
    {
        return $this->maxCount;
    }

    public function getTaxonomyKey()
    {
        return $this->TaxonomyKey;
    }

    public function getTermsIds()
    {
        return $this->TermsIds;
    }

    public function getHideEmpty()
    {
        return $this->HideEmpty;
    }

    public function getArgs()
    {
        return $this->Args;
    }

    //* --- Setters ------------------------------

    public function setTerms($Terms)
    {
        return $this->Terms = $Terms;
    }

    public function setTermsCount($TermsCount)
    {
        return $this->TermsCount = $TermsCount;
    }

    public function setMaxCount($maxCount)
    {
        return $this->maxCount = $maxCount;
    }

    public function setTaxonomyKey($TaxonomyKey)
    {
        return $this->TaxonomyKey = $TaxonomyKey;
    }

    public function setTermsIds(array $TermsIds)
    {
        return $this->TermsIds = $TermsIds;
    }

    public function setHideEmpty($HideEmpty)
    {
        return $this->HideEmpty = $HideEmpty;
    }

    public function setArgs($Args)
    {
        return $this->Args = $Args;
    }

    //* --- Issets -------------------------------

    public function isTerms()
    {
        return Util::arrayIssetAndNotEmpty($this->getTerms());
    }

    public function isTermsIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getTermsIds());
    }

    public function hasTerms()
    {
        return $this->getTermsCount() > 0;
    }
}
