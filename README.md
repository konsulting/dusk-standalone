#Dusk Standalone

A simple package to use [Laravel Dusk](https://github.com/laravel/dusk) with [PHPUnit](https://phpunit.de) outside of a [Laravel](https://laravel.com) application for browser testing.

The package was put together to allow local and remote testing of legacy applications which do not have similar testing frameworks available. There are other options for doing so, but we like the API for Dusk.

Perhaps not everything will work as expected, since we're not integrated to Laravel. It's early days for this package, so it's open to improvement.

We also assist with another package, designed for using Laravel Dusk to test Laravel Packages, [Orchestra Testbench-Dusk](https://github.com/orchestral/testbench-dusk).

##Installation

We recommend using composer.

`composer require konsulting/dusk-standalone`

##Usage

We tend to put our Browser tests in `tests/Browser`. Create a new base testcase that extends the `Konsulting\DuskStandalone\TestCase`.

This will allow you to add any customisations you want in your Dusk tests.

```php
<?php

namespace Application\Tests;

use Konsulting\DuskStandalone\TestCase;

abstract class DuskTestCase extends TestCase
{
    // Set the base url for the browser requests
    protected function baseUrl()
    {
        return 'https://www.klever.co.uk';
    }

    // Set the path for browser tests, this is where screenshots/console logs
    // are stored. The default is [app root]/tests/Browser based on the 
    // vendor folder location as per a normal Composer install.
    protected function browserTestsPath()
    {
        return parent::browserTestsPath();
    }

    // Set the closure that returns a user - however... we have disabled the 
    // Laravel Dusk authentication routes by default, since you will need
    // to set them up specifically for your application anyway.
    protected function user()
    {
        parent::user();
    }
}
```

Now create a your tests:

```php
<?php

namespace Application\Tests\Browser;

use Laravel\Dusk\Browser;
use Konsulting\DuskStandalone\Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /** @test * */
    public function it_can_browse_a_site()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')->assertSee('Klever');
        });
    }
}
```

Run your tests as part of your testsuite, or separate them out to run on their own (since browser tests can be slow).

Dusk documentation can be found [here](https://laravel.com/docs/dusk)

## Contributing

Contributions are welcome and will be fully credited. We will accept contributions by Pull Request.

Please:

* Use the PSR-2 Coding Standard
* Add tests, if you’re not sure how, please ask.
* Document changes in behaviour, including readme.md.

## Testing
We use [PHPUnit](https://phpunit.de)

Run tests using PHPUnit: `vendor/bin/phpunit`
