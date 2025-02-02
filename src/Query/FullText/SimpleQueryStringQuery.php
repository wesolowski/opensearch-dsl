<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Query\FullText;

use ONGR\ElasticsearchDSL\BuilderInterface;
use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Represents Elasticsearch "simple_query_string" query.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-simple-query-string-query.html
 */
class SimpleQueryStringQuery implements BuilderInterface
{
    use ParametersTrait;

    private string $query;

    public function __construct(string $query, array $parameters = [])
    {
        $this->query = $query;
        $this->setParameters($parameters);
    }

    public function toArray(): array
    {
        $query = [
            'query' => $this->query,
        ];

        $output = $this->processArray($query);

        return [$this->getType() => $output];
    }

    public function getType(): string
    {
        return 'simple_query_string';
    }
}
