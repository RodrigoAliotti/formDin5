<?php
/*
 * FormDin 5 Framework
 * Created by Reinaldo A. Barrêto Jr in 2019
 * Based on the FormDin 4 of Luís Eugênio Barbosa
 * https://github.com/bjverde/formDin5
 *
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
 * Este programa é distribuído na esperança que possa ser útil, mas SEM NENHUMA
 * GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/LGPL em português
 * para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da GNU LGPL versão 3, sob o título
 * "LICENCA.txt", junto com esse programa. Se não, acesse <http://www.gnu.org/licenses/>
 * ou escreva para a Fundação do Software Livre (FSF) Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02111-1301, USA.
 */

class TMenuBootStrap {

    private $nav;
    private $menuIconsPath;

    public function __construct(){       
    }

    public function getNav()
    {
		return $this->nav;
    }
    
    public function setNav($nav)
    {
		$this->nav = $nav;
    }

    public function setMenuIconsPath($strNewValue = null)
    {
        $this->menuIconsPath = $strNewValue;
    }
    public function getMenuIconsPath()
    {
        return $this->menuIconsPath;
    }
    
    public function BuildNav()
    {
        $nav = new TElement('nav');
        $nav->setClass('sticky-top navbar navbar-expand-md navbar-dark bg-dark');
        $this->setNav($nav);
    }
    
	public function getNavBrand()
	{
        $navBrand = new TElement('a');
        $navBrand->setClass('navbar-brand');
        $navBrand->setAttribute('href','index.php');
        $navBrand->add('Form Sigla');
        return $navBrand;
    }    
    
	public function getNavBarButton()
	{
        $icon = new TElement('span');
        $icon->setClass('navbar-toggler-icon');

        $button = new TElement('button');
        $button->setClass('navbar-toggler');
        $button->setAttribute('type','button');
        $button->setAttribute('data-toggle','collapse');
        $button->setAttribute('data-target','#navbarsExampleDefault');
        $button->setAttribute('aria-controls','navbarsExampleDefault');
        $button->setAttribute('aria-expanded','false');
        $button->setAttribute(' aria-label','Toggle navigation');
        $button->add($icon);
        return $button;
    }

    public function getNav2()
	{
        $nav = new TElement('nav');
        $nav->setClass('sticky-top navbar navbar-expand-md navbar-dark bg-dark');
        //$nav->add( $this->getNavBrand() );
        $nav->add( $this->getNavBarButton() );
        return $nav;
    }

    
    public function buildItem($item)
    {
        //var_dump($item);
        //$text = $item['@attributes']['text'];
        $item = new TElement('a');
        $item->setClass('dropdown-menu');
        $item->setAttribute('href','#');
        $item->add($text);
        return $item;
    }
    
    
    /***
     * Return HTML5 Element img or Font
     * @param string $imgString
     * @return TElement
     */
    public function getMenuIcon($imgString){
        $imgCaminho = $this->getMenuIconsPath();
        $imgCaminho = $imgCaminho.$imgString;
        $img = new TElement('img');
        $img->setClass('menuIcon');
        $img->setAttribute('src',$imgCaminho);
        return $img;
    }
    
    
    /**
     * Return HTML5 Element LU
     * @param string $id
     * @param array $subItens
     * @return TElement
     */
    public function getUlDropMenu($id,$subItens){
        $dropMenu = new TElement('ul');
        $dropMenu->setClass('dropdown');
        $dropMenu->setAttribute('aria-labelledby',$id);
        return $dropMenu;
    }
    
