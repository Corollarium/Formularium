<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use HTMLPurifier;
use HTMLPurifier_Config;

class Datatype_html extends Datatype_text
{
    protected $MAX_STRING_SIZE = 1024000;

    public function __construct(string $typename = 'html', string $basetype = 'text')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return '<p>HTML <span>' . parent::getRandom() . '</span>' . parent::getRandom() . '</p>';
    }

    public function validate($value, array $validators = [], Model $model = null)
    {
        $text = iconv("UTF-8", "UTF-8//IGNORE", (string)$value);
        if ($text === false) {
            throw new \Formularium\Exception\ValidatorException('Invalid encoding in string.');
        }

        if (array_key_exists(static::MIN_LENGTH, $validators)) {
            if (mb_strlen($text) < $validators[self::MIN_LENGTH]) {
                throw new \Formularium\Exception\ValidatorException('String is too short.');
            }
        }
        $maxlength = $validators[static::MAX_LENGTH] ?? $this->MAX_STRING_SIZE;
        if (mb_strlen($text) > $maxlength) {
            throw new \Formularium\Exception\ValidatorException('String is too long.');
        }

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Cache.DefinitionImpl', null);
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($text);
        return $clean_html;
    }
}
