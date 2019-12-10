<?php

namespace Formularium;

use PHP_CodeSniffer\Generators\HTML;

/**
 * Class that encapsule DOM elements. Similar to PHP DOMElement but more flexible.
 * This is not used for parsing, but to build HTML.
 */
class HTMLElement
{
    const STANDALONE_TAGS = ['img', 'hr', 'br', 'input', 'meta', 'col', 'command', 'link', 'param', 'source', 'embed'];

    /**
     * The HTML attributes and respectives values
     * This is an associative array wich:
     *     key is the attribute and
     *     value is the array with attributes values
     * @var array
     */
    protected $attributes = [];

    /**
     * Tag name
     * @var string
     */
    protected $tag;

    /**
     * The content of Element
     * @var array
     */
    protected $content = [];

    /**
     * If this tag has no children, still render it?
     * @var boolean
     */
    protected $renderIfEmpty = true;

    /**
     * Create a HTML Element
     * @param string $tag The tag name of Element
     * @param array $attributes The attribute with values
     * @param mixed $content The content of element, can be:
     *                - string (with text content)
     *                - HTMLElement
     *                - array with others elements or text
     * @param boolean $raw If true, do not escape content.
     */
    public function __construct(string $tag, array $attributes = [], $content = '', $raw = false)
    {
        $this->tag = $tag;

        $this->setAttributes($attributes);

        if (!empty($content)) {
            $this->setContent($content, true, $raw);
        }
    }

    /**
     * Create a HTML Element
     * @param string $tag The tag name of Element
     * @param array $attributes The attribute with values
     * @param mixed $content The content of element, can be:
     *                - string (with text content)
     *                - HTMLElement
     *                - array with others elements or text
     * @param boolean $raw If true, do not escape content.
     * @return HTMLElement
     */
    public static function factory(string $tag, array $attributes = [], $content = '', $raw = false): HTMLElement
    {
        return new self($tag, $attributes, $content, $raw);
    }

    /**
     * Sets whether this tag will render if it is empty (that is,
     * no contents or children)
     *
     * @param boolean $val
     * @return HTMLElement Itself
     */
    public function setRenderIfEmpty(bool $val): HTMLElement
    {
        $this->renderIfEmpty = $val;
        return $this;
    }

    /**
     * Return a tag
     * @return string tag name
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Modifies our tag
     *
     * @param string $tag
     * @return HTMLElement Itself
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Return a attribute
     * @param string $name The name of attribute
     * @return array Return the list of values, if attribute don't exist return empty array
     */
    public function getAttribute($name): array
    {
        return $this->attributes[$name] ?? [];
    }

    /**
     * Return the content of element
     * @return mixed array of HTMLElement and string (text)
     */
    public function getContent()
    {
        return $this->content;
    }

    public function isEmpty(): bool
    {
        return count($this->content) > 0;
    }

    /**
     *
     * @return int
     */
    public function getCountChildren(): int
    {
        return count($this->content);
    }

    /**
     * Set a attribute value, if attribute exist overwrite it
     * @param string $name
     * @param mixed $value Can be a string or array of string
     * @return HTMLElement Itself
     */
    public function setAttribute(string $name, $value): HTMLElement
    {
        $this->setAttributes([$name => $value], true);
        return $this;
    }

    /**
     * Add an attribute value, if attribute exist append value
     * @param string $name
     * @param mixed $value Can be a string or array of string
     * @return HTMLElement Itself
     */
    public function addAttribute(string $name, $value): HTMLElement
    {
        $this->setAttributes([$name => $value], false);
        return $this;
    }

    /**
     * Set a set of attributes
     * @param array $attributes Associative array wich
     * 				key is attributes names
     *              value is string or array values
     * @param bool $overwrite if true and attribute name exist overwrite them
     * @return HTMLElement Itself
     *
     */
    public function setAttributes(array $attributes, $overwrite = true): HTMLElement
    {
        foreach ($attributes as $atrib => $value) {
            if (is_array($value)) {
                $values = $value;
            } else {
                $values = [$value];
            }

            if ($overwrite) {
                $this->attributes[$atrib] = $values;
            } else {
                if (empty($this->attributes[$atrib])) {
                    $this->attributes[$atrib] = [];
                }

                $this->attributes[$atrib] = array_merge($this->attributes[$atrib], $values);
            }
        }
        return $this;
    }

    public function removeAttribute(string $attribute): HTMLElement
    {
        if (array_key_exists($attribute, $this->attributes)) {
            unset($this->attributes[$attribute]);
        }
        return $this;
    }

    /**
     * Aliases to HTMLElement::setAttributes($content, false);
     * @see setAttributes
     * @return HTMLElement Itself
     */
    public function addAttributes(array $attributes): HTMLElement
    {
        $this->setAttributes($attributes, false);
        return $this;
    }

