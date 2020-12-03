<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML;

use Formularium\HTMLNode;

class Framework extends \Formularium\Framework
{
    public const SCHEMA_ITEMSCOPE = 'itemscope';
    public const SCHEMA_ITEMTYPE = 'itemtype';

    /**
     * The tag used as container for fields in viewable()
     *
     * @var string
     */
    protected $viewableContainerTag = 'div';

    /**
     * The tag used as container for the entire html.
     *
     * @var string
     */
    protected $viewableBaseTag = 'div';

    /**
     * The tag used as container for fields in editable()
     *
     * @var string
     */
    protected $editableContainerTag = 'div';

    public function __construct(string $name = 'HTML')
    {
        parent::__construct($name);
    }

    /**
     * Get the tag used as container for the entire html.
     *
     * @return  string
     */
    public function getViewableBaseTag()
    {
        return $this->viewableBaseTag;
    }

    /**
     * Set the tag used as container for the entire html.
     *
     * @param  string  $viewableBaseTag  The tag used as container for the entire html.
     *
     * @return  self
     */
    public function setViewableBaseTag(string $viewableBaseTag): self
    {
        $this->viewableBaseTag = $viewableBaseTag;
        return $this;
    }

    public function getViewableContainerTag(): string
    {
        return $this->viewableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return self
     */
    public function setViewableContainerTag(string $tag): self
    {
        $this->viewableContainerTag = $tag;
        return $this;
    }

    public function getEditableContainerTag(): string
    {
        return $this->editableContainerTag;
    }
    
    /**
     * @param string $tag
     * @return self
     */
    public function setEditableContainerTag(string $tag): self
    {
        $this->editableContainerTag = $tag;
        return $this;
    }

    /**
     * Static counter to generate unique ids.
     *
     * @return integer
     */
    public static function counter(): int
    {
        static $counter = 0;
        return $counter++;
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $atts = [
            'class' => 'formularium-base'
        ];
        $schemaItemScope = $this->getOption('itemscope', $m->getRenderable('itemscope', false));
        if ($schemaItemScope) {
            $atts['itemscope'] = '';
        }
        $schemaItemType = $this->getOption('itemtype', $m->getRenderable('itemtype', null));
        if ($schemaItemType) {
            $atts['itemtype'] = $schemaItemType;
            $atts['itemscope'] = '';
        }
        
        return HTMLNode::factory(
            $this->getViewableBaseTag(),
            $atts,
            join(
                '',
                array_map(function ($e) {
                    return $e->__toString();
                }, $elements)
            ),
            true
        )->__toString();
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        return join('', array_map(function ($e) {
            return $e->__toString();
        }, $elements));
    }
}
