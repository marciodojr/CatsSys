<?php

/*
 * Copyright (C) 2016 Gabriel Pereira <rickardch@gmail.com>
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

namespace FinancialManagement\Factory\Controller;

use FinancialManagement\Controller\CashFlowController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Cria uma instância do controller CashFlowController e injeta o EntityManager
 *
 * @author Gabriel Pereira <rickardch@gmail.com>
 */
class CashFlowControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $controller = new CashFlowController();
        $sl = $serviceLocator->getServiceLocator();
        $em = $sl->get('Doctrine\ORM\EntityManager');

        $controller->setEntityManager($em);

        return $controller;
    }
}
