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

    /**
     *
     * @param string $value The path to the file to be validated. Might be a temporary path.
     * @param Field $field
     * @param Model $model
     * @return void
     */
    public function validate($value, Field $field, Model $model = null)
    {
        $validators = $field->getValidators();

        // $file =
        $max_size = $field->getValidator(self::MAX_SIZE, 0);
        if ($max_size > 0 && filesize($value) > $max_size) {
            throw new ValidatorException(
                'File too big. Maximum size: ' . $max_size
            );
        }

        if ($validators[Datatype_file::ACCEPT] ?? false) {
            $accept = $validators[Datatype_file::ACCEPT];
            if (!is_array($accept)) {
                $accept = [$accept];
            }
            $valid = false;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $value);
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

        $isImage = false;
        if ($isImage) {
            $imageData = getimagesize($value);
            if ($imageData === false) {
                throw new ValidatorException(
                    'Not an image'
                );
            }
            $width = $imageData[0];
            $height = $imageData[1];

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
                if (!$width || !$height) {
                    throw new ValidatorException(
                        'Zero width or height'
                    );
                }
                $ratio = $width/$height;
                $expected = $field->getValidator(self::DIMENSION_RATIO, false);
                if (abs(($ratio-$expected)/$expected) > 0.0001) {
                    throw new ValidatorException(
                        'Image width/height ratio should be ' . $field->getValidator(self::DIMENSION_RATIO, false)
                    );
                }
            }
        }
        */

        return $value;
    }
}
