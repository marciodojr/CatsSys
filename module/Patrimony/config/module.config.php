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

namespace Patrimony;

return [
    'controllers' => array(
        'factories' => array(
            'Patrimony\Controller\Patrimony' => Factory\Controller\PatrimonyControllerFactory::class,
        ),
    ),
    'router' => array(
        'routes' => array(
            'patrimony' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/patrimony',
                ),
                'may_terminate' => false,
                'child_routes' => array(
                    'patrimony' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/patrimony[/:action[/:id]]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Patrimony\Controller\Patrimony',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    // Doctrine configuration
    'doctrine' => array(
        'driver' => array(
            'patrimony_management_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/Patrimony/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Patrimony\Entity' => 'patrimony_management_driver',
                ),
            ),
        ),
    ),
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
                'label' => 'Patrimony',
                'uri' => '#',
                'icon' => 'fa fa-folder-o',
                'order' => 50,
                'pages' => [
                    [
                        'label' => 'Show patrimony',
                        'route' => 'patrimony/patrimony',
                        'action' => 'index',
                        'resource' => 'Patrimony\Controller\Patrimony',
                        'privilege' => 'index',
                        'icon' => 'fa fa-folder-o',
                        'toolbar' => [
                            [
                                'url' => '/patrimony/patrimony/edit/$id',
                                'id' => 'patrimony-edit',
                                'title' => 'Editar',
                                'description' => 'Edita o patrimônio selecionado',
                                'class' => 'fa fa-edit bg-green',
                                'fntype' => 'selectedHttpClick',
                            ]
                        ],
                        'pages' => [
                            [
                                'label' => 'Edit patrimony',
                                'route' => 'patrimony/patrimony',
                                'action' => 'edit',
                                'resource' => 'Patrimony\Controller\Patrimony',
                                'privilege' => 'edit',
                                'icon' => 'fa fa-folder-o',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Add patrimony',
                        'route' => 'patrimony/patrimony',
                        'action' => 'add',
                        'resource' => 'Patrimony\Controller\Patrimony',
                        'privilege' => 'add',
                        'icon' => 'fa fa-folder-o',
                    ]
                ],
            ],
        ]
    ],
];
