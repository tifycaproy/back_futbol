<?php


class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->click('Login');
        $I->fillField('Username', 'info@gbanchs.com');
        $I->fillField('Password', '242800gab');
        $I->click('Enter');
        $I->see('Hello, Gabriel', 'h1');
        // $I->seeEmailIsSent(); // only for Symfony2
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
