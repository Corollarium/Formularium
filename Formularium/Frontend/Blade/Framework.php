<?php declare(strict_types=1);

namespace Formularium\Frontend\Blade;

use Formularium\HTMLNode;
use Formularium\Model;

class Framework extends \Formularium\Framework
{
    /**
     * The viewable template.
     *
     * @var string
     */
    protected $viewableTemplate = '';

    /**
     * @var string
     */
    protected $editableTemplate = '';

    public function __construct(string $name = 'Blade')
    {
        parent::__construct($name);

        $this->editableTemplate = <<<EOF
{!! Form::open(['route' => '{{modelName}}.store']) !!}

{{form}}

{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

{!! Form::close() !!}
EOF;
    }

    public function editableCompose(Model $m, array $elements, string $previousCompose): string
    {
        $editableForm = join('', $elements);
        $templateData = [
            'form' => $editableForm,
        ];
   
        return $this->fillTemplate(
            $this->editableTemplate,
            $templateData,
            $m
        );
    }

    protected function fillTemplate(string $template, array $data, Model $m): string
    {
        foreach ($data as $name => $value) {
            $template = str_replace(
                '{{' . $name . '}}',
                $value,
                $template
            );
        }

        $template = str_replace(
            '{{modelName}}',
            $m->getName(),
            $template
        );
        $template = str_replace(
            '{{modelNameLower}}',
            mb_strtolower($m->getName()),
            $template
        );
        return $template;
    }
}
