<?php

namespace Konsulting\DuskStandalone;

use Exception;
use Konsulting\DuskStandalone\Concerns\StartsChrome;
use Konsulting\DuskStandalone\Exceptions\CannotCreateDirectory;
use Konsulting\DuskStandalone\Exceptions\NotADirectory;
use Konsulting\ProjectRoot;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\SupportsChrome;
use Laravel\Dusk\Concerns\ProvidesBrowser;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use ProvidesBrowser,
        SupportsChrome,
        StartsChrome;

    public static $directoriesCreated = false;

    /**
     * Register the base URL with Dusk.
     *
     * @return void
     * @throws \Exception
     * @throws \Konsulting\DuskStandalone\Exceptions\CannotCreateDirectory
     * @throws \Konsulting\DuskStandalone\Exceptions\NotADirectory
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTheBrowserEnvironment();
    }

    /**
     * Setup the browser environment.
     *
     * @return void
     * @throws \Exception
     * @throws \Konsulting\DuskStandalone\Exceptions\CannotCreateDirectory
     * @throws \Konsulting\DuskStandalone\Exceptions\NotADirectory
     */
    protected function setUpTheBrowserEnvironment()
    {
        $this->createDirectories($this->browserTestsPath(), ['screenshots', 'console']);

        Browser::$baseUrl = $this->baseUrl();
        Browser::$storeScreenshotsAt = $this->browserTestsPath().'/screenshots';
        Browser::$storeConsoleLogAt = $this->browserTestsPath().'/console';
        Browser::$userResolver = function () {
            return $this->user();
        };
    }

    /**
     * Create directories.
     *
     * @param $path
     * @param $directories
     *
     * @throws \Konsulting\DuskStandalone\Exceptions\NotADirectory
     * @throws \Konsulting\DuskStandalone\Exceptions\CannotCreateDirectory
     */
    protected function createDirectories($path, $directories)
    {
        if (static::$directoriesCreated) {
            return;
        }

        if (! is_dir($path)) {
            throw new NotADirectory($path);
        }

        foreach ($directories as $dir) {
            @mkdir($path.'/'.$dir);
            if (! is_dir($path.'/'.$dir)) {
                throw new CannotCreateDirectory("{$dir}' at '{$path}");
            }
        }
    }

    /**
     * Determine the application's base URL.
     *
     * @var string
     * @return string
     */
    protected function baseUrl()
    {
        return 'http://localhost';
    }

    /**
     * Determine the path for Browser Tests.
     *
     * @return string
     * @throws \Exception
     */
    protected function browserTestsPath()
    {
        return ProjectRoot::forPackage('dusk-standalone')->resolve(__DIR__).'/tests/Browser';
    }

    /**
     * Get a callback that returns the default user to authenticate.
     *
     * @return void
     * @throws \Exception
     */
    protected function user()
    {
        throw new Exception('User resolver has not been set.');
    }
}
