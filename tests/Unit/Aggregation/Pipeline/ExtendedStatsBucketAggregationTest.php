<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\Aggregation\Pipeline;

use ONGR\ElasticsearchDSL\Aggregation\Pipeline\ExtendedStatsBucketAggregation;

/**
 * Unit test for stats bucket aggregation.
 *
 * @internal
 */
class ExtendedStatsBucketAggregationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests toArray method.
     */
    public function testToArray(): void
    {
        $aggregation = new ExtendedStatsBucketAggregation('acme', 'test');

        $expected = [
            'extended_stats_bucket' => [
                'buckets_path' => 'test',
            ],
        ];

        static::assertEquals($expected, $aggregation->toArray());
    }
}
