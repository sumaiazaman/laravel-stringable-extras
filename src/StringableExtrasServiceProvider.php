<?php

namespace Sumaiazaman\StringableExtras;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Stringable;

class StringableExtrasServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Stringable::macro('whenDoesntContain', function ($needles, callable $callback, ?callable $default = null) {
            return $this->when($this->doesntContain($needles), $callback, $default);
        });

        Stringable::macro('whenDoesntContainAll', function (array $needles, callable $callback, ?callable $default = null) {
            return $this->when(! $this->containsAll($needles), $callback, $default);
        });
    }
}
