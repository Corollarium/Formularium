<?php declare(strict_types=1);

namespace Formularium;

use PHP_CodeSniffer\Generators\HTML;

/**
 * Class that encapsule DOM node elements. Similar to PHP DOMElement but more flexible.
 * This is not used for parsing, but to build HTML.
 */
class HTMLNode
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
     *                - HTMLNode
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
     *                - HTMLNode
     *                - array with others elements or text
     * @param boolean $raw If true, do not escape content.
     * @return HTMLNode
     */
    public static function factory(string $tag, array $attributes = [], $content = '', $raw = false): HTMLNode
    {
        return new self($tag, $attributes, $content, $raw);
    }

    /**
     * Sets whether this tag will render if it is empty (that is,
     * no contents or children)
     *
     * @param boolean $val
     * @return HTMLNode Itself
     */
    public function setRenderIfEmpty(bool $val): HTMLNode
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
     * @return HTMLNode Itself
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
     * Does attribute exist?
     * @param string $name The name of attribute
     * @return bool
     */
    public function hasAttribute($name): bool
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * Return the content of element
     * @return mixed array of HTMLNode and string (text)
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
     * @return HTMLNode Itself
     */
    public function setAttribute(string $name, $value): HTMLNode
    {
        $this->setAttributes([$name => $value], true);
        return $this;
    }

    /**
     * Add an attribute value, if attribute exist append value
     * @param string $name
     * @param mixed $value Can be a string or array of string
     * @return HTMLNode Itself
     */
    public function addAttribute(string $name, $value): HTMLNode
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
     * @return HTMLNode Itself
     *
     */
    public function setAttributes(array $attributes, $overwrite = true): HTMLNode
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

    public function removeAttribute(string $attribute): HTMLNode
    {
        if (array_key_exists($attribute, $this->attributes)) {
            unset($this->attributes[$attribute]);
        }
        return $this;
    }

    /**
     * Aliases to HTMLNode::setAttributes($content, false);
     * @see setAttributes
     * @return HTMLNode Itself
     */
    public function addAttributes(array $attributes): HTMLNode
    {
        $this->setAttributes($attributes, false);
        return $this;
    }

    /**
     * Set content (dom objects or texts) to element
     * @param string|HTMLNode|string[]|HTMLNode[] $content The content of element, can be:
     *                - string (with text content)
     *                - HTMLNode
     *                - array with others elements or text
     * @param bool $overwrite if true overwrite content otherwise append the content
     * @param bool $raw If true, this is raw content (html) and should not be escaped.
     * @param bool $prepend If true prepend instead of appending
     * @return HTMLNode Itself
     */
    public function setContent($content, $overwrite = true, $raw = false, $prepend = false): HTMLNode
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
     * Aliases to HTMLNode::setContent($content, false);
     * @see setContent
     * @param string|HTMLNode|string[]|HTMLNode[] $content
     * @return HTMLNode Itself
     */
    public function addContent($content, bool $raw = false): HTMLNode
    {
        $this->setContent($content, false, $raw);
        return $this;
    }

    /**
     * Appends content nodes to the bottom of this element.
     *
     * @see setContent
     * @param string|HTMLNode|string[]|HTMLNode[] $content
     * @param boolean $raw
     * @return HTMLNode
     */
    public function appendContent($content, bool $raw = false): HTMLNode
    {
        $this->setContent($content, false, $raw);
        return $this;
    }

    /**
     * Prepends content nodes to the beginning of this element.
     *
     * @see setContent
     * @param string|HTMLNode|string[]|HTMLNode[] $content
     * @param boolean $raw
     * @return HTMLNode
     */
    public function prependContent($content, bool $raw = false): HTMLNode
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
     * @return HTMLNode[]
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
     * @see HTMLNode::get
     * @param string $tag tag of search
     * @param string $attr attribute of search
     * @param string $val value of attribute search
     * @return HTMLNode[]
     */
    public function getElements(string $tag, string $attr, string $val)
    {
        return $this->getInternal($this, $tag, $attr, $val);
    }

    /**
     * Recursive function to found elements
     * @param HTMLNode $element Element that will be available
     * @param string $tag Tag or null value to compare
     * @param string $attr Attribute name or null value to compare
     * @param string $val Value of attribute or null value to compare
     * @return HTMLNode[]
     */
    protected function getInternal(HTMLNode $element, string $tag = null, string $attr = null, string $val = null)
    {
        if ($this->match($element, $tag, $attr, $val)) {
            $return = [$element];
        } else {
            $return = [];
        }

        foreach ($element->getContent() as $content) {
            if ($content instanceof HTMLNode) {
                $return = array_merge($return, $this->getInternal($content, $tag, $attr, $val));
            }
        }

        return $return;
    }

    /**
     * Return a boolean based on match of the element with $tag, $attr or $val
     * @param HTMLNode $element Element that will be available
     * @param string $tag Tag or null value to compare
     * @param string $attr Attribute name or null value to compare
     * @param string $val Value of attribute or null value to compare
     * @return boolean - true when satisfy and false otherwise
     */
    protected function match(HTMLNode $element, $tag, $attr, $val): bool
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
     *
     * @param string $indentString String used to indent HTML code. Use '' for a compact version.
     * @param integer $level The current indentation level.
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
            if ($content instanceof HTMLNode) {
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
     * Clone HTMLNode object and its child
     * @return Object HTMLNode
     */
    public function __clone()
    {
        $obj = new HTMLNode($this->tag, $this->attributes);
        foreach ($this->content as $content) {
            if ($content instanceof HTMLNode) {
                $obj->addContent(clone $content);
            } else {
                $obj->addContent($content);
            }
        }
    }

    public function replace(HTMLNode $e): void
    {
        $this->tag = $e->tag;
        $this->attributes = $e->attributes;
        $this->content = $e->content;
    }

    /**
     * Clear All Attributes
     */
    public function clearAttributes(): HTMLNode
    {
        $this->attributes = [];
        return $this;
    }


    /**
     * Clear All Content
     */
    public function clearContent(): HTMLNode
    {
        $this->content = [];
        return $this;
    }

    /**
     * Similar to array_walk(). Applied to this HTMLNode and all its children.
     * Does not call callback for text content.
     *
     * @param callable $f
     * @return HTMLNode self
     */
    public function walk(callable $f): HTMLNode
    {
        $f($this);
        foreach ($this->content as $content) {
            if ($content instanceof HTMLNode) {
                $content->walk($f);
            }
        }
        return $this;
    }

    /**
     * Similar to array_map(). Calls callback for text content too.
     *
     * @param callable $f
     * @return array
     */
    public function map(callable $f, bool $recurse = true): array
    {
        $data = [$f($this)];
        foreach ($this->content as $content) {
            if ($recurse && $content instanceof HTMLNode) {
                $data = array_merge($data, $content->map($f, $recurse));
            } else {
                $data[] = $f($content);
            }
        }
        return $data;
    }

    /**
     * Similar to array_filter(): removes children from this element.
     * Does not call callback for text content.
     *
     * @param callable $f If returns false, element being checked is removed.
     * @return HTMLNode[] The filtered elements.
     */
    public function filter(callable $f, bool $recurse = true): array
    {
        $deleted = [];
        foreach ($this->content as $key => $content) {
            if ($content instanceof HTMLNode) {
                if (!$f($content)) {
                    $deleted[] = $this->content[$key];
                    unset($this->content[$key]);
                } elseif ($recurse) {
                    $content->filter($f, $recurse);
                }
            }
        }
        return $deleted;
    }
}
