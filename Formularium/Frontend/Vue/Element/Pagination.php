<?php declare(strict_types=1);

namespace Formularium\Frontend\Vue\Element;

use Formularium\Element;
use Formularium\Exception\ClassNotFoundException;
use Formularium\HTMLNode;
use Formularium\Framework;
use Formularium\Metadata;
use Formularium\MetadataParameter;

class Pagination extends Element
{
    public function render(array $parameters, HTMLNode $previous): HTMLNode
    {
        $node = HTMLNode::factory(
            'nav',
            ['class' => 'formularium-pagination-wrapper', 'aria-label' => "Page navigation"],
            HTMLNode::factory(
                'ul',
                [
                    'class' => 'formularium-pagination',
                    'v-if' => 'lastPage > 1'
                ],
                [
                    HTMLNode::factory(
                        'li',
                        [
                            "class" => "formularium-pagination-item",
                            "v-show" => "currentPage > pagesAround",
                            "@click" => "\$emit('page', 1)"
                        ],
                        HTMLNode::factory(
                            'a',
                            [
                                "class" => "formularium-pagination-link",
                                ":href" => "basePath + '/1'",
                                "@click.prevent" => ""
                            ],
                            "1",
                            true
                        )
                    ),
                    HTMLNode::factory(
                        'li',
                        [
                            "class" => "formularium-pagination-item",
                            "v-show" => "currentPage > pagesAround"
                        ],
                        "...",
                        true
                    ),
                    HTMLNode::factory(
                        'li',
                        [
                            "class" => "formularium-pagination-item",
                            "v-for" => "p in pages",
                            "v-bind:key" => "p.page",
                            "@click" => "\$emit('page', p.page)"
                        ],
                        [
                            HTMLNode::factory(
                                'a',
                                [
                                    "v-if" => "p.page == currentPage",
                                    "class" => ["formularium-pagination-link", "formularium-pagination-current"],
                                    ":href" => "baseLink + p.page",
                                    "@click.prevent" => ""
                                ],
                                "{{p.page}}"
                            ),
                            HTMLNode::factory(
                                'a',
                                [
                                    "v-else" => null,
                                    "class" => "formularium-pagination-link",
                                    ":href" => "baseLink + p.page",
                                    "@click.prevent" => ""
                                ],
                                "{{p.page}}"
                            )
                        ]
                    ),
                    HTMLNode::factory(
                        'li',
                        [
                            "class" => "formularium-pagination-item",
                            "v-show" => "lastPage > currentPage + pagesAround",
                        ],
                        "..."
                    )
                ]
            )
        );

        foreach ($this->composer->getFrameworks() as $framework) {
            /**
             * @var Framework $framework
             */
            $f =$framework->getName();
            if ($f === 'HTML' || $f === 'Vue') {
                continue;
            }
            try {
                $element = $framework->getElement($this->getName(), $this->composer);
                $node = $element->render($parameters, $node);
            } catch (ClassNotFoundException $e) {
                continue; // element default
            }
        }

        return $node;
    }

    public static function script(): string
    {
        return <<<EOF
export default {
    props: {
        basePath: {
            type: String,
            default: ""
        },
        currentPage: {
            type: Number,
            required: true
        },
        perPage: {
            type: Number,
            required: true
        },
        lastPage: {
            type: Number,
            required: true
        },
        total: {
            type: Number,
            required: true
        },
        pagesAround: {
            type: Number,
            default: 4
        },
    },

    computed: {
        pages() {
            let first = Math.max(1, this.currentPage - this.pagesAround);
            let last = Math.min(this.lastPage, this.currentPage + this.pagesAround);
            let pages = [];
            for (let i = first; i <= last; i++) {
                pages.push({page: i});
            }
            return pages;
        },
        baseLink() {
            if (this.basePath.indexOf('?') === -1) {
                return this.basePath + '?page=';
            }
            return this.basePath + '&page=';
        }
    }
}
EOF;
    }

    public static function getMetadata(): Metadata
    {
        return new Metadata(
            'Pagination',
            'Creates a pagination element',
            [
            ]
        );
    }
}
