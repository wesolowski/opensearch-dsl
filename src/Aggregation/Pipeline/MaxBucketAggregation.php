<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Aggregation\Pipeline;

/**
 * Class representing Max Bucket Pipeline Aggregation.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-pipeline-max-bucket-aggregation.html
 */
class MaxBucketAggregation extends AbstractPipelineAggregation
{
    public function getType(): string
    {
        return 'max_bucket';
    }
}
