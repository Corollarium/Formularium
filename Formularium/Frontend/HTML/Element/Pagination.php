<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Pagination extends Element
{
    const BASE_URL = 'baseURL';
    const CURRENT = 'current';
    const CURRENT_PAGE = 'currentPage';
    const PAGES_AROUND = 'pagesAround';
    const PER_PAGE = 'perPage';
    const TOTAL_ITEMS = 'totalItems';

    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $pagesaround = intval($parameters[self::PAGES_AROUND] ?? 5);
        $perpage = intval($parameters[self::PER_PAGE] ?? 20);
        $baseurl = $parameters[self::BASE_URL] ?? '?';
        $numitems = $parameters[self::TOTAL_ITEMS] ?? 0;

        // use $currentPage when defined
        if (array_key_exists(self::CURRENT_PAGE, $parameters)) {
            $currentPage = intval($parameters[self::CURRENT_PAGE]);
            $currentitem = $currentPage * ($perpage - 1);
        } else {
            $currentitem = intval($parameters[self::CURRENT] ?? 0);
            $currentPage = ceil($currentitem / $perpage);
        }
    
        // $firstindex => first id, same as 'begin'
        $firstindex = $currentitem - $pagesaround * $perpage;
        if ($firstindex < 0) {
            $firstindex = 0;
        }
    
        $maxindex = $currentitem + $pagesaround * $perpage;
        if ($maxindex > $numitems) {
            $maxindex = $numitems;
        }
    
        // only one page? don't show anything.
        if ($maxindex <= $perpage) {
            return HTMLNode::factory('');
        }
    
        $query = array();
        $parsed = parse_url($baseurl);
        if ($parsed === false) {
            throw new Exception('Invalid url' . $baseurl);
        }
        if (isset($parsed['query'])) {
            mb_parse_str($parsed['query'], $query);
        }

        $pages = [];

        if ($firstindex > 0) {
            $pages[] = $this->getItem('...', '', 'formularium-ellipsis');
        }
    
        for ($i = $firstindex; $i < $maxindex; $i += $perpage) {
            $page = $i / $perpage + 1;
            if ($i < $currentitem && $i + $perpage >= $currentitem) {
                $pages[] = $this->getItem((string)$page, '', 'formularium-pagination-current');
            } else {
                $parsed['query'] = array_merge($query, array('begin' => $i, 'total' => $perpage));
                $baseurl = $this->glue_url($parsed);
                $pages[] = $this->getItem((string)$page, $baseurl);
            }
        }
    
        if ($i < $numitems) {
            // disabled
            $pages[] = $this->getItem('...', '', 'formularium-ellipsis');
        }
    
        return HTMLNode::factory(
            'nav',
            ['class' => 'formularium-pagination-wrapper', 'aria-label' => "Page navigation"],
            HTMLNode::factory(
                'ul',
                ['class' => 'formularium-pagination'],
                $pages
            )
        );
    }

    protected function getItem(string $text, string $link, string $class = ''): HTMLNode
    {
        return HTMLNode::factory(
            'li',
            ['class' => ['formularium-pagination-item', $class]],
            HTMLNode::factory(
                'a',
                ['class' => 'formularium-pagination-link', 'href' => $link],
                $text
            )
        );
    }

    /**
     * Inverse of parse_url.
     *
     * @codeCoverageIgnore
     * @param array $parsed An array of fields, same ones as returned by parse_url.
     * In addition, the 'query' field may be an associative array as well.
     * @return string The URL.
     */
    protected function glue_url(array $parsed): string
    {
        $uri = '';
        if (isset($parsed['scheme'])) {
            $uri = $parsed['scheme'] ?
            $parsed['scheme'] . ':' . ((mb_strtolower($parsed['scheme']) == 'mailto') ? '' : '//') : '';
        }
        if (isset($parsed['user'])) {
            $uri .= $parsed['user'] ? $parsed['user'] . ($parsed['pass'] ? ':' . $parsed['pass'] : '') . '@' : '';
        }
        if (isset($parsed['host'])) {
            $uri .= $parsed['host'] ? $parsed['host'] : '';
        }
        if (isset($parsed['port'])) {
            $uri .= $parsed['port'] ? ':' . $parsed['port'] : '';
        }
        if (isset($parsed['path'])) {
            $uri .= $parsed['path'] ? $parsed['path'] : '';
        }
        if (isset($parsed['query'])) {
            if (is_array($parsed['query'])) {
                $uri .= $parsed['query'] ? '?' . http_build_query($parsed['query']) : '';
            } elseif (is_string($parsed['query'])) {
                $uri .= $parsed['query'] ? '?' . $parsed['query'] : '';
            }
        }
        if (isset($parsed['fragment'])) {
            $uri .= $parsed['fragment'] ? '#' . $parsed['fragment'] : '';
        }
        return $uri;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Pagination',
            'Creates a pagination element',
            [
                new MetadataParameter(
                    self::BASE_URL,
                    'string',
                    'Base url for pagination. Default: "?"'
                ),
                new MetadataParameter(
                    self::CURRENT,
                    'int',
                    'Current item. Conflicts with CURRENT_PAGE, use just one of them.'
                ),
                new MetadataParameter(
                    self::CURRENT_PAGE,
                    'int',
                    'Current page. Conflicts with CURRENT, use just one of them'
                ),
                new MetadataParameter(
                    self::PAGES_AROUND,
                    'int',
                    'Maximum pages show before or after the current one'
                ),
                new MetadataParameter(
                    self::PER_PAGE,
                    'int',
                    'Items per page. Default: 20'
                ),
                new MetadataParameter(
                    self::TOTAL_ITEMS,
                    'int',
                    'Total items found by query.'
                )
            ]
        );
    }
}
