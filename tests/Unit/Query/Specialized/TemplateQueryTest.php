<?php declare(strict_types=1);

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\Query\Specialized;

use ONGR\ElasticsearchDSL\Query\Specialized\TemplateQuery;

/**
 * Unit test for Template.
 *
 * @internal
 */
class TemplateQueryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Tests toArray() method with inline.
     */
    public function testToArrayInline(): void
    {
        $inline = '"term": {"field": "{{query_string}}"}';
        $params = ['query_string' => 'all about search'];
        $query = new TemplateQuery(null, $inline, $params);
        $expected = [
            'template' => [
                'inline' => $inline,
                'params' => $params,
            ],
        ];
        static::assertEquals($expected, $query->toArray());
    }

    /**
     * Tests toArray() method with file
     */
    public function testToArrayFile(): void
    {
        $file = 'my_template';
        $params = ['query_string' => 'all about search'];
        $query = new TemplateQuery();
        $query->setFile($file);
        $query->setParams($params);
        $expected = [
            'template' => [
                'file' => $file,
                'params' => $params,
            ],
        ];
        static::assertEquals($expected, $query->toArray());
    }

    /**
     * Tests toArray() exception
     */
    public function testToArrayException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $query = new TemplateQuery();
        $query->toArray();
    }
}
