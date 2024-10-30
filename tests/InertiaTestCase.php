<?php

namespace Tests;

use Inertia\Testing\AssertableInertia as Assert;

abstract class InertiaTestCase extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $attempts = 5;

        while ($attempts--) {
            if (self::isServerRunning()) {
                return;
            }
            usleep(500000); // 0.5 second delay
        }

        fwrite(STDERR, "Vite server is not running. Please start it before testing.\n");
        exit(1);
    }

    public function assertHasData(Assert $data)
    {
        return $this->assertTrue(
            count($data->etc()->toArray()['props']) > 0,
            "Expected data count to be greater than 0"
        );
    }

    private static function isServerRunning(): bool
    {
        $host = 'localhost';
        $port = 5173;
        $connection = @fsockopen($host, $port);

        if ($connection) {
            fclose($connection);
            return true;
        }
        return false;
    }
}
