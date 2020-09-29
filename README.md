# Dusk Standalone

A simple package to use [Laravel Dusk](https://github.com/laravel/dusk) with [PHPUnit](https://phpunit.de) outside of a [Laravel](https://laravel.com) application for browser testing.

The package was put together to allow local and remote testing of legacy applications which do not have similar testing frameworks available. There are other options for doing so, but we like the API for Dusk.

Perhaps not everything will work as expected, since we're not integrated to Laravel. It's early days for this package, so it's open to improvement.

We also assist with another package, designed for using Laravel Dusk to test Laravel Packages, [Orchestra Testbench-Dusk](https://github.com/orchestral/testbench-dusk).

[![Build Status](https://travis-ci.org/konsulting/dusk-standalone.svg?branch=master)](https://travis-ci.org/konsulting/dusk-standalone)
[![Latest Stable Version](https://poser.pugx.org/konsulting/dusk-standalone/v/stable)](https://packagist.org/packages/konsulting/dusk-standalone)
[![Total Downloads](https://poser.pugx.org/konsulting/dusk-standalone/downloads)](https://packagist.org/packages/konsulting/dusk-standalone)
[![Latest Unstable Version](https://poser.pugx.org/konsulting/dusk-standalone/v/unstable)](https://packagist.org/packages/konsulting/dusk-standalone)
[![License](https://poser.pugx.org/konsulting/dusk-standalone/license)](https://packagist.org/packages/konsulting/dusk-standalone)
[![StyleCI](https://styleci.io/repos/119553457/shield?branch=master)](https://styleci.io/repos/119553457)

## Version Compatibility

The versioning for this package aligns with major releases of Dusk.

 Dusk     | Dusk Standalone
:---------|:----------
 1.x      | 1.x
 2.x      | 2.x
 3.x      | 3.x
 4.x      | 4.x
 5.x      | 5.x
 6.x      | 6.x

## Installation

We recommend using composer.

`composer require konsulting/dusk-standalone`

## Usage

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

    // Set the default user - however... this is only useful if you will be
    // using the Dusk type login. It's worth reviewing the Laravel Dusk
    // trait InteractsWithAuthentication to combine with your app.
    protected function user()
    {
        return parent::user();
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

### Authentication

If you are able to add Dusk Login routes to your application, and for those to be secure, you will be able to use the standard dusk `login`, `loginAs`, `logout` and other methods.

If that is not possible, you can leverage the 'Macroable' nature of the Browser class to add custom methods at runtime.  Take care to not try to overwite an existing method on the Browser class.

For example: 

```php
<?php
    // In your testing bootstrap file.

    \Laravel\Dusk\Browser::macro('customLoginAs', function ($user, $pass) {
        $this->browse('login_url')
            ->type('username', $user)
            ->type('pasword', $pass)
            ->press('Login');
    });
```

## Chrome Version

If you receive an error containing information about the Chrome version (e.g. Chrome version must be between 70 and 73)

Please run `vendor/bin/dusk-updater update`

For further information please see [the Dusk Updater project](https://github.com/orchestral/dusk-updater)

## Contributing

Contributions are welcome and will be fully credited. We will accept contributions by Pull Request.

Please:

* Use the PSR-2 Coding Standard
* Add tests, if you’re not sure how, please ask.
* Document changes in behaviour, including readme.md.

## Testing
We use [PHPUnit](https://phpunit.de)

Run tests using PHPUnit: `vendor/bin/phpunit`
