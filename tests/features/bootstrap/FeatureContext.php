<?php
use Behat\Behat\Context\Context;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends DuskTestCase implements Context
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        parent::setUp();
        static::startChromeDriver();
    }
    /**
     * @When /^visit homepage$/
     */
    public function visitHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
        });
    }
}


