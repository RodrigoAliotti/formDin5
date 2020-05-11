<?php
/*
 * ----------------------------------------------------------------------------
 * Formdin 5 Framework
 * SourceCode https://github.com/bjverde/formDin5
 * @author Reinaldo A. Barrêto Junior
 * 
 * É uma reconstrução do FormDin 4 Sobre o Adianti 7.X
 * ----------------------------------------------------------------------------
 * This file is part of Formdin Framework.
 *
 * Formdin Framework is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License version 3
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License version 3
 * along with this program; if not,  see <http://www.gnu.org/licenses/>
 * or write to the Free Software Foundation, Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA  02110-1301, USA.
 * ----------------------------------------------------------------------------
 * Este arquivo é parte do Framework Formdin.
 *
 * O Framework Formdin é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da GNU LGPL versão 3 como publicada pela Fundação
 * do Software Livre (FSF).
 *
 * Este programa é distribuí1do na esperança que possa ser útil, mas SEM NENHUMA
 * GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a Licen?a Pública Geral GNU/LGPL em portugu?s
 * para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da GNU LGPL versão 3, sob o título
 * "LICENCA.txt", junto com esse programa. Se não, acesse <http://www.gnu.org/licenses/>
 * ou escreva para a Fundação do Software Livre (FSF) Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02111-1301, USA.
 */

/**
 * Classe para criação de Botões 
 * ------------------------------------------------------------------------
 * Esse é o FormDin 5, que é uma reconstrução do FormDin 4 Sobre o Adianti 7.X
 * os parâmetros do metodos foram marcados com:
 * 
 * NOT_IMPLEMENTED = Parâmetro não implementados, talvez funcione em 
 *                   verões futuras do FormDin. Não vai fazer nada
 * DEPRECATED = Parâmetro que não vai funcionar no Adianti e foi mantido
 *              para o impacto sobre as migrações. Vai gerar um Warning
 * FORMDIN5 = Parâmetro novo disponivel apenas na nova versão
 * ------------------------------------------------------------------------
 * 
 * @author Reinaldo A. Barrêto Junior
 */ 
class TFormDinButton {

    protected $adiantiObj;
    protected $mixMessage;

    /**
     * ------------------------------------------------------------------------
     * FormDin 5, que é uma reconstrução do FormDin 4 sobre o Adianti 7.X
     * Alguns parâmetros têm uma TAG, veja documentação da classe para saber
     * o que cada marca significa.
     * ------------------------------------------------------------------------
     *
     * @param string $message   - 1: Texto da mensagem pode ser HTML
     * @param string $type      - 2: 2: FORMDIN5 Type mensagem: DEFAULT=info, error, warning. Use TFormDinMessage::TYPE_
     * @param TAction $action   - 3: FORMDIN5 Classe TAction do Adianti
     * @param string $title_msg - 4: FORMDIN5 titulo da mensagem
     */
    public function __construct($mixMessage
                              , $type = TFormDinMessage::TYPE_INFO
                              , TAction $action = NULL
                              , $title_msg = '')
    {
        $this->setMixMessage($mixMessage);
        $mixMessage = $this->getMixMessage();
        $this->adiantiObj = new TMessage($type,$mixMessage,$action,$title_msg);
        return $this->adiantiObj;
    }

    public function setMixMessage($mixMessage){
        if(is_array($mixMessage)){
            $mixMessage = implode( '<br>', $mixMessage );
            $mixMessage = preg_replace( '/' . chr( 10 ) . '/', '<br>', $mixMessage );
            $mixMessage = preg_replace( '/' . chr( 13 ) . '/', '', $mixMessage );
            $this->mixMessage=$mixMessage;
        }else{
            $this->mixMessage=$mixMessage;
        }        
    }
    public function getMixMessage(){
        return $this->mixMessage;
    }
}
?>