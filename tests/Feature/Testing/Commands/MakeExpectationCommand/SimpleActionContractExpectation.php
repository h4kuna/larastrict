<?php

declare(strict_types=1);

namespace Tests\LaraStrict\Feature\Testing\Commands\MakeExpectationCommand;

final class SimpleActionContractExpectation
{
    /**
     * @param \Closure(self):void|null $hook
     */
    public function __construct(
        public readonly string $first,
        public readonly int $second,
        public readonly bool $third,
        public readonly ?\Closure $hook = null,
    ) {
    }
}
