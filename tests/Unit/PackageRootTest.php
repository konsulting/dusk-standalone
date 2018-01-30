<?php

namespace Konsulting\DuskStandalone\Tests\Unit;

use Konsulting\DuskStandalone\PackageRoot;
use PHPUnit\Framework\TestCase;

class PackageRootTest extends TestCase
{
    /** @test * */
    public function it_returns_the_right_path_when_developing_the_package()
    {
        $this->assertEquals(
            '/User/Me/Code/dusk-standalone',
            PackageRoot::for('dusk-standalone')->resolve('/User/Me/Code/dusk-standalone/src')
        );
    }

    /** @test * */
    public function it_returns_the_right_path_in_an_application()
    {
        $this->assertEquals(
            '/User/Me/Code/app/vendor/konsulting/dusk-standalone',
            PackageRoot::for ('dusk-standalone')->resolve('/User/Me/Code/app/vendor/konsulting/dusk-standalone/src')
        );
    }
}
