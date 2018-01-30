<?php

namespace Konsulting\DuskStandalone;

class PackageRoot
{
    protected $package;

    public function __construct($package)
    {
        $this->package = $package;
    }

    public static function forPackage($package)
    {
        return new static($package);
    }

    public function resolve($path)
    {
        $parts = explode(DIRECTORY_SEPARATOR, $path);

        if (! $key = array_search($this->package, $parts)) {
            throw new \Exception('Unable to locate package directory in path.');
        }

        return implode(DIRECTORY_SEPARATOR, array_slice($parts, 0, $key + 1));
    }
}
