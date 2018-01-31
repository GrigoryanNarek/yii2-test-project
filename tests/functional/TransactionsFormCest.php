<?php
use Yii;

class TransactionsFormCest
{
    public function _before(\FunctionalTester $I)
    {
            $I->amOnRoute('transactions/create');
    }

    public function FormWithEmptyData(\FunctionalTester $I)
    {
        $I->expectTo('see validations errors');
        $I->see('Nik cannot be blank.');
    }
}