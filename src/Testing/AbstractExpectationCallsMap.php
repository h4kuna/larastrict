<?php

declare(strict_types=1);

namespace LaraStrict\Testing;

use LogicException;

abstract class AbstractExpectationCallsMap
{
    /**
     * @var array<class-string<object>, array<object>>
     */
    private array $_expectationMap = [];

    /**
     * @var array<class-string<object>, int>
     */
    private array $_callStep = [];

    /**
     * Contains current call number.
     */
    private int $_currentDebugStep = 0;

    public function addExpectation(object $expectation): self
    {
        $this->_expectationMap[$expectation::class][] = $expectation;

        return $this;
    }

    /**
     * @template TExpectation
     *
     * @param class-string<TExpectation> $class
     * @param array<TExpectation>        $expectations
     */
    public function setExpectations(string $class, array $expectations): self
    {
        $this->_expectationMap[$class] = $expectations;

        return $this;
    }

    public function assertCalled(): void
    {
        foreach ($this->_expectationMap as $class => $expectations) {
            $called = $this->_callStep[$class] ?? 0;
            $expected = count($expectations);
            if ($expected === $called) {
                continue;
            }

            throw new LogicException(
                sprintf('[%s] expected %d call/s but was called <%d> time/s', $class, $expected, $called)
            );
        }
    }

    /**
     * @template TExpectation of object
     *
     * @param class-string<TExpectation> $class
     *
     * @return TExpectation
     */
    protected function getExpectation(string $class): object
    {
        $map = $this->_expectationMap[$class] ?? [];
        $callStep = $this->_callStep[$class] ?? 0;

        $this->_currentDebugStep = $callStep + 1;

        if (array_key_exists($callStep, $map) === false) {
            throw new LogicException($this->getDebugMessage($this->_currentDebugStep, 'not set', 2));
        }

        /** @var TExpectation $expectation */
        $expectation = $map[$callStep];
        $this->_callStep[$class] = $this->_currentDebugStep;

        return $expectation;
    }

    protected function getDebugMessage(int $callStep = null, string $reason = 'failed', int $debugLevel = 1): string
    {
        $caller = debug_backtrace()[$debugLevel];

        return sprintf(
            'Expectation for [%s@%s] %s for a n (%s) call',
            $caller['class'] ?? $this::class,
            $caller['function'],
            $reason,
            $callStep ?? $this->_currentDebugStep
        );
    }
}
