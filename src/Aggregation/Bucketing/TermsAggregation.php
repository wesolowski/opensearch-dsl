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
use ONGR\ElasticsearchDSL\ScriptAwareTrait;

/**
 * Class representing TermsAggregation.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket-terms-aggregation.html
 */
class TermsAggregation extends AbstractAggregation
{
    use BucketingTrait;
    use ScriptAwareTrait;

    public function __construct($name, ?string $field = null, ?string $script = null)
    {
        parent::__construct($name);

        $this->setField($field);
        $this->setScript($script);
    }

    /**
     * {@inheritdoc}
     */
    public function getArray()
    {
        return \array_filter(
            [
                'field' => $this->getField(),
                'script' => $this->getScript(),
            ]
        );
    }

    public function getType(): string
    {
        return 'terms';
    }
}
