<?php
/*
 * FormDin 5 Framework
 * Created by Reinaldo A. Barrêto Jr in 2019
 * Based on the FormDin 4 of Luiz Eugênio
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
if ( !function_exists( 'formdin_autoload') )
{
	function formdin_autoload( $class_name )
	{
		if (strpos($class_name, 'setasign\\') === 0) {
			return false;
		} elseif (strpos($class_name, 'PHPUnit\\') === 0) {
			return false; 
		} elseif (strpos($class_name, 'Symfony\\') === 0) {
			return false;
		}elseif (strpos($class_name, 'Composer\\') === 0) {
			return false;
		}elseif (strpos($class_name, 'Blacklist.class.php') === 0) {
			return false;
		}else{
			require_once $class_name . '.class.php';
		}
	}
	spl_autoload_register('formdin_autoload');
}