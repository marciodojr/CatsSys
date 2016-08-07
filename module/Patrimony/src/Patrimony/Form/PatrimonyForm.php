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

namespace Patrimony\Form;

use Doctrine\Common\Persistence\ObjectManager;
use Patrimony\Form\Fieldset\PatrimonyFieldset;
use Zend\Form\Form;

/**
 * Formulário para cadastro e edição de patrimônios.
 *
 * @author Márcio Dias <marciojr91@gmail.com>
 */
class PatrimonyForm extends Form
{
    public function __construct(ObjectManager $obj, $name = null, $options = array())
    {
        parent::__construct($name, $options);
        
        $fieldset = new PatrimonyFieldset($obj);
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);
        
        $this->add([
            'name' => 'save',
            'type' => 'submit',
            'options' => [
                'label' => 'Salvar',
            ],
            'attributes' => [
                'class' => 'btn-primary btn-block btn-flat',
            ]
        ]);        
    }
}
