<?php

class IndexFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
    }
}