    /**
     * Set content (dom objects or texts) to element
     * @param string|HTMLElement|string[]|HTMLElement[] $content The content of element, can be:
     *                - string (with text content)
     *                - HTMLElement
     *                - array with others elements or text
     * @param bool $overwrite if true overwrite content otherwise append the content
     * @param bool $raw If true, this is raw content (html) and should not be escaped.
     * @param bool $prepend If true prepend instead of appending
     * @return HTMLElement Itself
     */
    public function setContent($content, $overwrite = true, $raw = false, $prepend = false): HTMLElement
    {
        // TODO Don't work with reference objects, change it
        if (!is_array($content)) {
            $content = [$content];
        }

        if ($raw === false) {
            foreach ($content as &$item) {
                if (is_string($item)) {
                    $item = htmlspecialchars($item);
                }
            }
        }

        if ($overwrite) {
            $this->content = $content;
        } else {
            if ($prepend) {
                $this->content = array_merge($content, $this->content);
            } else {
                $this->content = array_merge($this->content, $content);
            }
        }
        return $this;
    }

    /**
     * Aliases to HTMLElement::setContent($content, false);
     * @see setContent
     * @param string|HTMLElement|string[]|HTMLElement[] $content
     * @return HTMLElement Itself
     */
    public function addContent($content, bool $raw = false): HTMLElement
    {
        $this->setContent($content, false, $raw);
        return $this;
    }

    /**
     * Appends content nodes to the bottom of this element.
     *
     * @see setContent
     * @param string|HTMLElement|string[]|HTMLElement[] $content
     * @param boolean $raw
     * @return HTMLElement
     */
    public function appendContent($content, bool $raw = false): HTMLElement
    {
        $this->setContent($content, false, $raw);
        return $this;
    }

    /**
     * Prepends content nodes to the beginning of this element.
     *
     * @see setContent
     * @param string|HTMLElement|string[]|HTMLElement[] $content
     * @param boolean $raw
     * @return HTMLElement
     */
    public function prependContent($content, bool $raw = false): HTMLElement
    {
        $this->setContent($content, false, $raw, true);
        return $this;
    }

    /**
     * Find and return elements using selector
     * @param string $selector A selector of elements based in jQuery
     *						'eee' - Select elements 'eee' (with tag)
     * 						'#ii' - Select a element with id attribute 'ii'
     * 						'.cc' - Select elements with class attribute 'cc'
     * 						'[a=v]' - Select elements with 'a' attribute with 'v' value
     * 						'e#i' - Select elements 'e' with id attribute 'i'
     * 						'e.c' - Select elements 'e' with class attribute 'c'
     * @return HTMLElement[]
     */
    public function get(string $selector)
    {
        $tag = null;
        $attr = null;
        $val = null;

        // Define what could be found
        $selector = trim($selector);
        if ($selector[0] == "#") {
            $attr = "id";
            $val = mb_substr($selector, 1);
        } elseif ($selector[0] == ".") {
            $attr = "class";
            $val = mb_substr($selector, 1);
        } elseif (mb_strpos($selector, "=") !== false) {
            list($attr, $val) = explode("=", substr($selector, 1, -1));
        } elseif (mb_strpos($selector, "#") !== false) {
            $attr = "id";
            list($tag, $val) = explode("#", $selector);
        } elseif (mb_strpos($selector, ".") !== false) {
            $attr = "class";
            list($tag, $val) = explode(".", $selector);
        } else {
            $tag = $selector;
        }

        return $this->getInternal($this, $tag, $attr, $val);
    }

    /**
     * Find and return elements based in $tag, $attr, $val
     * The $tag or $attr must be a value
     *
     * @see HTMLElement::get
     * @param string $tag tag of search
     * @param string $attr attribute of search
     * @param string $val value of attribute search
     * @return HTMLElement[]
     */
    public function getElements(string $tag, string $attr, string $val)
    {
        return $this->getInternal($this, $tag, $attr, $val);
    }

    /**
     * Recursive function to found elements
     * @param HTMLElement $element Element that will be available
     * @param string $tag Tag or null value to compare
     * @param string $attr Attribute name or null value to compare
     * @param string $val Value of attribute or null value to compare
     * @return HTMLElement[]
     */
    protected function getInternal(HTMLElement $element, string $tag = null, string $attr = null, string $val = null)
    {
        if ($this->match($element, $tag, $attr, $val)) {
            $return = [$element];
        } else {
            $return = [];
        }

        foreach ($element->getContent() as $content) {
            if ($content instanceof HTMLElement) {
                $return = array_merge($return, $this->getInternal($content, $tag, $attr, $val));
            }
        }

        return $return;
    }

