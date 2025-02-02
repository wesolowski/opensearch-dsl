<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\Aggregation\Metric;

use ONGR\ElasticsearchDSL\Aggregation\Metric\PercentileRanksAggregation;

/**
 * Percentile ranks aggregation unit tests.
 *
 * @internal
 */
class PercentileRanksAggregationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var PercentileRanksAggregation
     */
    public $agg;

    /**
     * Phpunit setup.
     */
    protected function setUp(): void
    {
        $this->agg = new PercentileRanksAggregation('foo', '');
    }

    /**
     * Tests exception when only field is set.
     */
    public function testIfExceptionIsThrownWhenFieldSetAndValueNotSet(): void
    {
        $this->expectException(\LogicException::class);
        $this->agg->setField('bar');
        $this->agg->toArray();
    }

    /**
     * Tests exception when only value is set.
     */
    public function testIfExceptionIsThrownWhenScriptSetAndValueNotSet(): void
    {
        $this->expectException(\LogicException::class);
        $this->agg->setScript('bar');
        $this->agg->toArray();
    }

    /**
     * Test getType method.
     */
    public function testGetType(): void
    {
        static::assertEquals('percentile_ranks', $this->agg->getType());
    }

    /**
     * Test toArray method.
     */
    public function testToArrayWithFieldValue(): void
    {
        $this->agg->setField('bar');
        $this->agg->setValues(['bar']);
        static::assertSame(
            [
                'percentile_ranks' => [
                    'field' => 'bar',
                    'values' => ['bar'],
                ],
            ],
            $this->agg->toArray()
        );
    }

    /**
     * Test toArray method.
     */
    public function testToArrayWithScriptValue(): void
    {
        $this->agg->setScript('bar');
        $this->agg->setValues(['bar']);
        static::assertSame(
            [
                'percentile_ranks' => [
                    'script' => 'bar',
                    'values' => ['bar'],
                ],
            ],
            $this->agg->toArray()
        );
    }
}
