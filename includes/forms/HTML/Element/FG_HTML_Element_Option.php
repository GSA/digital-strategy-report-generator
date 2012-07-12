<?php
/**
 * Class representing a HTML option element
 * 
 * @author Lucas Pelegrino <lucas.wxp@gmail.com>
 * @package fg.HTML.Element
 */

require_once dirname(dirname(__FILE__)) . '/FG_HTML_Element.php';

class FG_HTML_Element_Option extends FG_HTML_Element{
	
/**
 * Initializes the element
 */
	public function __construct(){
		parent::__construct('option');
	}
}