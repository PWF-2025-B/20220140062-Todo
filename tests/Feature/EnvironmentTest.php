<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    public function testEnv()
    {
        $appName = env("YOUTUBE");

        self::assertEquals("Programer Zaman Now", $appName);
    }

    public function testDefaultValue()
    {
        $author = env("AUTHOR", "JEKO");

        self::assertEquals("JEKO", $author);
    }
}
