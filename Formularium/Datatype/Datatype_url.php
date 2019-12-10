<?php

namespace Formularium\Datatype;

use Formularium\Exception\ValidatorException;
use Formularium\Field;
use Respect\Validation\Validator;

class Datatype_url extends \Formularium\Datatype
{
    public function __construct(string $typename = 'url', string $basetype = 'url')
    {
        parent::__construct($typename, $basetype);
    }
    
    public function getRandom(array $params = [])
    {
        return static::faker()->url;
    }

    public function validate($value, Field $f)
    {
        $value = trim($value);
        $this->validateURL($value);
        return $value;
    }

    /**
     * Undocumented function
     *
     * @param string $value
     * @throws ValidatorException
     * @return void
     */
    public function validateURL($value)
    {
        if ($value == 'http://' || $value == 'https://' || $value == '') {
            return true;
        }
    
        $protocol = mb_strtolower(mb_substr($value, 0, 8));
        if (substr($protocol, 0, 7) !== 'http://' && substr($protocol, 0, 8) !== 'https://') {
            if (mb_stripos($value, '://') !== false) {
                throw new ValidatorException('Invalid url');
            } elseif (preg_match('/^([A-Za-z0-9]+):/', $value)) {
                throw new ValidatorException('Invalid url');
            } else {
                $value = 'http://' . $value;
            }
        } else {
            // lowercase protocol or validate uri will spit it out
            $value[0] = 'h';
            $value[1] = 't';
            $value[2] = 't';
            $value[3] = 'p';
            if ($value[4] == 'S') {
                $value[4] = 's';
            }
        }
    
        $parsed = parse_url($value);
        if ($parsed && array_key_exists('path', $parsed)) {
            $parsed['path'] = str_replace('%2F', '/', urlencode(utf8_encode($parsed['path'])));
        }
    
        $validurl = Validator::arrayVal()
            ->key('scheme', Validator::startsWith('http'))
            ->key('host', Validator::domain(false))
            // not required ->key('path',   Validator::string())
            // not required ->key('query',  Validator::notEmpty())
            ->validate($parsed);
        if (!$validurl) {
            throw new ValidatorException('Invalid url');
        }
    }
}
