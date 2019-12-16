<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use HTMLPurifier;
use HTMLPurifier_Config;

class Datatype_html extends Datatype_string
{
    protected $MAX_STRING_SIZE = 1024000;

    public function __construct(string $typename = 'html', string $basetype = 'text')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return static::faker()->randomHtml();
    }

    public function validate($value, Field $field)
    {
        $value = parent::validate($value, $field);
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core', 'DefinitionCache', null);
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($value);
        return $clean_html;
    }
}
