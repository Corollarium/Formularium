<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Renderable;

use Formularium\Field;
use Formularium\HTMLNode;

class Renderable_cnpj extends Renderable_string
{
    public const MAX_STRING_SIZE = 18;
}
