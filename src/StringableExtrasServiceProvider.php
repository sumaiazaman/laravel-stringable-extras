<?php

namespace Sumaiazaman\StringableExtras;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

class StringableExtrasServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Stringable::macro('whenDoesntContain', function ($needles, callable $callback, ?callable $default = null) {
            return $this->when(Str::doesntContain((string) $this, $needles), $callback, $default);
        });

        Stringable::macro('whenDoesntContainAll', function (array $needles, callable $callback, ?callable $default = null) {
            return $this->when(! Str::containsAll((string) $this, $needles), $callback, $default);
        });
    }
}
