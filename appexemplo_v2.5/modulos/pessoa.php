<?php
/**
 * System generated by SysGen (System Generator with Formdin Framework) 
 * Download SysGen: https://github.com/bjverde/sysgen
 * Download Formdin Framework: https://github.com/bjverde/formDin
 * 
 * SysGen  Version: 1.9.0-alpha
 * FormDin Version: 4.7.5-alpha
 * 
 * System appev2 created in: 2019-09-01 16:03:51
 */

defined('APLICATIVO') or die();
require_once 'modulos/includes/acesso_view_allowed.php';

$primaryKey = 'IDPESSOA';
$frm = new TForm('Cadastro de Pessoa',800,950);
$frm->setShowCloseButton(false);
$frm->setFlat(true);
$frm->setMaximize(true);
$frm->setHelpOnLine('Ajuda',600,980,'ajuda/ajuda_tela.php',null);


$frm->addHiddenField( 'BUSCAR' ); //Campo oculto para buscas
$frm->addHiddenField( $primaryKey );   // coluna chave da tabela
$frm->addTextField('NOME', 'Nome',200,true,80);
$frm->addSelectField('TIPO'	, 'Tipo Pessoa:',true,'PF=Pessoa física,PJ=Pessoa jurídica');
$frm->getLabel('TIPO')->setToolTip('Valor permitidos PF ou PJ');
$frm->addSelectField('SIT_ATIVO', 'Ativo:', true, 'S=Sim,N=Não', true);
//$frm->addDateField('DAT_INCLUSAO', 'DAT_INCLUSAO',TRUE);

$frm->addButton('Buscar', null, 'btnBuscar', 'buscar()', null, true, false);
$frm->addButton('Salvar', null, 'Salvar', null, null, false, false);
$frm->addButton('Limpar', null, 'Limpar', null, null, false, false);


$acao = isset($acao) ? $acao : null;
switch( $acao ) {
    //--------------------------------------------------------------------------------
    case 'Limpar':
        $frm->clearFields();
    break;
    //--------------------------------------------------------------------------------
    case 'Salvar':
        try{
            if ( $frm->validate() ) {
                $vo = new PessoaVO();
                $frm->setVo( $vo );
                $controller = new Pessoa();
                $resultado = $controller->save( $vo );
                if($resultado==1) {
                    $frm->setMessage('Registro gravado com sucesso!!!');
                    $frm->clearFields();
                }else{
                    $frm->setMessage($resultado);
                }
            }
        }
        catch (DomainException $e) {
            $frm->setMessage( $e->getMessage() );
        }
        catch (Exception $e) {
            MessageHelper::logRecord($e);
            $frm->setMessage( $e->getMessage() );
        }
    break;
    //--------------------------------------------------------------------------------
    case 'gd_excluir':
        try{
            $id = $frm->get( $primaryKey ) ;
            $controller = new Pessoa();
            $resultado = $controller->delete( $id );
            if($resultado==1) {
                $frm->setMessage('Registro excluido com sucesso!!!');
                $frm->clearFields();
            }else{
                $frm->setMessage($resultado);
            }
        }
        catch (DomainException $e) {
            $frm->setMessage( $e->getMessage() );
        }
        catch (Exception $e) {
            MessageHelper::logRecord($e);
            $frm->setMessage( $e->getMessage() );
        }
    break;
}


function getWhereGridParameters(&$frm)
{
    $retorno = null;
    if($frm->get('BUSCAR') == 1 ){
        $retorno = array(
                'IDPESSOA'=>$frm->get('IDPESSOA')
                ,'NOME'=>$frm->get('NOME')
                ,'TIPO'=>$frm->get('TIPO')
                ,'SIT_ATIVO'=>$frm->get('SIT_ATIVO')
                ,'DAT_INCLUSAO'=>$frm->get('DAT_INCLUSAO')
        );
    }
    return $retorno;
}

if( isset( $_REQUEST['ajax'] )  && $_REQUEST['ajax'] ) {
    $maxRows = ROWS_PER_PAGE;
    $whereGrid = getWhereGridParameters($frm);
    $controller = new Pessoa();
    $page = PostHelper::get('page');
    $dados = $controller->selectAllPagination( $primaryKey, $whereGrid, $page,  $maxRows);
    $realTotalRowsSqlPaginator = $controller->selectCount( $whereGrid );
    $mixUpdateFields = $primaryKey.'|'.$primaryKey
                    .',NOME|NOME'
                    .',TIPO|TIPO'
                    .',SIT_ATIVO|SIT_ATIVO'
                    .',DAT_INCLUSAO|DAT_INCLUSAO'
                    ;
    $gride = new TGrid( 'gd'                        // id do gride
    				   ,'Gride with SQL Pagination. Qtd: '.$realTotalRowsSqlPaginator // titulo do gride
    				   );
    $gride->addKeyField( $primaryKey ); // chave primaria
    $gride->setData( $dados ); // array de dados
    $gride->setRealTotalRowsSqlPaginator( $realTotalRowsSqlPaginator );
    $gride->setMaxRows( $maxRows );
    $gride->setUpdateFields($mixUpdateFields);
    $gride->setUrl( 'pessoa.php' );

    $gride->addColumn($primaryKey,'id');
	$gride->addColumn('NOME','Nome');
	$gride->addColumn('TIPO','Tipo de Pessoa',null,'center');
	$gride->addColumn('SIT_ATIVO','Ativo',null,'center');
	$gride->addColumn('DAT_INCLUSAO','Data da Inclusão',null,'center');


    $gride->show();
    die();
}

$frm->addHtmlField('gride');
$frm->addJavascript('init()');
$frm->show();

?>
<script>
function init() {
    var Parameters = {"BUSCAR":""
                    ,"IDPESSOA":""
                    ,"NOME":""
                    ,"TIPO":""
                    ,"SIT_ATIVO":""
                    ,"DAT_INCLUSAO":""
                    };
    fwGetGrid('pessoa.php','gride',Parameters,true);
}
function buscar() {
    jQuery("#BUSCAR").val(1);
    init();
}
</script>