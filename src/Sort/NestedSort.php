<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Sort;

use ONGR\ElasticsearchDSL\BuilderInterface;
use ONGR\ElasticsearchDSL\ParametersTrait;

/**
 * Represents Elasticsearch "nested" sort filter.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/filter-dsl-nested-filter.html
 */
class NestedSort implements BuilderInterface
{
    use ParametersTrait;

    private string $path;

    private ?BuilderInterface $filter;

    private ?BuilderInterface $nestedFilter;

    public function __construct(
        string $path,
        ?BuilderInterface $filter = null,
        ?BuilderInterface $nestedFilter = null,
        array $parameters = []
    ) {
        $this->path = $path;
        $this->filter = $filter;
        $this->nestedFilter = $nestedFilter;
        $this->setParameters($parameters);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getFilter(): ?BuilderInterface
    {
        return $this->filter;
    }

    public function getNestedFilter(): ?BuilderInterface
    {
        return $this->nestedFilter;
    }

    public function setNestedFilter(?BuilderInterface $nestedFilter): self
    {
        $this->nestedFilter = $nestedFilter;

        return $this;
    }

    public function toArray(): array
    {
        $output = [
            'path' => $this->path,
        ];

        if ($this->filter) {
            $output['filter'] = $this->filter->toArray();
        }

        if ($this->nestedFilter) {
            $output[$this->getType()] = $this->nestedFilter->toArray();
        }

        return $this->processArray($output);
    }

    public function getType(): string
    {
        return 'nested';
    }
}
