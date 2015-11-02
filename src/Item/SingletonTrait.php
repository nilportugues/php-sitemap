<?php

namespace NilPortugues\Sitemap\Item;

/**
 * Trait Singleton.
 */
trait SingletonTrait
{
    protected static $instance;

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
