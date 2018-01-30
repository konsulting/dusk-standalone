<?php

namespace Konsulting\DuskStandalone;

use Laravel\Dusk\Browser;
use Konsulting\DuskStandalone\Tests\DuskTestCase;

class BrowsesTest extends DuskTestCase
{
    /** @test * */
    public function it_can_browse_a_site()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->assertSee('Klever');
        });
    }
}
