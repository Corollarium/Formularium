<?php

namespace Formularium\Frontend\HTML;

/**
 * Class that encapsule DOM elements. Similar to DOMElement but more flexible.
 * Not used for parsing, but to build HTML.
 *
 */
class HTMLElement
{
    /**
     * The HTML attributes and respectives values
     * This is an associative array wich:
     *     key is the attribute and
     *     value is the array with attributes values
     * @var array $attributes
     */
    protected $attributes = array();

    /**
     * Tag name
     * @var string $tag
     */
    protected $tag;

    /**
     * The content of Element
     * @var array $content
     */
    protected $content = array();

    /**
     * If this tag has no children, still render it?
     * @var boolean $renderIfEmpty
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
    public function __construct($tag, array $attributes = [], $content = '', $raw = false)
    {
        $this->tag = $tag;

        $this->setAttributes($attributes);

        if (!empty($content)) {
            $this->setContent($content, true, $raw);
        }
    }

    public static function factory($tag, array $attributes = [], $content = '', $raw = false): HTMLElement
    {
        return new static($tag, $attributes, $content, $raw);
    }

    /**
     * Sets whether this tag will render if it is empty (that is,
     * no contents or children)
     *
     * @param boolean $val
     */
    public function setRenderIfEmpty($val)
    {
        $this->renderIfEmpty = $val;
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
    public function getAttributeValue($name)
    {
        if (empty($this->attributes[$name])) {
            return array();
        }
        return $this->attributes[$name];
    }

    /**
     * Return the content of element
     * @return mixed array of HTMLElement and string (text)
     */
    public function getContent()
    {
        return $this->content;
    }

    public function isEmpty()
    {
        return (count($this->content) > 0);
    }

    /**
     *
     * @return number
     */
    public function getCountChildren()
    {
        return count($this->content);
    }

    /**
     * Set a attribute value, if attribute exist overwrite it
     * @param string $name
     * @param mixed $value Can be a string or array of string
     * @return HTMLElement Itself
     */
    public function setAttribute($name, $value)
    {
        $this->setAttributes(array($name => $value), true);
        return $this;
    }

    /**
     * Add an attribute value, if attribute exist append value
     * @param string $name
     * @param mixed $value Can be a string or array of string
     * @return HTMLElement Itself
     */
    public function addAttribute($name, $value)
    {
        $this->setAttributes(array($name => $value), false);
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
    public function setAttributes(array $attributes, $overwrite=true)
    {
        foreach ($attributes as $atrib => $value) {
            if (is_array($value)) {
                $values = $value;
            } else {
                $values = array($value);
            }

            if ($overwrite) {
                $this->attributes[$atrib] = $values;
            } else {
                if (empty($this->attributes[$atrib])) {
                    $this->attributes[$atrib] = array();
                }

                $this->attributes[$atrib] = array_merge($this->attributes[$atrib], $values);
            }
        }
        return $this;
    }

    public function removeAttribute($attribute)
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
    public function addAttributes($attributes)
    {
        $this->setAttributes($attributes, false);
        return $this;
    }

    /**
     * Set content (dom objects or texts) to element
     * @param mixed $content The content of element, can be:
     *                - string (with text content)
     *                - HTMLElement
     *                - array with others elements or text
     * @param bool $overwrite if true overwrite content otherwise append the content
     * @param bool $raw If true, this is raw content (html) and should not be escaped.
     * @return HTMLElement Itself
     */
    public function setContent($content, $overwrite = true, $raw = false, $prepend = false)
    {
        // TODO Don't work with reference objects, change it
        if (!is_array($content)) {
            $content = array($content);
        }

        if ($raw == false) {
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
     * @return HTMLElement Itself
     */
    public function addContent($content, $raw = false)
    {
        // TODO Don't work with reference objects, change it
        $this->setContent($content, false, $raw);
        return $this;
    }

    public function appendContent($content, $raw = false)
    {
        $this->setContent($content, false, $raw);
        return $this;
    }

    public function prependContent($content, $raw = false)
    {
        // TODO Don't work with reference objects, change it
        $this->setContent($content, false, $raw, true);
        return $this;
    }

    /**
     * Find and return elements using selector
     * @param string $selector A selector of elements based in jQuery
     *						'eee' - Select elements 'eee' (with tag)
     * 						'#ii' - Select a element with id attribute 'ii'
     * 						'.cc' - Select elements with class attribute 'cc'
     * 						'a=v' - Select elements with 'a' attribute with 'v' value
     * 						'e#i' - Select elements 'e' with id attribute 'i'
     * 						'e.c' - Select elements 'e' with class attribute 'c'
     * @return array of Html_Elmement
     */
    public function get($selector)
    {
        $tag  = null;
        $attr = null;
        $val  = null;

        // Define what could be found
        $selector = trim($selector);
        if ($selector[0] == "#") {
            $attr = "id";
            $val  = mb_substr($selector, 1);
        } elseif ($selector[0] == ".") {
            $attr = "class";
            $val  = mb_substr($selector, 1);
        } elseif (mb_strpos($selector, "=") !== false) {
            list($attr, $val) = explode("=", $selector);
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
     * @see too HTMLElement::get
     * @param HTMLElement $element if null $elemnt = $this
     * @param string $tag tag of search
     * @param string $attr attribute of search
     * @param string $val value of attribute search
     * @return array of Html_Elmement
     */
    public function getElements($tag, $attr, $val)
    {
        return $this->getInternal($this, $tag, $attr, $val);
    }

    /**
     * Recursive function to found elements
     * @param HTMLElement $element Element that will be available
     * @param string $tag Tag or null value to compare
     * @param string $attr Attribute name or null value to compare
     * @param string $val Value of attribute or null value to compare
     * @return array of Html_Elmement
     */
    protected function getInternal($element, $tag, $attr, $val)
    {
        if ($this->match($element, $tag, $attr, $val)) {
            $return = array($element);
        } else {
            $return = array();
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
    protected function match(HTMLElement $element, $tag, $attr, $val)
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
            $values = $element->getAttributeValue($attr);
            if (count($values) == 0) {
                return false;
            }

            if (!empty($val)) {
                return in_array($val, $values);
            }
        }

        return true;
    }

    public function getRenderHTML()
    {
        return $this->__toString();
    }
    
    /**
     * Return the html element code including all children
     * @return string (html code)
     */
    public function __toString()
    {
        if ($this->renderIfEmpty == false) {
            if (!count($this->content)) {
                return '';
            }
        }

        $data = [];
        if (!empty($this->tag)) {
            $data[] = '<' . htmlspecialchars($this->tag);

            // TODO: Use moustache instead!
            /* $this->render('<{{tag}} {{#attributes}}{{name}}="{{value}}"{{/attributes}}>{{#content}}
             * {{item}}{{/content}}</{{tag}}>'); */

            foreach ($this->attributes as $atrib => $value) {
                $data[] = ' ' . $atrib . '="' . htmlspecialchars(implode(' ', $value)) . '"';
            }
            $data[] = '>';
        }

        $contentdata = [];
        $emptyfieldset = ($this->tag == 'fieldset'); // avoid rendering fieldset with only a "legend"
        foreach ($this->content as $content) {
            if ($content instanceof HTMLElement) {
                $c = $content->getRenderHTML();
                if ($this->tag == 'fieldset' and $content->getTag() != 'legend' and $c) {
                    $emptyfieldset = false;
                }
                $contentdata[] = $c;
            } else {
                $emptyfieldset = false;
                $contentdata[] = $content;
            }
        }

        if ($emptyfieldset) {
            return '';
        } elseif ($contentdata == [] && $this->renderIfEmpty == false) {
            return '';
        }

        $data = array_merge($data, $contentdata);

        //If dont HTML tags with no closing
        if (!empty($this->tag) && !in_array(
            $this->tag,
            array('img','hr','br','input','meta','col','command','link','param','source','embed')
        )
        ) {
            $data[] = '</' . htmlspecialchars($this->tag) . '>';
        }

        return implode("", $data);
    }

    /**
     * Show/Print the html element and all children
     */
    public function showHTML()
    {
        echo $this->getRenderHTML();
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
    public function clearAttributes()
    {
        $this->attributes = array();
        return $this;
    }


    /**
     * Clear All Content
     */
    public function clearContent()
    {
        $this->content = array();
        return $this;
    }
}
