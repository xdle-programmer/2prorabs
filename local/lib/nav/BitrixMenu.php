<?php
namespace nav;

class BitrixMenu {
    protected $arResult;
    protected $path;
    protected $rel;

    public function __construct($arResult)
    {
        $this->arResult = $arResult;
        $this->rel = [];
        $this->path = [-1];

        foreach ($arResult as $index => $arItem) {
            $parentIndex = $this->path[$arItem['DEPTH_LEVEL'] - 1];
            $this->rel[$parentIndex][] = $index;
            $this->path[$arItem['DEPTH_LEVEL']] = $index;
        }
    }

    public function getRootItems()
    {
        return $this->getItemsByParent(-1);
    }

    public function getItemsByParent($index)
    {
        if (empty($this->rel[$index])) {
            return [];
        }

        return array_intersect_key($this->arResult, array_flip($this->rel[$index]));
    }
}