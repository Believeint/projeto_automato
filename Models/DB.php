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

    public function getDistinct($table, $field)
    {
        $sql = "SELECT DISTINCT {$field} FROM {$table}";
        $this->query($sql);
    }

    public function getJoinTransacaoArquivo($id)
    {
        $sql = "SELECT transacao_id, serial_leitor, debito_credito, tipo_pagamento, valor_bruto, valor_taxa, parcelas, data_transacao, valor_recebido FROM transacao t
        JOIN arquivo_transacao a
        ON t.transacao_id = a.id_transacao
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
