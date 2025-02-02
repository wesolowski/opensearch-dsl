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

use ONGR\ElasticsearchDSL\ScriptAwareTrait;

/**
 * Class representing Bucket Script Pipeline Aggregation.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-pipeline-bucket-script-aggregation.html
 */
class BucketScriptAggregation extends AbstractPipelineAggregation
{
    use ScriptAwareTrait;

    public function __construct(string $name, array $bucketsPath, ?string $script = null)
    {
        parent::__construct($name, $bucketsPath);

        $this->setScript($script);
    }

    /**
     * {@inheritdoc}
     */
    public function getArray(): array
    {
        if (!$this->getScript()) {
            throw new \LogicException(
                sprintf(
                    '`%s` aggregation must have script set.',
                    $this->getName()
                )
            );
        }

        return [
            'buckets_path' => $this->getBucketsPath(),
            'script' => $this->getScript(),
        ];
    }

    public function getType(): string
    {
        return 'bucket_script';
    }
}
