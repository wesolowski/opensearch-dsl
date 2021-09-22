<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\Query\Span;

use ONGR\ElasticsearchDSL\Query\Span\SpanNotQuery;

/**
 * Unit test for SpanNotQuery.
 *
 * @internal
 */
class SpanNotQueryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests for toArray().
     */
    public function testSpanNotQueryToArray(): void
    {
        $mock = $this->getMockBuilder('ONGR\ElasticsearchDSL\Query\Span\SpanQueryInterface')->getMock();
        $mock
            ->expects(static::exactly(2))
            ->method('toArray')
            ->willReturn(['span_term' => ['key' => 'value']])
        ;

        $query = new SpanNotQuery($mock, $mock);
        $result = [
            'span_not' => [
                'include' => [
                    'span_term' => ['key' => 'value'],
                ],
                'exclude' => [
                    'span_term' => ['key' => 'value'],
                ],
            ],
        ];
        static::assertEquals($result, $query->toArray());
    }
}
