<?php

namespace JP\Sistema\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="Produto")
 */
class ProdutoEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="seq_produto")
     * @ORM\GeneratedValue
     */
    private $id;
     /**
     * @ORM\Column(type="string", name="nom_produto", length=100)
     */
    private $nome;
      /**
     * @ORM\Column(type="text", name="des_produto")
     */
    private $descricao;
     /**
     * @ORM\Column(type="decimal", precision=10, scale=2, name="val_produto")
     */
    private $valor;
    /**
     * @ORM\ManyToOne(targetEntity="CategoriaEntity")
     * @ORM\JoinColumn(name="seq_categoria", referencedColumnName="seq_categoria")
     */
    private $categoria;
    /**
     * @ORM\ManyToMany(targetEntity="TagEntity")
     * @ORM\JoinTable(name="produto_tag",
     *      joinColumns={@ORM\JoinColumn(name="seq_produto", referencedColumnName="seq_produto")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="seq_tag", referencedColumnName="seq_tag")}
     *      )
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        if (empty($nome)) {
            throw new \InvalidArgumentException();
        }
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        if (empty($descricao)) {
            throw new \InvalidArgumentException('Descrição não informada', 1);
        }
        $this->descricao = $descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        if (!is_numeric($valor)) {
            throw new \InvalidArgumentException('Valor não é numérico', 2);
        }
        $this->valor = $valor;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        if (empty($categoria)) {
            throw new \InvalidArgumentException('Categoria não informada', 3);
        }
        $this->categoria = $categoria;
    }

    public function addTag($tag)
    {
        $this->tags->add($tag);
        return $this;
    }

    public function getTag()
    {
        return $this->tags;
    }
}
