<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\SearchEndpoint;

use ONGR\ElasticsearchDSL\SearchEndpoint\SortEndpoint;
use ONGR\ElasticsearchDSL\Sort\FieldSort;

/**
 * Class SortEndpointTest.
 *
 * @internal
 */
class SortEndpointTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests constructor.
     */
    public function testItCanBeInstantiated(): void
    {
        static::assertInstanceOf('ONGR\ElasticsearchDSL\SearchEndpoint\SortEndpoint', new SortEndpoint());
    }

    /**
     * Tests endpoint normalization.
     */
    public function testNormalize(): void
    {
        $instance = new SortEndpoint();

        $normalizerInterface = $this->getMockForAbstractClass(
            'Symfony\Component\Serializer\Normalizer\NormalizerInterface'
        );

        $sort = new FieldSort('acme', FieldSort::ASC);
        $instance->add($sort);

        static::assertEquals(
            [$sort->toArray()],
            $instance->normalize($normalizerInterface)
        );
    }

    /**
     * Tests if endpoint returns builders.
     */
    public function testEndpointGetter(): void
    {
        $sortName = 'acme_sort';
        $sort = new FieldSort('acme');
        $endpoint = new SortEndpoint();
        $endpoint->add($sort, $sortName);
        $builders = $endpoint->getAll();

        static::assertCount(1, $builders);
        static::assertSame($sort, $builders[$sortName]);
    }
}
