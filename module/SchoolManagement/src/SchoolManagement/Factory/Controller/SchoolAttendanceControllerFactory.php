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

namespace SchoolManagement\Factory\Controller;

use SchoolManagement\Controller\SchoolAttendanceController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Instancia o controller SchoolAttendanceController e injeta o EntityManager e  DbalConnection
 *
 * @author Márcio Dias <marciojr91@gmail.com>
 */
class SchoolAttendanceControllerFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {


        $sl = $serviceLocator->getServiceLocator();
        $controller = new SchoolAttendanceController($sl->get('ViewRenderer'));
        $em = $sl->get('Doctrine\ORM\EntityManager');
        $conn = $sl->get('doctrine.connection.orm_default');

        $controller->setEntityManager($em);
        $controller->setDbalConnection($conn);

        return $controller;
    }

}
