<?php

declare(strict_types=1);

namespace LaraStrict\Testing\PHPUnit;

use Illuminate\Database\Eloquent\Model;
use LaraStrict\Testing\PHPUnit\Traits\MockModels;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\Adapter\Phpunit\MockeryTestCaseSetUp;

/**
 * @template TModel of Model
 * @extends ResourceTestCase<TModel>
 */
abstract class ModelResourceTestCase extends ResourceTestCase
{
    use MockeryPHPUnitIntegration;
    use MockeryTestCaseSetUp;
    use MockModels;

    protected function mockeryTestSetUp(): void
    {
        $this->mockModels();
    }

    protected function mockeryTestTearDown(): void
    {
    }
}