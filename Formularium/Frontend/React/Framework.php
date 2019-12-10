<?php

namespace Formularium\Frontend\React;

use Formularium\HTMLElement;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'React')
    {
        parent::__construct($name);
    }

    public function htmlHead(HTMLElement &$head)
    {
        $head->prependContent([
            HTMLElement::factory('script', ['src' => "https://unpkg.com/react@16/umd/react.development.js", 'crossorigin' => '']),
            HTMLElement::factory('script', ['src' => "https://unpkg.com/react-dom@16/umd/react-dom.development.js", 'crossorigin' => '']),
            HTMLElement::factory('script', ['src' => "https://unpkg.com/babel-standalone@6/babel.min.js", 'crossorigin' => ''])
        ]);
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose): string
    {
        $data = [];
        foreach ($m->getFields() as $name => $field) {
            $data[$name] = $field->getDatatype()->getDefault();
        }

        $editableForm = join('', $elements);
        $editableForm = str_replace('"{this.handleInputChange}"', '{this.handleInputChange}', $editableForm);
        $editableForm = preg_replace(
            '/value="\{this.state.([a-zA-Z0-9_]+)\}"/',
            'value={this.state.$1}',
            $editableForm
        );
        
        $jsonData = json_encode($data);

        $id = 'reactapp';
        $component = $m->getName() . 'Component';
        $reactCode = <<<EOF
'use strict';

const e = React.createElement;

class {$component} extends React.Component {
    constructor(props) {
        super(props);
        this.state = $jsonData;
   
        this.handleInputChange = this.handleInputChange.bind(this);
    }
    
    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;
    
        this.setState({
            [name]: value
        });
    }
    
    render() {
        return (
        <form>
            $editableForm
        </form>
        );
    }
}

const domContainer = document.querySelector('#{$id}');
ReactDOM.render(e($component), domContainer);
EOF;

        $t = new HTMLElement('div', ['id' => $id]);
        $s = new HTMLElement('script', ['type' => "text/babel"], $reactCode, true);
        return HTMLElement::factory('', [], [$t, $s])->getRenderHTML();
    }
}
