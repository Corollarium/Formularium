<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorArgs;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;

/**
 * Image file validation
 */
class Image implements ValidatorInterface
{
    const DIMENSION_WIDTH = 'dimensionWidth';
    const DIMENSION_HEIGHT = 'dimensionHeight';
    const DIMENSION_MIN_WIDTH = 'dimensionMinWidth';
    const DIMENSION_MAX_WIDTH = 'dimensionMaxWidth';
    const DIMENSION_MIN_HEIGHT = 'dimensionMinHeight';
    const DIMENSION_MAX_HEIGHT = 'dimensionMaxHeight';
    const DIMENSION_RATIO = 'dimensionRatio';

    protected static function dimension(array $options = [], int $width, int $height): void
    {
        $expectedHeight = $options[self::DIMENSION_HEIGHT] ?? false;
        if ($expectedHeight !== false) {
            if ($expectedHeight !== $height) {
                throw new ValidatorException(
                    'Image height should be exactly ' . $options[self::DIMENSION_HEIGHT] ?? false
                );
            }
        }

        $expectedWidth = $options[self::DIMENSION_WIDTH] ?? false;
        if ($expectedWidth !== false) {
            if ($expectedWidth !== $width) {
                throw new ValidatorException(
                    'Image width should be exactly ' . $expectedWidth
                );
            }
        }

        $minHeight = $options[self::DIMENSION_MIN_HEIGHT] ?? false;
        if ($minHeight !== false) {
            if ($height < $minHeight) {
                throw new ValidatorException(
                    'Image height should be at least ' . $minHeight
                );
            }
        }

        $minWidth = $options[self::DIMENSION_MIN_WIDTH] ?? false;
        if ($minWidth !== false) {
            if ($width < $minWidth) {
                throw new ValidatorException(
                    'Image width should be at least ' . $minWidth
                );
            }
        }

        $maxHeight = $options[self::DIMENSION_MAX_HEIGHT] ?? false;
        if ($maxHeight !== false) {
            if ($height > $maxHeight) {
                throw new ValidatorException(
                    'Image height should be at most ' . $maxHeight
                );
            }
        }

        $maxWidth = $options[self::DIMENSION_MAX_WIDTH] ?? false;
        if ($maxWidth !== false) {
            if ($width > $maxWidth) {
                throw new ValidatorException(
                    'Image width should be at most ' . $maxWidth
                );
            }
        }

        $ratio = $options[self::DIMENSION_RATIO] ?? false;
        if ($ratio !== false) {
            if (!$width || !$height) {
                throw new ValidatorException(
                    'Zero width or height'
                );
            }
            $ratio = $width/$height;
            $expected = $ratio;
            if (abs(($ratio-$expected)/$expected) > 0.0001) {
                throw new ValidatorException(
                    'Image width/height ratio should be ' . $ratio
                );
            }
        }
    }

    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if ($datatype->getBasetype() !== 'file') {
            throw new ValidatorException(
                'Not a file'
            );
        }
    
        $imageData = getimagesize($value);
        if ($imageData === false) {
            throw new ValidatorException(
                'Not an image'
            );
        }

        if (($options[self::DIMENSION_HEIGHT] ?? false) ||
                ($options[self::DIMENSION_WIDTH] ?? false) ||
                ($options[self::DIMENSION_MIN_HEIGHT] ?? false) ||
                ($options[self::DIMENSION_MIN_WIDTH] ?? false) ||
                ($options[self::DIMENSION_MAX_HEIGHT] ?? false) ||
                ($options[self::DIMENSION_MAX_WIDTH] ?? false) ||
                ($options[self::DIMENSION_RATIO] ?? false)
            ) {
            $width = $imageData[0];
            $height = $imageData[1];
            static::dimension($options, $width, $height);
        }
        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'Image',
            "Image file validations.",
            [
                new ValidatorArgs(
                    self::DIMENSION_RATIO,
                    'Float',
                    'The expected ratio (width/height)'
                )
                // TODO: missing args
            ]
        );
    }
}