    public function buildNavLink($item)
    {
        //ini_set('xdebug.var_display_max_depth', '10');
        //ini_set('xdebug.var_display_max_children', '256');
        //ini_set('xdebug.var_display_max_data', '-1');
        //var_dump($item);exit();
        //var_dump($item['@attributes']);
        $id = $item['@attributes']['id'];
        
        $img = null;
        if(ArrayHelper::has('img',$item['@attributes'])){
            $img = $this->getMenuIcon($item['@attributes']['img']);
        }
        
        $subItens = null;
        if(ArrayHelper::has('item',$item)){
            $subItens = ArrayHelper::getArray($item, 'item');
        }
        
        $text = $item['@attributes']['text'];
        $item = new TElement('a');
        If( CountHelper::count($subItens) > 0 ){
            $item->setAttribute('id',$id);
            $item->setClass('nav-link dropdown-toggle');
            $item->setAttribute('data-toggle','dropdown');
            $item->setAttribute('aria-haspopup','true');
            $item->setAttribute('aria-expanded','false');
        }else{
            $item->setClass('nav-link');
        }
        $item->setAttribute('href','#');
        if(!empty($img)){
            $item->add($img);
        }
        $item->add($text);
        return $item;
    }
    
    /***
     * Return HTML5 Element LI
     * @param array $item
     * @return TElement
     */
    public function buildNavItem($item)
    {
        $subItens = null;
        $subMenu = null;
        if(ArrayHelper::has('item',$item)){
            $id = $item['@attributes']['id'];
            $subItens = ArrayHelper::getArray($item, 'item');
            $subMenu = $this->getUlDropMenu($id, $subItens);
        }
        
        $navLinks = $this->buildNavLink($item);
        
        $item = new TElement('li');
        $item->setClass('nav-item');
        $item->add($navLinks);
        If( CountHelper::count($subItens) > 0 ){
            $item->add($subMenu);
        }
        return $item;
    }
    
    /***
     * Return HTML5 Element UL 
     * @return TElement
     */
    public function getNavUl()
    {
        $navUl = new TElement('ul');
        $navUl->setClass('navbar-nav mr-auto');
        return $navUl;
    } 
    
    /***
     * Return HTML5 Element Div with
     * Nav Bar Collapse
     * @return TDiv
     */
    public function getNavCollapse()
    {   
        $navColl = new TDiv('navbarCollapse');
        $navColl->setClass('collapse navbar-collapse');
        return $navColl;
    }
    
    /***
     * Return Objetc SimpleXMLElement with Menu
     * @param string $menuFile - path file menu
     * @throws InvalidArgumentException
     * @return SimpleXMLElement
     */
    public function getObjXmlMenu($menuFile)
    {
        if ( !file_exists($menuFile) ) {
            throw new InvalidArgumentException (TMesage::MENU_FILE_FAIL);
        }
        
        ob_start();
        include $menuFile;
        $result = ob_get_clean();
        ob_end_clean();
        
        $xmlMenu = simplexml_load_string($result);
        return $xmlMenu;
    }

    /**
     * Return Array PHP with Menu
     * @param string $menuFile - path file menu
     * @return mixed
     */
    public function getArrayMenu($menuFile)
    {
        $xmlMenu = $this->getObjXmlMenu($menuFile);
        $jsonMenu = json_encode($xmlMenu);
        $arrayMenu = json_decode($jsonMenu,TRUE);
        return $arrayMenu;
    }

    /***
     * Create Element HTML 5 for use BootStrap CSS Menu
     * @param string $menuFile - path file menu
     * @param boolean $print
     * @return TElement
     */
    public function getMenuBootStrap($menuFile, $print=true)
    {    
        //ini_set('xdebug.var_display_max_depth', '10');
        //ini_set('xdebug.var_display_max_children', '256');
        //ini_set('xdebug.var_display_max_data', '-1');
        //var_dump($xmlMenu);
        
        $arrayMenu = $this->getArrayMenu($menuFile);
        $navUl = $this->getNavUl();
        foreach($arrayMenu['item'] as $key => $item) {
            //echo $key;
            //var_dump($item);
            //print_r($item);
            $ItemMenu = $this->buildNavItem($item);
            $navUl->add($ItemMenu);
        }
        $navColl = $this->getNavCollapse();
        $navColl->add($navUl);
        $nav = $this->getNav2();
        $nav->add($navColl);
        return $nav;
    }
}
?>