<?php
namespace nav\Component;
\CBitrixComponent::includeComponentClass("nav:component");

class BlankComponent extends \nav\Component\Component
{
    protected $modules = [];

    public function prepareData()
    {
    }
}
