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


namespace Library\Entity;

use Doctrine\ORM\Mapping as ORM;
use Patrimony\Entity\Patrimony;


/**
 * Faz o mapeamento objeto-relacional da tabela `book`.
 * 
 * @todo criar índice para $isbn para melhor a busca.
 * 
 * @author Márcio Dias <marciojr91@gmail.com>
 * 
 * @ORM\Table(name="book", indexes={
 *      @ORM\Index(name="book_isbn_idx", columns={"book_isbn"})
 * })
 * @ORM\Entity
 * 
 */
class Book extends Patrimony
{
    
    /**
     *
     * @var string
     * @ORM\Column(name="book_isbn", type="string", length=20, nullable=false)
     */
    private $isbn;
    
    /**
     *
     * @var string
     * @ORM\Column(name="book_description", type="string", length=300, nullable=true)
     */
    private $description;
    
    /**
     *
     * @var string
     * @ORM\Column(name="book_keywords", type="string", length=300, nullable=false)
     */
    private $keywords;
    
    /**
     *
     * @var bool
     * @ORM\Column(name="book_is_enabled", type="boolean", nullable=false)
     */
    private $isEnabled;
    
    
    public function __construct()
    {
        $this->isEnabled = false;
    }
    
    public function getBookId()
    {
        return $this->bookId;
    }
    
    
    public function getIsbn()
    {
        return $this->isbn;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }
}
