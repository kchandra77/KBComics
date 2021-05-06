<?php 

namespace App\Classe;

use App\Entity\Genre;

class Search
{

    /**
     * @var string
     */

    public $string = '';

     /**
     * @var Genre[]
     */
    public $categories = [];

     /**
     * @var Auteur[]
     */
    public $author = [];

     /**
     * @var Editeur[]
     */
    public $editor = [];

    public function __toString() {
        return $this->string;
    }
}