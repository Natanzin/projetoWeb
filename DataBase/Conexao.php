<?php

class Conexao {
	
	private $host 	  = 'localhost';
	private $user 	  = 'root';
	private $password = '';
	private $db       = 'dev_web';
	
	protected $conexao;

    /**
     * @return mixed
     */
    public function getConexao()
    {
        return $this->conexao;
    }

	public function conectar()
	{
		$this->conexao = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=utf8', $this->user, $this->password);
		return $this;
	}
	
	public function desconectar()
	{
		$this->conexao = null;
        return $this;
	}
	
	public function executar($sql)
	{
		$this->conectar();
		$this->conexao->query($sql);
		$retorno = $this->conexao->lastInsertId();
		$this->desconectar();
		
		return $retorno;
	}
	
	public function recuperarTodos($sql)
	{
		$this->conectar();
		$resultado = $this->conexao->query($sql);
        $registros = $resultado->fetchAll(PDO::FETCH_ASSOC);
		$this->desconectar();

		return $registros;
	}
}