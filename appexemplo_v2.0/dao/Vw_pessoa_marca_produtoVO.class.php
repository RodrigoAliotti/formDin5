<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.3.1-alpha
 * FormDin Version: 4.5.1-alpha
 * 
 * System xx created in: 2019-04-14 20:35:33
 */
class Vw_pessoa_marca_produtoVO
{
    private $idpessoa = null;
    private $nome = null;
    private $idmarca = null;
    private $nom_marca = null;
    private $idproduto = null;
    private $nom_produto = null;
    public function __construct( $idpessoa=null, $nome=null, $idmarca=null, $nom_marca=null, $idproduto=null, $nom_produto=null ) {
        $this->setIdpessoa( $idpessoa );
        $this->setNome( $nome );
        $this->setIdmarca( $idmarca );
        $this->setNom_marca( $nom_marca );
        $this->setIdproduto( $idproduto );
        $this->setNom_produto( $nom_produto );
    }
    //--------------------------------------------------------------------------------
    public function setIdpessoa( $strNewValue = null )
    {
        $this->idpessoa = $strNewValue;
    }
    public function getIdpessoa()
    {
        return $this->idpessoa;
    }
    //--------------------------------------------------------------------------------
    public function setNome( $strNewValue = null )
    {
        $this->nome = $strNewValue;
    }
    public function getNome()
    {
        return $this->nome;
    }
    //--------------------------------------------------------------------------------
    public function setIdmarca( $strNewValue = null )
    {
        $this->idmarca = $strNewValue;
    }
    public function getIdmarca()
    {
        return $this->idmarca;
    }
    //--------------------------------------------------------------------------------
    public function setNom_marca( $strNewValue = null )
    {
        $this->nom_marca = $strNewValue;
    }
    public function getNom_marca()
    {
        return $this->nom_marca;
    }
    //--------------------------------------------------------------------------------
    public function setIdproduto( $strNewValue = null )
    {
        $this->idproduto = $strNewValue;
    }
    public function getIdproduto()
    {
        return $this->idproduto;
    }
    //--------------------------------------------------------------------------------
    public function setNom_produto( $strNewValue = null )
    {
        $this->nom_produto = $strNewValue;
    }
    public function getNom_produto()
    {
        return $this->nom_produto;
    }
    //--------------------------------------------------------------------------------
}
?>