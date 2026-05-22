<?php

namespace Sumaiazaman\StringableExtras\Tests;

use Orchestra\Testbench\TestCase;
use Sumaiazaman\StringableExtras\StringableExtrasServiceProvider;

class StringableExtrasTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [StringableExtrasServiceProvider::class];
    }

    public function test_when_doesnt_contain_executes_callback_when_string_does_not_contain_needle(): void
    {
        $result = str('stark')->whenDoesntContain('xxx', fn ($s) => $s->prepend('Tony ')->title());

        $this->assertSame('Tony Stark', (string) $result);
    }

    public function test_when_doesnt_contain_skips_callback_when_string_contains_needle(): void
    {
        $result = str('stark')->whenDoesntContain('tar', fn ($s) => $s->prepend('Tony ')->title());

        $this->assertSame('stark', (string) $result);
    }

    public function test_when_doesnt_contain_uses_default_when_string_contains_needle(): void
    {
        $result = str('stark')->whenDoesntContain(
            'tar',
            fn ($s) => $s->prepend('Tony ')->title(),
            fn ($s) => $s->prepend('Arno ')->title(),
        );

        $this->assertSame('Arno Stark', (string) $result);
    }

    public function test_when_doesnt_contain_accepts_array_of_needles(): void
    {
        $result = str('stark')->whenDoesntContain(['xxx', 'yyy'], fn ($s) => $s->prepend('Tony ')->title());

        $this->assertSame('Tony Stark', (string) $result);
    }

    public function test_when_doesnt_contain_all_executes_callback_when_not_all_needles_present(): void
    {
        $result = str('tony stark')->whenDoesntContainAll(['tony', 'xxx'], fn ($s) => $s->studly());

        $this->assertSame('TonyStark', (string) $result);
    }

    public function test_when_doesnt_contain_all_skips_callback_when_all_needles_present(): void
    {
        $result = str('tony stark')->whenDoesntContainAll(['tony', 'stark'], fn ($s) => $s->studly());

        $this->assertSame('tony stark', (string) $result);
    }

    public function test_when_doesnt_contain_all_uses_default_when_all_needles_present(): void
    {
        $result = str('tony stark')->whenDoesntContainAll(
            ['tony', 'stark'],
            fn ($s) => $s->studly(),
            fn ($s) => $s->title(),
        );

        $this->assertSame('Tony Stark', (string) $result);
    }
}
