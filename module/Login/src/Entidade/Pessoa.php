<?php

namespace Login\Entidade;

/**
 * Pessoa
 */
class Pessoa
{
    /**
     * @var int
     */
    private $cd_pessoa;
    
    /**
     * @var string
     */
    private $ds_nome;

    /**
     * @var string
     */
    private $ds_login;

    /**
     * @var string
     */
    private $ds_senha;

    /**
     * Set dsNome.
     *
     * @param string $dsNome
     *
     * @return Pessoa
     */
    public function setDsNome($dsNome)
    {
        $this->ds_nome = $dsNome;

        return $this;
    }

    /**
     * Get dsNome.
     *
     * @return string
     */
    public function getDsNome()
    {
        return $this->ds_nome;
    }

    /**
     * Set dsLogin.
     *
     * @param string $dsLogin
     *
     * @return Pessoa
     */
    public function setDsLogin($dsLogin)
    {
        $this->ds_login = $dsLogin;

        return $this;
    }

    /**
     * Get dsLogin.
     *
     * @return string
     */
    public function getDsLogin()
    {
        return $this->ds_login;
    }

    /**
     * Set dsSenha.
     *
     * @param string $dsSenha
     *
     * @return Pessoa
     */
    public function setDsSenha($dsSenha)
    {
        $this->ds_senha = $dsSenha;

        return $this;
    }

    /**
     * Get dsSenha.
     *
     * @return string
     */
    public function getDsSenha()
    {
        return $this->ds_senha;
    }

    /**
     * Get cdPessoa.
     *
     * @return int
     */
    public function getCdPessoa()
    {
        return $this->cd_pessoa;
    }
}
