<?php declare(strict_types=1);

namespace Formularium\Frontend\HTMLValidation;

use Formularium\FrameworkComposer;

class Framework extends \Formularium\Framework
{
    public function __construct(string $name = 'HTMLValidation')
    {
        parent::__construct($name);
    }

    public function viewableCompose(\Formularium\Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return $previousCompose;
    }

    public function editableCompose(\Formularium\Model $m, array $elements, string $previousCompose, FrameworkComposer $composer): string
    {
        return $previousCompose;
    }
}
