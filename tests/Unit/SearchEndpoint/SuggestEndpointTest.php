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

use ONGR\ElasticsearchDSL\SearchEndpoint\SuggestEndpoint;
use ONGR\ElasticsearchDSL\Suggest\Suggest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @internal
 */
class SuggestEndpointTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests constructor.
     */
    public function testItCanBeInstantiated(): void
    {
        static::assertInstanceOf('ONGR\ElasticsearchDSL\SearchEndpoint\SuggestEndpoint', new SuggestEndpoint());
    }

    /**
     * Tests if endpoint returns builders.
     */
    public function testEndpointGetter(): void
    {
        $suggestName = 'acme_suggest';
        $text = 'foo';
        $suggest = new Suggest($suggestName, 'text', $text, 'acme');
        $endpoint = new SuggestEndpoint();
        $endpoint->add($suggest, $suggestName);
        $builders = $endpoint->getAll();

        static::assertCount(1, $builders);
        static::assertSame($suggest, $builders[$suggestName]);
    }

    /**
     * Tests endpoint normalization.
     */
    public function testNormalize(): void
    {
        $instance = new SuggestEndpoint();

        $normalizerInterface = $this->getMockForAbstractClass(
            NormalizerInterface::class
        );

        $suggest = new Suggest('foo', 'bar', 'acme', 'foo');
        $suggest2 = new Suggest('foo2', 'bar2', 'acme2', 'foo2');
        $instance->add($suggest);
        $instance->add($suggest2);

        static::assertSame(
            array_merge($suggest->toArray(), $suggest2->toArray()),
            $instance->normalize($normalizerInterface)
        );
    }
}
