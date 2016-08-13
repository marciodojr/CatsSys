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

namespace Patrimony\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faz o mapeamento objeto-relacional da tabela patrimony.
 *
 * @author Márcio Dias <marciojr91@gmail.com>
 * 
 * @ORM\Table(name="patrimony")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="patrimony_discr", type="string")
 */
class Patrimony
{

    /**
     * @var int
     * @ORM\Column(name="patrimony_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $patrimonyId;

    /**
     * @var string
     * @ORM\Column(name="patrimony_alternative_id", type="string", length=30, nullable=false, unique=true)
     */
    private $patrimonyAlternativeId;

    /**
     * @var \DateTime
     * @ORM\Column(name="patrimony_registration_date", type="datetime", nullable=false)
     */
    private $patrimonyRegistrationDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="patrimony_last_edition_date", type="datetime", nullable=true)
     */
    private $patrimonyLastEditionDate;

    const PATRIMONY_TYPE_ARRAY = [
        'LIVRO',
        'MATERIAL DE ESCRITÓRIO',
        'ELETRÔNICO',
    ];

    /**
     * @var string
     * @ORM\Column(name="patrimony_type", type="string", length=30, nullable=false)
     */
    private $patrimonyType;

    const PATRIMONY_STATUS_ARRAY = [
        'ATIVO',
        'EXTRAVIADO',
        'DOADO'
    ];

    /**
     * @var string
     * @ORM\Column(name="patrimony_status", type="string", length=30, nullable=false)
     */
    private $patrimonyStatus;

    /**
     * Construtor. Define a data de registro do patrimônio.
     */
    public function __construct()
    {
        $this->patrimonyRegistrationDate = new \DateTime();
    }

    /**
     * Retornado o identificador gerado pelo sistema.
     * @return int Identificador do patrimonio gerado pelo sistema
     */
    public function getPatrimonyId()
    {
        return $this->patrimonyId;
    }

    /**
     * Retorna o identificador definido pelo usuário
     * @return string Identificador definido pelo usuário.
     */
    public function getPatrimonyAlternativeId()
    {
        return $this->patrimonyAlternativeId;
    }

    /**
     * Retorna oa data de cadastro do patrimônio.
     * @param string $format Formato válido para o \DateTime.
     * @return string Data no formato $format.
     */
    public function getPatrimonyRegistrationDate($format = null)
    {
        if ($format === null) {
            return $this->patrimonyRegistrationDate->format('d/m/Y H:i:s');
        }

        return $this->patrimonyRegistrationDate->format($format);
    }

    /**
     * Retorna a última data de edição do patrimônio.
     * @param string $format Formato válido para o \DateTime.
     * @return null|string Data no formato $format.
     */
    public function getPatrimonyLastEditionDate($format = null)
    {
        if ($this->patrimonyLastEditionDate !== null) {
            if ($format !== null) {
                return $this->patrimonyLastEditionDate->format($format);
            }

            return $this->patrimonyLastEditionDate->format('d/m/Y H:i:s');
        }

        return null;
    }

    /**
     * Returna o tipo de patrimônio.
     * @return string Tipo de patrimônio.
     */
    public function getPatrimonyType()
    {
        return $this->patrimonyType;
    }

    /**
     * Retorna a situação do patrimônio.
     * @return string Situação do patrimônio.
     */
    public function getPatrimonyStatus()
    {
        return $this->patrimonyStatus;
    }

    /**
     * Define o valor do identificador alternativo para o patrimônio.
     * 
     * @param int $patrimonyAlternativeId Identificador escolhido pelo usuário.
     * @return \Patrimony\Entity\Patrimony Permite o usuo de interface fluente.
     */
    public function setPatrimonyAlternativeId($patrimonyAlternativeId)
    {
        $this->patrimonyAlternativeId = $patrimonyAlternativeId;
        return $this;
    }

    /**
     * Define a data da última edição do patrimônio. Caso nenhuma data seja informada
     * utiliza a data atual.
     * @param \DateTime $d Data de edição or null.
     * @return \Patrimony\Entity\Patrimony Permite o usuo de interface fluente.
     */
    public function setPatrimonyLastEditionDate(\DateTime $d = null)
    {
        $this->patrimonyLastEditionDate = $d === null ? new \DateTime() : $d;
        return $this;
    }

    /**
     * Define o tipo do patrimônio.
     * @param int $index Índice do tipo do patrimônio
     * @return \Patrimony\Entity\Patrimony Permite o usuo de interface fluente.
     */
    public function setPatrimonyType($index)
    {
        $this->patrimonyType = self::PATRIMONY_TYPE_ARRAY[$index];
        return $this;
    }

    /**
     * Define a situação do patrimônio.
     * @param int $index Índice da situação do patrimônio
     * @return \Patrimony\Entity\Patrimony Permite o usuo de interface fluente.
     */
    public function setPatrimonyStatus($index)
    {
        $this->patrimonyStatus = self::PATRIMONY_STATUS_ARRAY[$index];
        return $this;
    }
}
