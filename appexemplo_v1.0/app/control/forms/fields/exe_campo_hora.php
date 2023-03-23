<?php

use Adianti\Registry\TSession;

class exe_campo_hora extends TPage
{
    protected $form; // registration form
    protected $datagrid; // listing
    protected $pageNavigation;
    
    // trait com onReload, onSearch, onDelete...
    use Adianti\Base\AdiantiStandardListTrait;

    public function __construct()
    {
        parent::__construct();

        $frm = new TFormDin($this,'Exemplo Campo Hora ');

        $html = '<br><br><b>Regra de Negocio</b>'
               .'<br>Passe o mouse no balões de ajuda e descubra a regra';

        //$frm->addHtmlField('texto', $html)->setCss('border', '1px solid red');
        $frm->addHtmlField('texto', $html);
        $fld = $frm->addTimeField('hor_entrada', 'Hora Entrada:', true, '05:00', '23:00', 'hh:ii');
        $fld->setToolTip('Hora no formato HH:MM entre 05:00 e 23:00');
        $frm->addTimeField('hor_inicio2', 'Hora:', false, '12:00:00', '15:00:00', 'HMS')->setToolTip('Hora no formato HH:MM:SS entre 12:00 e 15:00');

        $frm->addGroupField('gpx4', 'Mascara FormDin4');
        $frm->addTimeField('h3', 'horas3:',false,false,false,'HM')->setToolTip(null, 'Mascara HM');
        $frm->addTimeField('h4', 'horas4:',false,false,false,'HMS')->setToolTip(null, 'Mascara HMS');

        // O Adianti permite a Internacionalização - A função _t('string') serve
        //para traduzir termos no sistema. Veja ApplicationTranslator escrevendo
        //primeiro em ingles e depois traduzindo
        $frm->setAction( _t('Save'), 'onSave', null, 'fa:save', 'green' );
        $frm->setActionLink( _t('Clear'), 'onClear', null, 'fa:eraser', 'red');

        $this->form = $frm->show();

        // creates the page structure using a table
        $formDinBreadCrumb = new TFormDinBreadCrumb(__CLASS__);
        $vbox = $formDinBreadCrumb->getAdiantiObj();
        $vbox->add($this->form);
        
        // add the table inside the page
        parent::add($vbox);
    }

    /**
     * Clear filters
     */
    public function onClear()
    {
        $this->clearFilters();
        $this->onReload();
    }

    public function onSave($param)
    {
        try
        {
            $data = $this->form->getData();
            $this->form->setData($data);
            $this->form->validate();
            
    
            //Função do FormDin para Debug
            FormDinHelper::d($param,'$param');
            FormDinHelper::debug($data,'$data');
            FormDinHelper::debug($_REQUEST,'$_REQUEST');

            new TMessage('info', 'Tudo OK!');
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

}