<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\HTMLNode;

class Pagination extends Element
{
    const BASE_URL = 'baseURL'; // base url for pagination. Default: '?'
    const CURRENT = 'current'; // current item. Conflicts with CURRENT_PAGE, use just one
    const CURRENT_PAGE = 'currentPage'; // current page. Conflicts with CURRENT, use just one
    const PAGES_AROUND = 'pagesAround'; // maximum pages listed before or after the current one
    const PER_PAGE = 'perPage'; // items per page. Default: 20
    const TOTAL_ITEMS = 'totalItems'; // total items in query.

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
}
