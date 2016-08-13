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

namespace Patrimony\Controller;

use Database\Controller\AbstractEntityActionController;
use Exception;
use Patrimony\Entity\Patrimony;
use Patrimony\Form\PatrimonyForm;
use Zend\View\Model\ViewModel;

/**
 * Permite manipular patrimônios.
 *
 * @author Márcio Dias <marciojr91@gmail.com>
 */
class PatrimonyController extends AbstractEntityActionController
{

    /**
     * Fornece os patrimônios cadastrados no sistema.
     * 
     * @return ViewModel Patrimônios cadastrados.
     */
    public function indexAction()
    {
        try {

            $em = $this->getEntityManager();

            $patrimonies = $em
                ->getRepository('Patrimony\Entity\Patrimony')
                ->findAll();

            return new ViewModel([
                'patrimonies' => $patrimonies,
                'message' => null,
            ]);
        } catch (Exception $ex) {
            return new ViewModel([
                'message' => $ex->getMessage(),
                'patrimonies' => null,
            ]);
        }
    }

    /**
     * Formulário de cadastro de patrimônios.
     * 
     * @return ViewModel Formulário de cadastro de patrimônio.
     */
    public function addAction()
    {
        try {
            $request = $this->getRequest();

            $em = $this->getEntityManager();
            $form = new PatrimonyForm($em);

            if ($request->isPost()) {
                $patrimony = new Patrimony();
                $form->bind($patrimony);
                $form->setData($request->getPost());

                if ($form->isValid()) {

                    $em->persist($patrimony);
                    $em->flush();

                    return $this->redirect()->toRoute('patrimony/patrimony');
                }

                return new ViewModel([
                    'form' => $form,
                    'message' => null,
                ]);
            }

            return new ViewModel([
                'form' => $form,
                'message' => null,
            ]);
        } catch (Exception $ex) {
            return new ViewModel([
                'form' => null,
                'message' => $ex->getMessage(),
            ]);
        }
    }
    
    
    /**
     * Formulário de edição de patrimônios.
     * 
     * @return ViewModel Formulário de edição de patrimônios.
     */
    public function editAction()
    {
        
        $id = $this->params('id', false);
        
        if($id === false) {
            $this->redirect()->toRoute('patrimony/patrimony');
        }
        
        try {
            
            $request = $this->getRequest();
            
            $em = $this->getEntityManager();
            $patrimony = $em->find('Patrimony\Entity\Patrimony', $id);
            
            if($patrimony === null) {
                throw new Exception('Nenhum patrimônio foi encontrado');
            }
            
            $form = new PatrimonyForm($em);
            $form->bind($patrimony);
            
            if($request->isPost()) {
                $form->setData($request->getPost());
                
                if($form->isValid()) {
                    $patrimony->setPatrimonyLastEditionDate();
                    $em->merge($patrimony);
                    $em->flush();
                    return $this->redirect()->toRoute('patrimony/patrimony');
                }
                
                return new ViewModel([
                    'form' => $form,
                    'message' => null,
                ]);
            }
            
            return new ViewModel([
                'form' => $form,
                'message' => null,
            ]);
            
        } catch (Exception $ex) {
            return new ViewModel([
                'form' => null,
                'message' => $ex->getMessage(),
            ]);
        }
    }
}
