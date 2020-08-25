<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Formularium\Model;
use HTMLPurifier;
use HTMLPurifier_Config;

class Datatype_html extends Datatype_text
{
    protected $MAX_STRING_LENGTH = 1024000;

    public function __construct(string $typename = 'html', string $basetype = 'text')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return '<p>HTML <span>' . parent::getRandom() . '</span>' . parent::getRandom() . '</p>';
    }

    public function validate($value, Model $model = null)
    {
        if (!is_string($value)) {
            throw new ValidatorException('Invalid HTML value');
        }

        $text = iconv("UTF-8", "UTF-8//IGNORE", (string)$value);
        if ($text === false) {
            throw new \Formularium\Exception\ValidatorException('Invalid encoding in string.');
        }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.DefinitionImpl', null);
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($text);

        return $clean_html;
    }

    public function getDocumentation(): string
    {
        return 'HTML, validated and sanitized with HTMLPurifier.';
    }
}
