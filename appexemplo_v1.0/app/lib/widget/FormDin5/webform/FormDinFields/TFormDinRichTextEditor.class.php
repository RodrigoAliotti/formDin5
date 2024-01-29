<?php
        
class TFormDinRichTextEditor extends TFormDinGenericField
{
    private $showCountChar;
    private $intMaxLength;

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
    public function __construct($id,
                               $label,
                               $intMaxLength,
                               $boolRequired=null,
                               $intColumns='100%',
                               $intRows='100%',
                               $boolNewLine=null,
   		                       $boolLabelAbove=false,
                               $value=null,
                               $boolNoWrapLabel=null,
                               $placeholder=null,
                               $boolShowCountChar=false)
    {

        
        $this->setAdiantiObjRichEditor($id,$placeholder);        
        $this->setMaxLength($label,$intMaxLength);       

        $this->setAdiantiObjTFull($id,$boolShowCountChar,$intMaxLength,$placeholder,$intColumns, $intRows,$label,$boolRequired);
        
        return $this->getAdiantiObj();       
    }

    public function setAdiantiObjRichEditor($id,$placeholder){   
      
      $this->adiantiObjRichEditor = new TElement("div");  
      $this->adiantiObjRichEditor->setproperty('id',$id);
      
      if (empty($placeholder)){
        return;
      }        
      $this->adiantiObjRichEditor->setproperty('placeholder',$placeholder);
    }

    public function getAdiantiObjRichEditor(): TElement {
        return $this->adiantiObjRichEditor;
    }

    private function setAdiantiObjTFull( $idField, $boolShowCountChar,$intMaxLength,$placeholder,$intColumns, $intRows,$label,$boolRequired )
    {
      $div = new TElement('div');
      $div->add($this->adiantiObjRichEditor);
      $this->setSize($div,$intColumns, $intRows);
      $div->show;

      
      $addLabel = "document.querySelector('#{$idField}+.note-editor>.note-dropzone>.note-dropzone-message').innerHTML = '{$label}';";
      $addLabel.= "document.querySelector('#{$idField}+.note-editor>.note-dropzone').style.display = 'block';";
      $addLabel.= "document.querySelector('#{$idField}+.note-editor>.note-dropzone').style.backgroundColor = 'transparent';";
      $addLabel.= "document.querySelector('#{$idField}+.note-editor>.note-dropzone>.note-dropzone-message').style.padding = '4px';";
      $addLabel.= "document.querySelector('#{$idField}+.note-editor>.note-dropzone>.note-dropzone-message').style.fontSize = '14px';";
      if ($boolRequired){
        $addLabel.= "document.querySelector('#{$idField}+.note-editor>.note-dropzone>.note-dropzone-message').style.color = 'red';";
      } else {
        $addLabel.= "document.querySelector('#{$idField}+.note-editor>.note-dropzone>.note-dropzone-message').style.color = 'black';";
      }
      $addLabel.="document.querySelector('#{$idField}+.note-editor>.panel-heading').style.paddingLeft=document.querySelector('#{$idField}+.note-editor>.note-dropzone>.note-dropzone-message').offsetWidth+'px';";
      $addLabel.="document.querySelector('#{$idField}+.note-editor>.note-dropzone').style.minHeight=document.querySelector('#{$idField}+.note-editor>.panel-heading').style.offsetHeight+'px';";
      $addLabel.="document.querySelector('#{$idField}+.note-editor>.note-dropzone').style.marginTop=window.getComputedStyle(document.querySelector('#{$idField}+.note-editor>.panel-heading>.btn-group')).marginTop;";

      TScript::create(" $('#{$idField}').summernote({   
        placeholder:'{$placeholder}',       
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
        ]
      });".$addLabel
        ."document.querySelector('#{$idField}+.note-editor>.note-statusbar>.note-resizebar').style.display=\"none\";");

      $this->adiantiObjFull = $div;
        
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

    private function setSize($element,$intColumns, $intRows)
    {
      if(is_numeric($intRows)){
          $intRows = $intRows * 4;
      }else{
          FormDinHelper::validateSizeWidthAndHeight($intRows,true);
      }
      $intColumns = FormDinHelper::sizeWidthInPercent($intColumns);

      $element->setProperty('style',"width:{$intColumns},height:{$intRows}");
          
    }

    public function setShowCountChar($showCountChar)
    {
        $this->showCountChar = $showCountChar;
    }

    public function getShowCountChar()
    {
        return $this->showCountChar;
    }

}