    /**
     * Return a boolean based on match of the element with $tag, $attr or $val
     * @param HTMLElement $element Element that will be available
     * @param string $tag Tag or null value to compare
     * @param string $attr Attribute name or null value to compare
     * @param string $val Value of attribute or null value to compare
     * @return boolean - true when satisfy and false otherwise
     */
    protected function match(HTMLElement $element, $tag, $attr, $val): bool
    {
        if (!empty($tag)) {
            if ($element->getTag() != $tag) {
                return false;
            }
        } elseif (empty($attr)) {
            // Only when $tag and $attr is empty
            return false;
        }

        if (!empty($attr)) {
            $values = $element->getAttribute($attr);
            if (count($values) == 0) {
                return false;
            }

            if (!empty($val)) {
                return in_array($val, $values);
            }
        }

        return true;
    }

    public function __toString()
    {
        return $this->getRenderHTML();
    }
    
    /**
     * Return the html element code including all children
     * @return string (html code)
     */
    public function getRenderHTML($indentString = '  ', $level = 0): string
    {

        // skip empty non renderable
        if ($this->renderIfEmpty === false) {
            if (!count($this->content)) {
                return '';
            }
        }

        // start
        $data = [];

        // if this is not empty, the tag
        if (!empty($this->tag)) {
            $open = [];
            $open[] = ($level > 0 ? $indentString : '') . // initial indentation
                '<' . htmlspecialchars($this->tag);

            // render tag attributes
            foreach ($this->attributes as $atrib => $value) {
                $open[] = $atrib . '="' . htmlspecialchars(implode(' ', $value)) . '"';
            }
            $data[] = join(' ', $open) . (in_array($this->tag, self::STANDALONE_TAGS) ? '/>' : '>');
        }

        // recurse
        $contentdata = [];
        $emptyfieldset = ($this->tag == 'fieldset'); // avoid rendering fieldset with only a "legend"
        foreach ($this->content as $content) {
            if ($content instanceof HTMLElement) {
                $c = $content->getRenderHTML($indentString, $level + 1);
                if ($this->tag == 'fieldset' and $content->getTag() != 'legend' and $c) {
                    $emptyfieldset = false;
                }
                $contentdata[] = $c;
            } else {
                $emptyfieldset = false;
                $contentdata[] = $indentString . $content;
            }
        }

        // handle special empty cases
        if ($emptyfieldset) {
            return '';
        } elseif ($contentdata == [] && $this->renderIfEmpty === false) {
            return '';
        }

        // join content
        $data = array_merge($data, $contentdata);

        // handle closing
        if (!empty($this->tag)
            && !in_array($this->tag, self::STANDALONE_TAGS)
        ) {
            $data[] = '</' . htmlspecialchars($this->tag) . '>';
        }

        if ($indentString && $level === 0) {
            $data[] = "\n";
        }

        return implode(($indentString ? "\n" : '') . str_repeat($indentString, $level), $data);
    }

    /**
     * Clone HTMLElement object and its child
     * @return Object HTMLElement
     */
    public function __clone()
    {
        $obj = new HTMLElement($this->tag, $this->attributes);
        foreach ($this->content as $content) {
            if ($content instanceof HTMLElement) {
                $obj->addContent(clone $content);
            } else {
                $obj->addContent($content);
            }
        }
    }

    /**
     * Clear All Attributes
     */
    public function clearAttributes(): HTMLElement
    {
        $this->attributes = [];
        return $this;
    }


    /**
     * Clear All Content
     */
    public function clearContent(): HTMLElement
    {
        $this->content = [];
        return $this;
    }

    /**
     * Similar to array_walk(). Applied to this HTMLElement and all its children.
     * Does not call text content.
     *
     * @param callable $f
     * @return HTMLElement self
     */
    public function walk(callable $f): HTMLElement
    {
        $f($this);
        foreach ($this->content as $content) {
            if ($content instanceof HTMLElement) {
                $content->walk($f);
            }
        }
        return $this;
    }

    /**
     * Similar to array_map(). Calls for text content too.
     *
     * @param callable $f
     * @return HTMLElement
     */
    public function map(callable $f): array
    {
        $data = [$f($this)];
        foreach ($this->content as $content) {
            if ($content instanceof HTMLElement) {
                $data = array_merge($data, $content->map($f));
            } else {
                $data[] = $f($content);
            }
        }
        return $data;
    }

    /**
     * Similar to array_filter().
     *
     * @param callable $f
     * @return HTMLElement
     */
    public function filter(callable $f): HTMLElement
    {
        foreach ($this->content as $key => $content) {
            if ($content instanceof HTMLElement) {
                if (!$f($content)) {
                    unset($this->content[$key]);
                } else {
                    $content->filter($f);
                }
            }
        }
        return $this;
    }
}
