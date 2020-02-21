<?php

class DB
{
    private static $_instance = null;
    private $_pdo,
    $_query,
    $_error,
    $_results,
    $_last_id,
    $_count = 0;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db') . ';charset=utf8', Config::get('mysql/username'), Config::get('mysql/password'));
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //$this->_pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;

        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function action($action, $table, $where = array())
    {
        if (count($where) == 3) {
            $operators = array('=', '>', '<', '>=', '<=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
            return false;
        }
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array())
    {
        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach ($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table}(" . implode(', ', $keys) . ") VALUES({$values})";

        if (!$this->query($sql, $fields)->error()) {
            $this->_last_id = $this->_pdo->lastInsertId();
            return true;
        } else {
            return false;
        }

    }

    public function updateTransacaoCli($table, $id, $fields = array())
    {
        $set = '';
        $x = 1;

        foreach ($fields as $field => $value) {
            $set .= "{$field} = ?";
            if ($x < count($fields)) {
                $set .= ", ";
            }
        }

        $sql = "UPDATE {$table} SET {$set} WHERE serial_leitor = '{$id}'";
        if (!$this->query($sql, $fields)->error()) {
            return true;
        } else {
            return false;
        }

    }

    public function update($table, $id, $fields = array())
    {
        $set = '';
        $x = 1;
        $count = count($fields);

        var_dump($count);

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < $count) {
                $set .= ", ";
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        var_dump($sql);
        if (!$this->query($sql, $fields)->error()) {
            return true;
        } else {
            return false;
        }
    }

    public function getDistinct($table, $field)
    {
        $sql = "SELECT DISTINCT {$field} FROM {$table} HAVING serial_leitor";
        $this->query($sql);
    }

    public function getJoinTransacaoArquivo($id)
    {
        // $sql = "SELECT transacao_id, serial_leitor, debito_credito, tipo_pagamento, valor_bruto, valor_taxa, parcelas, data_transacao, valor_recebido, id_cliente FROM transacao t
        // JOIN arquivo_transacao a
        // ON t.transacao_id = a.id_transacao
        // WHERE a.id_arquivo = {$id}
        // HAVING serial_leitor
        // ORDER BY serial_leitor, debito_credito, parcelas DESC";

        // $sql = "SELECT t.transacao_id, t.serial_leitor, t.debito_credito, t.tipo_pagamento, t.valor_bruto, t.valor_taxa, t.parcelas, t.data_transacao, t.valor_recebido,
        // c.id, c.nome, c.taxa_deb, c.taxa_cred_1x, c.taxa_cred_2x, c.taxa_cred_3x, c.taxa_cred_4x, c.taxa_cred_5x, c.taxa_cred_6x, c.taxa_cred_7x, c.taxa_cred_8x,
        // c.taxa_cred_9x, c.taxa_cred_10x, c.taxa_cred_11x, c.taxa_cred_12x FROM Transacao t
        // JOIN cliente c ON t.id_cliente = c.id
        // JOIN arquivo_transacao a ON t.transacao_id = a.id_transacao
        // WHERE a.id_arquivo = {$id}  and c.id = t.id_cliente
        // HAVING serial_leitor
        // ORDER BY serial_leitor, debito_credito, parcelas DESC";

        $sql = "SELECT t.transacao_id, t.serial_leitor, t.debito_credito, t.codigo_venda, t.tipo_pagamento, t.valor_bruto, t.valor_taxa, t.parcelas, t.data_transacao, t.valor_recebido,
        c.id, c.nome, c.taxa_deb, c.taxa_cred_1x, c.taxa_cred_2x, c.taxa_cred_3x, c.taxa_cred_4x, c.taxa_cred_5x, c.taxa_cred_6x, c.taxa_cred_7x, c.taxa_cred_8x,
        c.taxa_cred_9x, c.taxa_cred_10x, c.taxa_cred_11x, c.taxa_cred_12x FROM Transacao t
        LEFT JOIN cliente c ON t.id_cliente = c.id
        LEFT JOIN arquivo_transacao a ON t.transacao_id = a.id_transacao
        WHERE a.id_arquivo = {$id}
        HAVING serial_leitor
        ORDER BY serial_leitor, debito_credito, parcelas DESC";

        $this->query($sql);
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function formatMoney($valor, $moeda)
    {
        if ($moeda == 'real') {
            return 'R$' . number_format($valor, 2, ',', '.');
        } else {
            return number_format($valor, 2, ',', '.');
        }

    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        return $this->query($sql);
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function error()
    {
        return $this->_error;
    }

    public function results()
    {
        return $this->_results;
    }

    public function count()
    {
        return $this->_count;
    }

    public function lastid()
    {
        return $this->_last_id;
    }

    public function pdo()
    {
        return $this->_pdo;
    }

}
