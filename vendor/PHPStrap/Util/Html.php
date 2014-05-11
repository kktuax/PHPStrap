<?php

namespace PHPStrap\Util;

class Html{
	
	/** Crea etiqueta html
	 * @param string $tag_name nombre de la etiqueta (por ej. div)
	 * @param string $content contenido de la etiqueta
	 * @param array $estilos estilos de la etiqueta, por defecto array vacio
	 * @param array $attributes array asociativo con elementos y su valor, por ejemplo array('id' => 'mi-tag')
	 * @return string
	 */
	public static function tag($tag_name, $content, $styles = array(), $attributes = array()){
		$attributes_str = "";
		foreach ($attributes as $key => $val) {
			$attributes_str .= ' ' . $key . '="' . $val . '"';
		}
		return '<' . $tag_name . Html::tag_class($styles) . $attributes_str . '>' . $content . '</' . $tag_name . '>';
	}

	/** 
	 * @param array $estilos
	 * @return string con el class de una etiqueta (o un string vacio si no hay estilos)
	 */
	private static function tag_class($styles = array()){
		if(!is_array($styles)){
			$styles = array($styles);
		}
		return (!empty($styles)) ? ' class="' . implode(" ", $styles) . '"' : "";
	}
	
	public static function ul($contents = array(), $styles = array()){
		$content = "<li>" . implode("</li>\n<li>", $contents) . "</li>";
		return Html::tag('ul', $content, $styles);
	}
	
}

?>