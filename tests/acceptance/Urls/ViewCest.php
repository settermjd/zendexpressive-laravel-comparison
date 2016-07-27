<?php


class ViewCest
{
    public function testViewUrlsPage(AcceptanceTester $I)
    {
        $I->haveInDatabase('urls', [
            'shortened_url' => 'http://tSQ1r84',
            'original_url' => 'http://www.google.com',
        ]);

        $I->am('guest user');
        $I->wantTo('test that the view urls page works as expected');
        $I->amOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(200);
        $I->see('Manage URLs');
        $I->see('This form let\'s you shorten a new url, or update an existing one.');
        $I->see('http://tSQ1r84');
        $I->see('http://www.google.com');
    }
}
