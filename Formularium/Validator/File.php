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

    protected static function size(string $value, array $options = []): void
    {
        $max_size = $options[self::MAX_SIZE] ?? 0;
        if ($max_size > 0 && filesize($value) > $max_size) {
            throw new ValidatorException(
                'File too big. Maximum size: ' . $max_size
            );
        }
    }

    protected static function accept(string $value, array $options = []): void
    {
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

    public static function validate($value, array $options = [], Datatype $datatype, ?Model $model = null)
    {
        if ($datatype->getBasetype() !== 'file') {
            throw new ValidatorException(
                'Not a file'
            );
        }

        self::size($value, $options);

        if ($options[self::ACCEPT] ?? false) {
            self::accept($value, $options);
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
                    'Int',
                    'Maximum file size in bytes'
                ),
                new ValidatorArgs(
                    self::ACCEPT,
                    '[String]',
                    'Acceptable types'
                )
            ]
        );
    }
}
