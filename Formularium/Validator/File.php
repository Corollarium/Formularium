<?php declare(strict_types=1);

namespace Formularium\Validator;

use Formularium\Datatype;
use Formularium\Exception\ValidatorException;
use Formularium\Model;
use Formularium\ValidatorArgs;
use Formularium\ValidatorInterface;
use Formularium\ValidatorMetadata;

/**
 * File validation
 */
class File implements ValidatorInterface
{
    const MAX_SIZE = 'maxSize';

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

    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        $max_size = $options[self::MAX_SIZE] ?? 0;
        if ($max_size > 0 && filesize($value) > $max_size) {
            throw new ValidatorException(
                'File too big. Maximum size: ' . $max_size
            );
        }

        if ($options[self::ACCEPT] ?? false) {
            $accept = $options[self::ACCEPT];
            if (!is_array($accept)) {
                $accept = [$accept];
            }

            /**
             * @var array $accept
             */
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if ($finfo === false) {
                throw new ValidatorException(
                    'Cannot load fileinfo'
                );
            }
            $mime = finfo_file($finfo, $value);

            $valid = false;
            foreach ($accept as $a) {
                switch ($a) {
            case self::ACCEPT_AUDIO:
                $validMimes = [
                    'audio/aac',
                    'audio/mpeg',
                    'audio/ogg',
                    'audio/wav',
                    'audio/webm',
                ];
                if (in_array($mime, $validMimes)) {
                    $valid = true;
                    break;
                }
            break;
            case self::ACCEPT_IMAGE:
                $validMimes = [
                    'image/jpg',
                    'image/jpeg',
                    'image/gif',
                    'image/png',
                    'image/webp'
                ];
                if (in_array($mime, $validMimes)) {
                    $valid = true;
                    break;
                }
            break;
            case self::ACCEPT_VIDEO:
                $validMimes = [
                    'video/x-flv',
                    'video/mp4',
                    'video/mpeg',
                    'application/x-mpegURL',
                    'video/MP2T',
                    'video/3gpp',
                    'video/ogg',
                    'video/quicktime',
                    'video/x-msvideo',
                    'video/x-ms-wmv',
                    'video/webm',
                ];
                if (in_array($mime, $validMimes)) {
                    $valid = true;
                    break;
                }
            break;
        }
            }

            // TODO: 'accept' extensions

            if (!$valid) {
                throw new ValidatorException(
                    'Not an accepted file'
                );
            }
        }

        if (($options[self::DIMENSION_HEIGHT] ?? false) ||
            ($options[self::DIMENSION_WIDTH] ?? false) ||
            ($options[self::DIMENSION_MIN_HEIGHT] ?? false) ||
            ($options[self::DIMENSION_MIN_WIDTH] ?? false) ||
            ($options[self::DIMENSION_MAX_HEIGHT] ?? false) ||
            ($options[self::DIMENSION_MAX_WIDTH] ?? false) ||
            ($options[self::DIMENSION_RATIO] ?? false)
        ) {
            $imageData = getimagesize($value);
            if ($imageData === false) {
                throw new ValidatorException(
                    'Not an image'
                );
            }
            $width = $imageData[0];
            $height = $imageData[1];

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

        return $value;
    }

    public static function getMetadata(): ValidatorMetadata
    {
        return new ValidatorMetadata(
            'File',
            "File validations.",
            [
                new ValidatorArgs(
                    self::MAX_SIZE,
                    'Integer',
                    'Maximum file size in bytes'
                )
                // TODO: missing args
            ]
        );
    }
}
