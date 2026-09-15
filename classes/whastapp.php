<?php 

class Whatsapp implements CanalComunicacao {

    public function enviarMensagem(string $destinatario, string $mensagem): bool
    {
        // chamar a api da neta ($destinario)
        return true;
    }

        
    public function nome(): string 
    {
        return 'Whatsapp';
    }
}