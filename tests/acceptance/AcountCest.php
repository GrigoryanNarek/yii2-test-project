<?php

use yii\helpers\Url;

class AcountCest
{
    public function ensureThatAcountPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/account'));
        $I->see('My Company');
        $I->see('see list.');
        $I->see('Logout');
    }
}
