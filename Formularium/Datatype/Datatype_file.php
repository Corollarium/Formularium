<?php declare(strict_types=1);

namespace Formularium\Datatype;

use Formularium\Field;
use Formularium\Model;
use Formularium\Exception\ValidatorException;

class Datatype_file extends \Formularium\Datatype
{
    const MAX_SIZE = 'MAX_SIZE';

    /**
     * Key for extension. Value can be array or string.
     */
    const ACCEPT = 'accept';
    const ACCEPT_AUDIO = 'audio/*';
    const ACCEPT_IMAGE = 'image/*';
    const ACCEPT_VIDEO = 'video/*';

    const DIMENSION_WIDTH = 'DIMENSION_WIDTH';
    const DIMENSION_HEIGHT = 'DIMENSION_HEIGHT';
    const DIMENSION_MIN_WIDTH = 'DIMENSION_MIN_WIDTH';
    const DIMENSION_MAX_WIDTH = 'DIMENSION_MAX_WIDTH';
    const DIMENSION_MIN_HEIGHT = 'DIMENSION_MIN_HEIGHT';
    const DIMENSION_MAX_HEIGHT = 'DIMENSION_MAX_HEIGHT';
    const DIMENSION_RATIO = 'DIMENSION_RATIO';

    public function __construct(string $typename = 'file', string $basetype = 'file')
    {
        parent::__construct($typename, $basetype);
    }

    public function getRandom(array $params = [])
    {
        return '';
    }

    public function validate($value, Field $field, Model $model = null)
    {
        $validators = $field->getValidators();

        // $file =
        $max_size = $field->getValidator(self::MAX_SIZE, 0);
        if ($max_size) {
            // TODO
        }

        if ($validators[Datatype_file::ACCEPT] ?? false) {
            // TODO if ()
        }

        $isImage = false;
        if ($isImage) {
            $width = 0;
            $height = 0;

            if ($field->getValidator(self::DIMENSION_HEIGHT, false) !== false) {
                if ($field->getValidator(self::DIMENSION_HEIGHT, false) !== $height) {
                    throw new ValidatorException(
                        'Image height should be exactly ' . $field->getValidator(self::DIMENSION_HEIGHT, false)
                    );
                }
            }

            if ($field->getValidator(self::DIMENSION_WIDTH, false) !== false) {
                if ($field->getValidator(self::DIMENSION_WIDTH, false) !== $width) {
                    throw new ValidatorException(
                        'Image width should be exactly ' . $field->getValidator(self::DIMENSION_WIDTH, false)
                    );
                }
            }

            if ($field->getValidator(self::DIMENSION_MIN_HEIGHT, false) !== false) {
                if ($height < $field->getValidator(self::DIMENSION_MIN_HEIGHT, false)) {
                    throw new ValidatorException(
                        'Image height should be at least ' . $field->getValidator(self::DIMENSION_MIN_HEIGHT, false)
                    );
                }
            }

            if ($field->getValidator(self::DIMENSION_MIN_WIDTH, false) !== false) {
                if ($width < $field->getValidator(self::DIMENSION_MIN_WIDTH, false)) {
                    throw new ValidatorException(
                        'Image width should be at least ' . $field->getValidator(self::DIMENSION_MIN_WIDTH, false)
                    );
                }
            }

            if ($field->getValidator(self::DIMENSION_MAX_HEIGHT, false) !== false) {
                if ($height > $field->getValidator(self::DIMENSION_MAX_HEIGHT, false)) {
                    throw new ValidatorException(
                        'Image height should be at most ' . $field->getValidator(self::DIMENSION_MAX_HEIGHT, false)
                    );
                }
            }

            if ($field->getValidator(self::DIMENSION_MAX_WIDTH, false) !== false) {
                if ($width > $field->getValidator(self::DIMENSION_MAX_WIDTH, false)) {
                    throw new ValidatorException(
                        'Image width should be at most ' . $field->getValidator(self::DIMENSION_MAX_WIDTH, false)
                    );
                }
            }

            if ($field->getValidator(self::DIMENSION_RATIO, false) !== false) {
                $ratio = $width/$height;
                $expected = $field->getValidator(self::DIMENSION_RATIO, false);
                if (abs(($ratio-$expected)/$expected) > 0.0001) {
                    throw new ValidatorException(
                        'Image width/height ratio should be ' . $field->getValidator(self::DIMENSION_RATIO, false)
                    );
                }
            }
        }

        return $value;
    }
}
