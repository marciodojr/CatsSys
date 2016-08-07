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

namespace Patrimony\Form\Fieldset;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Patrimony\Entity\Patrimony;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 * Modela os atributos da entidade Patrimony\Entity\Patrimony como campos de um
 * formulário.
 *
 * @author Márcio Dias <marciojr91@gmail.com>
 */
class PatrimonyFieldset extends Fieldset implements InputFilterProviderInterface
{

    /**
     * Modela os atributos da entidade Patrimony como campos de um formulário.
     * 
     * @param ObjectManager $obj Doctrine EntityManager for hydration
     * @param string $name Nome do fieldset
     * @param array $options Opções de configuração
     */
    public function __construct(ObjectManager $obj, $name = 'patrimony', $options = array())
    {
        parent::__construct($name, $options);

        $this
            ->setHydrator(new DoctrineObject($obj))
            ->setObject(new Patrimony());

        $this
            ->add([
                'name' => 'patrimonyAlternativeId',
                'type' => 'text',
                'options' => [
                    'label' => 'Identificador',
                ],
                'attributes' => [
                    'placeholder' => 'Ex: P01EX995',
                ]
            ])
            ->add([
                'name' => 'patrimonyType',
                'type' => 'select',
                'options' => [
                    'label' => 'Tipo de Patrimônio',
                    'value_options' => Patrimony::PATRIMONY_TYPE_ARRAY,
                ]
            ])
            ->add([
                'name' => 'patrimonyStatus',
                'type' => 'select',
                'options' => [
                    'label' => 'Situação do patrimônio',
                    'value_options' => Patrimony::PATRIMONY_STATUS_ARRAY,
                ]
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getInputFilterSpecification()
    {
        return [
            'patrimonyAlternativeId' => [
                'required' => true,
            ],
            'patrimonyType' => [
                'required' => true,
            ],
            'patrimonyStatus' => [
                'required' => true,
            ]
        ];
    }
}
