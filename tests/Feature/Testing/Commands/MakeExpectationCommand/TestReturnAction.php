<?php

declare(strict_types=1);

namespace Tests\LaraStrict\Feature\Testing\Commands\MakeExpectationCommand;

use ArrayAccess;
use const DIRECTORY_SEPARATOR;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use LaraStrict\Cache\Constants\CacheExpirations;
use LaraStrict\Enums\EnvironmentType;
use LaraStrict\Testing\Laravel\TestingApplication;
use Tests\LaraStrict\Feature\Testing\Commands\MakeExpectationCommand\Constants\CustomConstants;

class TestReturnAction
{
    public function execute(
        int $int,
        string $string,
        $noTypeHint,
        EnvironmentType $type,
        TestingApplication $testingApplication,
        string|int $multi,
        string|int|null $multiNull,
        string|int|null $multiNullDefault = 'test',
        ?string $optional = null,
        string $optionalString = 'test',
        string $constant = DIRECTORY_SEPARATOR,
        int $constantClass = CacheExpirations::HalfDay,
        EnvironmentType $enumDefault = EnvironmentType::Testing,
        $noTypeHintDefault = null,
        string $customConstants = CustomConstants::TEST,
        TestingApplication $object = new TestingApplication(),
        ArrayAccess&Enumerable $intersectionType = new Collection()
    ): ?int {
        return 1;
    }
}
