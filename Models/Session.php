<?php

// Helper: Manipulador de Sessões
class Session
{
    // Verifica da Existência de uma Sessão
    public static function exists($name) {
        return(isset($_SESSION[$name])) ? true : false;
    }

    // Cria uma Nova Sessão
    public static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    // Retorna uma Sessão
    public static function get($name) {
        return $_SESSION[$name];
    }

    // Deleta uma Sessão
    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    // Notifica Usuário e Limpa Sessão ao Atualizar
    public static function flash($name, $string = '') {
        if(self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
    }


}