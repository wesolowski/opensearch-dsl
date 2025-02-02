<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Aggregation\Metric;

use ONGR\ElasticsearchDSL\Aggregation\AbstractAggregation;
use ONGR\ElasticsearchDSL\Aggregation\Type\MetricTrait;
use ONGR\ElasticsearchDSL\ScriptAwareTrait;

/**
 * Difference values counter.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-metrics-cardinality-aggregation.html
 */
class CardinalityAggregation extends AbstractAggregation
{
    use MetricTrait;
    use ScriptAwareTrait;

    private ?int $precisionThreshold = null;

    private ?bool $rehash = null;

    /**
     * {@inheritdoc}
     */
    public function getArray()
    {
        return \array_filter(
            [
                'field' => $this->getField(),
                'script' => $this->getScript(),
                'precision_threshold' => $this->getPrecisionThreshold(),
                'rehash' => $this->isRehash(),
            ],
            static function ($val) {
                return $val || \is_bool($val);
            }
        );
    }

    public function getPrecisionThreshold(): ?int
    {
        return $this->precisionThreshold;
    }

    public function setPrecisionThreshold(?int $precision): self
    {
        $this->precisionThreshold = $precision;

        return $this;
    }

    public function isRehash(): ?bool
    {
        return $this->rehash;
    }

    public function setRehash(?bool $rehash): self
    {
        $this->rehash = $rehash;

        return $this;
    }

    public function getType(): string
    {
        return 'cardinality';
    }
}
