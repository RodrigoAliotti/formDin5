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

class Pessoa_fisica {


	public function __construct(){
	}
	//--------------------------------------------------------------------------------
	public static function selectById( $id ){
		$result = Pessoa_fisicaDAO::selectById( $id );
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function selectCount( $where=null ){
		$result = Pessoa_fisicaDAO::selectCount( $where );
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function selectAllPagination( $orderBy=null, $where=null, $page=null,  $rowsPerPage= null){
		$result = Pessoa_fisicaDAO::selectAllPagination( $orderBy, $where, $page,  $rowsPerPage );
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function selectAll( $orderBy=null, $where=null ){
		$result = Pessoa_fisicaDAO::selectAll( $orderBy, $where );
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function save( Pessoa_fisicaVO $objVo ){
		$result = null;
		if( $objVo->getIdpessoa_fisica() ) {
			$result = Pessoa_fisicaDAO::update( $objVo );
		} else {
			$result = Pessoa_fisicaDAO::insert( $objVo );
		}
		return $result;
	}
	//--------------------------------------------------------------------------------
	public static function delete( $id ){
		$result = Pessoa_fisicaDAO::delete( $id );
		return $result;
	}

}
?>