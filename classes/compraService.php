<?php 

require_once('cliente.php');
require_once('canalComunicacao.php');

class CompraService {

     public function __construct(
        private CanalComunicacao $canalComunicacao
    ){

    }


    public function finalizarCompra(string $destinatario, string $nomeCliente): void  
    {
        $mensagem = "Olá $nomeCliente, recebemos sua compra na moveis simonetti!";

        $enviado = $this->canalComunicacao->enviarMensagem($destinatario, $mensagem);

        if($enviado) {
            echo "{$this->canalComunicacao->nome()} enviada com sucesso!";
        }
    }
}