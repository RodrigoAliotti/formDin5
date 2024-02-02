<?php
        
class TFormDinRichTextEditor extends TFormDinGenericField
{
  private $showCountChar;
  private $intMaxLength;
  private $boolLabelAbove;
  
  private $intColumns;
  private $intRows;

  private $adiantiObjRichEditor; //Somente obj Adianti Customizada
  private $adiantiObjFull;  //obj Adianti completo com todos os elementos para fazer o memo

    /**
     * Adicionar campo de entrada de dados de varias linhas (textareas)
     * ------------------------------------------------------------------------
     * Esse é o FormDin 5, que é uma reconstrução do FormDin 4 Sobre o Adianti 7.X
     * os parâmetros do metodos foram marcados veja documentação da classe para
     * saber o que cada marca singinifica.
     * ------------------------------------------------------------------------
     *
     * @param string  $id              - 1: ID do campo
     * @param string  $label           - 2: Label
     * @param integer $intMaxLength    - 3: Tamanho maximos
     * @param boolean $boolRequired    - 4: Campo obrigatório ou não. Default FALSE = não obrigatório, TRUE = obrigatório
     * @param integer $intColumns      - 5: Largura use unidades responsivas % ou em ou rem ou vh ou vw. Valores inteiros até 100 serão convertidos para % , acima disso será 100%
     * @param integer $intRows         - 6: Altura use px ou %, valores inteiros serão multiplicados 4 e apresentado em px
     * @param boolean $boolNewLine     - 7: NOT_IMPLEMENTED nova linha
     * @param boolean $boolLabelAbove  - 8: NOT_IMPLEMENTED Label sobre o campo
     * @param string $placeholder      - 9: FORMDIN5 PlaceHolder é um Texto de exemplo
     * @param string $boolShowCountChar 10: FORMDIN5 Mostra o contador de caractes.  Default TRUE = mostra, FASE = não mostra
     * @return TFormDinRichTextEditor
     */
    public function __construct(string $id,
                               string $label,
                               $intMaxLength=0,
                               $boolRequired=false,
                               $intColumns='100%',
                               $intRows='100%',
                               $boolNewLine=null,
   		                         $boolLabelAbove = null,
                               $value=null,
                               $boolNoWrapLabel=null,
                               $placeholder=null,
                               $boolShowCountChar=false)
    {
        
      $this->intColumns=$intColumns;
      $this->intRows=$intRows;
      $this->setAdiantiObjRichEditor($id);  
      $this->labelTxt = trim(str_replace('  ',' ', $label));
      $this->boolLabelAbove = (!empty($boolLabelAbove));
      $this->setMaxLength($label,$intMaxLength);
      $this->setAdiantiObjTFull($id,$boolShowCountChar,$intMaxLength,$placeholder,$boolRequired);
      
      return $this->getAdiantiObj();       
    }

    public function setAdiantiObjRichEditor($id){         
      $this->adiantiObjRichEditor = new TElement('div');  
      $this->adiantiObjRichEditor->setproperty('id',$id);        
    }

    public function getAdiantiObjRichEditor(): TElement {
      return $this->adiantiObjRichEditor;
    }

    private function setAdiantiObjTFull( $idField, $boolShowCountChar,$intMaxLength,$placeholder,$boolRequired )
    {
      $div =new TElement('div');
      if (!$this->boolLabelAbove){
        $div->setProperty('style','display:flex;flex-direction: row;');
      }
      $objLabel =  new TLabel($this->labelTxt);
      if ($boolRequired){
        $objLabel->setFontColor('red');
      }
      $locale = !empty($ini['general']['locale']) ? $ini['general']['locale'] : 'pt-BR';
      $options = [
          'lang'=>$locale,
          'required'=>($boolRequired===true),
          'maxlength'=>$intMaxLength,
          'width'=>$this->intColumns,
          'placeholder'=>$placeholder,
          'height'=>$this->intRows,
          'maxHeight'=>$this->intRows,
          'toolbar'=>[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen']]
          ]
      ];
      $options_json = json_encode($options);      

      $callFunctionJS = "prepareAndShowRichEditor('{$idField}','','{$options_json}');";
      echo '<script>if (typeof prepareAndShowRichEditor == "undefined"){$.getScript("app/lib/widget/FormDin5/javascript/FormDin5RichEditor.js", function(){',$callFunctionJS,'});} else {',$callFunctionJS,'}</script>';
      
      $div->add($objLabel);
      $div->add($this->adiantiObjRichEditor);
      $div->show;  
      $this->adiantiObjFull = $div;
      //$this->adiantiObjFull = $this->adiantiObjRichEditor;
        
    }

    public function getAdiantiObjFull(){
      return $this->adiantiObjFull;
    }

    public function setMaxLength($label,$intMaxLength)
    {
      $this->intMaxLength = (int) $intMaxLength;
      if($intMaxLength>=1){
        $this->adiantiObjRichEditor->setProperty('maxlength', $intMaxLength);
      }
    }

    public function getMaxLength()
    {
      return $this->intMaxLength;
    }

    public function setShowCountChar($showCountChar)
    {
      $this->showCountChar = $showCountChar;
    }

}
