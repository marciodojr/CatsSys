<?php
/*
 * Copyright (C) 2016 Márcio Dias <marciojr91@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Library;

return [
    'controllers' => [
        'factories' => [
            'Library\Controller\Book' => Factory\Controller\BookControllerFactory::class,
        ]
    ],
    'router' => [
        'routes' => [
            'library' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/library',
                ],
                // /library <ENTER> --> rota não existe
                'may_terminate' => false,
                // /library/book
                'child_routes' => [
                    'book' => [
                        'type' => 'Segment',
                        'options' => [
                            // /library/book --> /library/book/index
                            // /library/book/add
                            // /library/book/edit/1
                            'route' => '/book[/:action[/:id]]',
                            'constraints' => [
                                // add
                                // add2345
                                // add3_a-b
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                // 1
                                // 11
                                // 11111...
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Library\Controller\Book',
                                'action' => 'index',
                            ]
                        ],
                    ]
                ]
            ]
        ]
    ],
    'doctrine' => [
        'driver' => [
            'library_management_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Library/Entity',
                ],
            ],
            'orm_default' => array(
                'drivers' => array(
                    'Library\Entity' => 'library_management_driver',
                ),
            ),
        ]
    ],
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/',
        ),
        'template_map' => array(
        ),
        'display_exceptions' => true,
    ),
    'navigation' => [
        'default' => [
            [
                'label' => 'Library',
                'uri' => '#',
                'icon' => 'fa fa-server',
                'order' => 7,
                'pages' => [
                    [
                        'label' => 'Borrowing',
                        'route' => 'library/book',
                        'action' => 'index',
                        'resource' => 'Library\Controller\Book',
                        'privilege' => 'index',
                        'icon' => 'fa fa-server',
                    ]
                ]
            ]
        ]
    ],
];
