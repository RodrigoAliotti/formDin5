<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.9.0-alpha
 * FormDin Version: 4.7.5
 * 
 * System appev2 created in: 2019-09-10 11:31:30
 */
class Acesso_user_menuDAO 
{

    private static $sqlBasicSelect = 'select
                                      iduser
                                     ,login_user
                                     ,idperfil
                                     ,nom_perfil
                                     ,idmenu
                                     ,nom_menu
                                     from form_exemplo.acesso_user_menu ';

    private $tpdo = null;

    public function __construct($tpdo=null)
    {
        $this->validateObjType($tpdo);
        if( empty($tpdo) ){
            $tpdo = New TPDOConnectionObj();
        }
        $this->setTPDOConnection($tpdo);
    }
    public function getTPDOConnection()
    {
        return $this->tpdo;
    }
    public function setTPDOConnection($tpdo)
    {
        $this->validateObjType($tpdo);
        $this->tpdo = $tpdo;
    }
    public function validateObjType($tpdo)
    {
        $typeObjWrong = !($tpdo instanceof TPDOConnectionObj);
        if( !is_null($tpdo) && $typeObjWrong ){
            throw new InvalidArgumentException('class:'.__METHOD__);
        }
    }
    private function processWhereGridParameters( $whereGrid )
    {
        $result = $whereGrid;
        if ( is_array($whereGrid) ){
            $where = ' 1=1 ';
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IDUSER', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'LOGIN_USER', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IDPERFIL', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'NOM_PERFIL', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'IDMENU', SqlHelper::SQL_TYPE_NUMERIC);
            $where = SqlHelper::getAtributeWhereGridParameters($where, $whereGrid, 'NOM_MENU', SqlHelper::SQL_TYPE_NUMERIC);
            $result = $where;
        }
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectById( $id )
    {
        if( empty($id) || !is_numeric($id) ){
            throw new InvalidArgumentException(Message::TYPE_NOT_INT.'class:'.__METHOD__);
        }
        $values = array($id);
        $sql = self::$sqlBasicSelect.' where iduser = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectCount( $where=null )
    {
        $where = $this->processWhereGridParameters($where);
        $sql = 'select count(iduser) as qtd from form_exemplo.acesso_user_menu';
        $sql = $sql.( ($where)? ' where '.$where:'');
        $result = $this->tpdo->executeSql($sql);
        return $result['QTD'][0];
    }
    //--------------------------------------------------------------------------------
    public function selectAllPagination( $orderBy=null, $where=null, $page=null,  $rowsPerPage= null )
    {
        $rowStart = SqlHelper::getRowStart($page,$rowsPerPage);
        $where = $this->processWhereGridParameters($where);

        $sql = self::$sqlBasicSelect
        .( ($where)? ' where '.$where:'')
        .( ($orderBy) ? ' order by '.$orderBy:'')
        .( ' LIMIT '.$rowStart.','.$rowsPerPage);

        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function selectAll( $orderBy=null, $where=null )
    {
        $where = $this->processWhereGridParameters($where);
        $sql = self::$sqlBasicSelect
        .( ($where)? ' where '.$where:'')
        .( ($orderBy) ? ' order by '.$orderBy:'');

        $result = $this->tpdo->executeSql($sql);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function insert( Acesso_user_menuVO $objVo )
    {
        $values = array(  $objVo->getLogin_user() 
                        , $objVo->getIdperfil() 
                        , $objVo->getNom_perfil() 
                        , $objVo->getIdmenu() 
                        , $objVo->getNom_menu() 
                        );
        $sql = 'insert into form_exemplo.acesso_user_menu(
                                 login_user
                                ,idperfil
                                ,nom_perfil
                                ,idmenu
                                ,nom_menu
                                ) values (?,?,?,?,?)';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function update ( Acesso_user_menuVO $objVo )
    {
        $values = array( $objVo->getLogin_user()
                        ,$objVo->getIdperfil()
                        ,$objVo->getNom_perfil()
                        ,$objVo->getIdmenu()
                        ,$objVo->getNom_menu()
                        ,$objVo->getIduser() );
        $sql = 'update form_exemplo.acesso_user_menu set 
                                 login_user = ?
                                ,idperfil = ?
                                ,nom_perfil = ?
                                ,idmenu = ?
                                ,nom_menu = ?
                                where iduser = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function delete( $id )
    {
        if( empty($id) || !is_numeric($id) ){
            throw new InvalidArgumentException(Message::TYPE_NOT_INT.'class:'.__METHOD__);
        }
        $values = array($id);
        $sql = 'delete from form_exemplo.acesso_user_menu where iduser = ?';
        $result = $this->tpdo->executeSql($sql, $values);
        return $result;
    }
    //--------------------------------------------------------------------------------
    public function getVoById( $id )
    {
        if( empty($id) || !is_numeric($id) ){
            throw new InvalidArgumentException(Message::TYPE_NOT_INT.'class:'.__METHOD__);
        }
        $result = $this->selectById( $id );
        $result = \ArrayHelper::convertArrayFormDin2Pdo($result,false);
        $result = $result[0];
        $vo = new Acesso_user_menuVO();
        $vo = \FormDinHelper::setPropertyVo($result,$vo);
        return $vo;
    }
}
?>