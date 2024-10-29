<?php

namespace Tests;

use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function assertHasData(Assert $data)
    {
        return $this->assertTrue(
            count($data->etc()->toArray()['props']) > 0,
            "Expected data count to be greater than 0"
        );
    }
}
