<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Exception\Exception;
use Formularium\Field;
use Formularium\HTMLElement;
use PHP_CodeSniffer\Generators\HTML;

class Renderable_pagination extends Renderable_constant
{
    const BASE_URL = 'BASE_URL';
    const CURRENT = 'CURRENT';
    const INITIAL = 'INITIAL';
    const PAGES_AROUND = 'PAGES_AROUND';
    const PER_PAGE = 'PER_PAGE';
    const TOTAL_ITEMS = 'TOTAL_ITEMS';

    public function viewable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->container($this->pagination($value, $field, $previous), $field);
    }
    
    public function editable($value, Field $field, HTMLElement $previous): HTMLElement
    {
        return $this->container($this->pagination($value, $field, $previous), $field);
    }

    /**
     * @param mixed $value
     * @param Field $field
     * @param HTMLElement $previous
     * @return HTMLElement
     */
    protected function pagination($value, Field $field, HTMLElement $previous): HTMLElement
    {
        $pagesaround = intval($field->getExtension(self::PAGES_AROUND, 5));
        $perpage = intval($field->getExtension(self::PER_PAGE, 20));
        $baseurl = $field->getExtension(self::BASE_URL, '?');
        $numitems = $field->getExtension(self::TOTAL_ITEMS, 0);
        $currentitem = intval($field->getExtension(self::CURRENT, 1));
    
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
            return HTMLElement::factory('');
        }
    
        $query = array();
        $parsed = parse_url($baseurl);
        if (!$parsed) {
            throw new Exception('Invalid url');
        }
        if (isset($parsed['query'])) {
            mb_parse_str($parsed['query'], $query);
        }

        $pages = [];

        if ($firstindex > 0) {
            $pages[] = $this->getItem('...', '', 'formularium-disabled');
        }
    
        for ($i = $firstindex; $i < $maxindex; $i += $perpage) {
            $currentpage = $i / $perpage + 1;
            if ($i == $currentitem) {
                $pages[] = $this->getItem((string)$currentpage, '', 'formularium-pagination-current');
            } else {
                $parsed['query'] = array_merge($query, array('begin' => $i, 'total' => $perpage));
                $baseurl = $this->glue_url($parsed);
                $pages[] = $this->getItem((string)$currentpage, $baseurl);
            }
        }
    
        if ($i < $numitems) {
            // disabled
            $pages[] = $this->getItem('...', '', 'formularium-disabled');
        }
    
        return HTMLElement::factory(
            'nav',
            ['class' => 'formularium-pagination-wrapper', 'aria-label' => "Page navigation"],
            HTMLElement::factory(
                'ul',
                ['class' => 'formularium-pagination'],
                $pages
            )
        );
    }

    protected function getItem(string $text, string $link, string $class = ''): HTMLElement
    {
        return HTMLElement::factory(
            'li',
            ['class' => ['formularium-pagination-item', $class]],
            HTMLElement::factory(
                'a',
                ['class' => 'formularium-pagination-link', 'href' => $link],
                $text
            )
        );
    }


    /**
     * Inverse of parse_url.
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
