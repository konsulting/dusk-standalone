<?php

namespace Konsulting\DuskStandalone\Tests;

use Konsulting\DuskStandalone\TestCase;

class DuskTestCase extends TestCase
{
    protected function baseUrl()
    {
        return 'https://www.klever.co.uk';
    }

    protected function browserTestsPath()
    {
        return parent::browserTestsPath();
    }

    protected function user()
    {
        parent::user();
    }
}
