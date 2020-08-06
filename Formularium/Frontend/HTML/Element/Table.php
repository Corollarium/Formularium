<?php declare(strict_types=1);

namespace Formularium\Frontend\HTML\Element;

use Formularium\Element;
use Formularium\HTMLNode;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Table extends Element
{
    const ROW_NAMES = 'rownames';
    const ROW_DATA = 'rowdata';
    const STRIPED = 'striped';
    const BORDERED = 'bordered';

    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $headrows = [];
        $footrows = [];
        if (array_key_exists(self::ROW_NAMES, $parameters)) {
            foreach ($parameters[self::ROW_NAMES] as $rowname) {
                $headrows[] = HTMLNode::factory(
                    'th',
                    [
                        'class' => 'formularium-table__th'
                    ],
                    $rowname
                );
                $footrows[] = HTMLNode::factory(
                    'th',
                    [
                        'class' => 'formularium-table__th'
                    ],
                    $rowname
                );
            }
        }

        $rowdata = [];
        if (array_key_exists(self::ROW_DATA, $parameters)) {
            foreach ($parameters[self::ROW_DATA] as $data) {
                $rowdata[] = HTMLNode::factory(
                    'tr',
                    [
                        'class' => 'formularium-table__td'
                    ],
                    array_map(
                        function ($i) {
                            return HTMLNode::factory('td', [], $i);
                        },
                        $data
                    )
                );
            }
        }

        return HTMLNode::factory(
            'table',
            [
                'class' => 'formularium-table'
            ],
            [
                HTMLNode::factory(
                    'thead',
                    ['class' => 'formularium-table__head'],
                    HTMLNode::factory(
                        'tr',
                        ['class' => 'formularium-table__headrow'],
                        $headrows
                    )
                ),
                HTMLNode::factory(
                    'tfoot',
                    ['class' => 'formularium-table__foot'],
                    HTMLNode::factory(
                        'tr',
                        ['class' => 'formularium-table__footrow'],
                        $footrows
                    )
                ),
                HTMLNode::factory(
                    'tbody',
                    ['class' => 'formularium-table__body'],
                    $rowdata
                )
            ]
        );
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Table',
            'Creates a table',
            [
                new MetadataParameter(
                    static::ROW_NAMES,
                    'array',
                    'Is it disabled?'
                ),
                new MetadataParameter(
                    static::STRIPED,
                    'bool',
                    'Is this table striped?'
                ),
                new MetadataParameter(
                    static::BORDERED,
                    'bool',
                    'Is this table bordered?'
                )
            ]
        );
    }
}
