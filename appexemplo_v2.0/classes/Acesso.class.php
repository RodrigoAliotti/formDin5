<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 0.9.0
 * FormDin Version: 4.2.6-alpha
 * 
 * System ap2v created in: 2018-11-21 23:30:54
 */

class Acesso {


	public function __construct(){
    }
	//--------------------------------------------------------------------------------	
	public static function login( $login_user, $pwd_user )	{
		$user = Acesso_userDAO::selectByLogin($login_user);
        if (password_verify($pwd_user, $user['PWD_USER'][0])) {
            $_SESSION[APLICATIVO]['USER']['IDUSER'] = $user['IDUSER'][0];
            $_SESSION[APLICATIVO]['USER']['LOGIN']  = $user['LOGIN_USER'][0];
			self::setAcessoUserModulo();
			self::setAcessoUserPerfil();
            $msg = 1;
        }else{
            $msg = 'Login Invalido !';
        }
        return $msg;
	}
	//--------------------------------------------------------------------------------	
	public static function getLogin()	{
		$user  = ArrayHelper::get( $_SESSION[APLICATIVO],'USER');
		$login = ArrayHelper::get( $user,'LOGIN');
        return $login;
	}
	//--------------------------------------------------------------------------------	
	public static function getIdUser()	{
		$user   = ArrayHelper::get( $_SESSION[APLICATIVO],'USER');
		$iduser = ArrayHelper::get( $user,'IDUSER');
        return $iduser;
	}
	//--------------------------------------------------------------------------------
	public static function setAcessoUserPerfil(){
        $iduser = self::getIdUser();
		$perfil = Acesso_perfil_user::selectByIdUser($iduser);
		$_SESSION[APLICATIVO]['USER']['IDPERFIL']=$perfil['IDPERFIL'][0];
		$_SESSION[APLICATIVO]['USER']['NOM_PERFIL']=$perfil['NOM_PERFIL'][0];
	}	
	//--------------------------------------------------------------------------------
	public static function setAcessoUserModulo(){
        $login = self::getLogin();
	    $userMenu = Acesso_menuDAO::selectMenuByLogin($login);
	    $_SESSION[APLICATIVO]['USER']['MODULO_ACESSO'] = $userMenu;
	}
	//--------------------------------------------------------------------------------	
	public static function getAcessoUserMenuByLogin(){
        $userMenu = $_SESSION[APLICATIVO]['USER']['MODULO_ACESSO'];
        return $userMenu;
    }
    //--------------------------------------------------------------------------------
	/***
	 * Recebe o $_REQUEST[modulo] e informa se usuario pode acessar ou não o modulo
	 * @param string $dsUrl
	 * @throws InvalidArgumentException
	 * @return boolean
	 */
	public static function moduloAcessoPermitido($dsUrl){
	    $permitido = false;
	    if(empty($dsUrl)){
	        throw new InvalidArgumentException('Erro: Modulo não informado');
	    }else{
	       $dadosMenu = self::getAcessoUserMenuByLogin();
	       $listDsUrl = ArrayHelper::getArray($dadosMenu, 'URL');
	       $permitido = in_array($dsUrl, $listDsUrl);
	       if( $permitido==false ){
	           $permitido = in_array('modulos/'.$dsUrl, $listDsUrl);
	       }
	    }
	    return $permitido;
	}
    //--------------------------------------------------------------------------------
    public static function changePassword($login_user, $pwd_user_old, $pwd_user_new1, $pwd_user_new2)	{
        if(strlen($pwd_user_new1)<8){
            throw new DomainException('A senha de ter no minomo 8 caractes');
        }
        if($pwd_user_new1 != $pwd_user_new2){
            throw new DomainException('As senhas não iguais');
        }        
		$user = Acesso_userDAO::selectByLogin($login_user);
		if (password_verify($pwd_user_old, $user['PWD_USER'][0])) {
		    $pwd_user_new_hash = password_hash($pwd_user_new1, PASSWORD_DEFAULT);
		    $vo = new Acesso_userVO();
		    $vo->setLogin_user($login_user);
		    $vo->setPwd_user($pwd_user_new_hash);
		    Acesso_userDAO::updateSenha($vo);
		    $msg = 1;
        }else{
            throw new DomainException('A senha atual não está correta');
        }
        return $msg;
    }    
}
?>