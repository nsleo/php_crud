<?php

/**
 * Classe Contato - baseado no modelo Active Record (Simplificado) 
 * @author Alexandre Bezerra Barbosa
 */
class Contato
{
    private $atributos;

    public function __construct()
    {

    }

    public function __set(string $atributo, $valor)
    {
        $this->atributos[$atributo] = $valor;
        return $this;
    }

    public function __get(string $atributo)
    {
        return $this->atributos[$atributo];
    }

    public function __isset($atributo)
    {
        return isset($this->atributos[$atributo]);
    }

    /**
     * Salvar o contato
     * @return boolean
     */
    public function save()
    {
        $colunas = $this->preparar($this->atributos);
        if (!isset($this->id)) {
            $query = "INSERT INTO contatos (".
                implode(', ', array_keys($colunas)).
                ") VALUES (".
                implode(', ', array_values($colunas)).");";
        } else {
            foreach ($colunas as $key => $value) {
                if ($key !== 'id') {
                    $definir[] = "{$key}={$value}";
                }
            }
            $query = "UPDATE contatos SET ".implode(', ', $definir)." WHERE id='{$this->id}';";
        }
        if ($conexao = Conexao::getInstance()) {
            $stmt = $conexao->prepare($query);
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }
        return false;
    }

    /**
     * Tornar valores aceitos para sintaxe SQL
     * @param type $dados
     * @return string
     */
    private function escapar($dados)
    {
        if (is_string($dados) & !empty($dados)) {
            return "'".addslashes($dados)."'";
        } elseif (is_bool($dados)) {
            return $dados ? 'TRUE' : 'FALSE';
        } elseif ($dados !== '') {
            return $dados;
        } else {
            return 'NULL';
        }
    }

    /**
     * Verifica se dados são próprios para ser salvos
     * @param array $dados
     * @return array
     */
    private function preparar($dados)
    {
        $resultado = array();
        foreach ($dados as $k => $v) {
            if (is_scalar($v)) {
                $resultado[$k] = $this->escapar($v);
            }
        }
        return $resultado;
    }
    // UPDATE `contatos` SET `status` = '0' WHERE `contatos`.`id='{$id}';"
    /**
     * Retorna uma lista de contatos
     * @return array/boolean
     */
    public static function all()
    {   
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM `contatos` WHERE status=1 ;");
        $result  = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Contato::class)) {
                $result[] = $rs;
            }
        }
        if (count($result) > 0) {
            return $result;
        }
        return false;
    }

    /**
     * Retornar o número de registros
     * @return int/boolean
     */
    public static function count()
    {
        $conexao = Conexao::getInstance();
        $count   = $conexao->exec("SELECT count(*) FROM contatos;");
        if ($count) {
            return (int) $count;
        }
        return false;
    }

    /**
     * Encontra um recurso pelo id
     * @param type $id
     * @return type
     */
    public static function find($id)
    {
        $conexao = Conexao::getInstance();
        $stmt    = $conexao->prepare("SELECT * FROM contatos WHERE id='{$id}';");
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchObject('Contato');
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }

    public static function findCpf($cpf)
    {
        $conexao = Conexao::getInstance();
        // prepare não funcionou, query sim
        $countCpf    = $conexao->query("SELECT * FROM contatos WHERE cpf='{$cpf}';");
        // sem o count() não funcionou
        if (count($countCpf->fetchAll()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Destruir um recurso
     * @param type $id
     * @return boolean
     */
    public static function destroy($id)
    {
        $conexao = Conexao::getInstance();
        if ($conexao->exec("UPDATE `contatos` SET `status` = '0' WHERE id={$id};")) {
            return true;
        }
        return false;
    }

    // public static function destroyView($id)
    // {
    //     $conexao = Conexao::getInstance();
    //     if ($conexao->exec("UPDATE `contatos` SET `status` = '0' WHERE `contatos`.`id='{$id}';")) {
    //       return true;
    //     }
    //     return false;
    // }
}