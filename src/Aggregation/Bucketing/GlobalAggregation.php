<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Aggregation\Bucketing;

use ONGR\ElasticsearchDSL\Aggregation\AbstractAggregation;
use ONGR\ElasticsearchDSL\Aggregation\Type\BucketingTrait;

/**
 * Class representing GlobalAggregation.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket-global-aggregation.html
 */
class GlobalAggregation extends AbstractAggregation
{
    use BucketingTrait;

    public function setField(?string $field): self
    {
        throw new \LogicException("Global aggregation, doesn't support `field` parameter");
    }

    /**
     * {@inheritdoc}
     */
    public function getArray()
    {
        return new \stdClass();
    }

    public function getType(): string
    {
        return 'global';
    }
}
