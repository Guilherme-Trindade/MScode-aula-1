<?php

class Produto {

    public function __construct(
        protected int $id,
        readonly string $nome,
        readonly string $descricao,
        readonly float $preco,
        readonly string $categoria,
        readonly string $imagem,
        readonly int $estoque

    ){

    }

    public function getId(): int 
    {
        return $this->id;
    }
    
    public function getPreco(): string 
    {
        return $this->preco;
    }

    public function getDescricao(): string 
    {
        return $this->descricao;
    }

    public function getCategoria(): string 
    {
        return $this->categoria;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    
    public function getEstoque(): string
    {
        return $this->estoque;
    }

    /*
    public function vender(int $quantidade)
    {
        if ($this->quantidade >= $quantidade) {
            $this->quantidade -= $quantidade;
            // $this->quantidade = $this->quantidade - $quantidade;

        } else {
            throw new Exception("Quantidade Insuficiente pra compra", 500);
            
        }
    }

    public function apresentar(): void
    {
        echo $this->nome . PHP_EOL;
    }

    */
}