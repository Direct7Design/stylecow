<?php
/**
* styleCow php library (version 0.1)
*
* 2011. Created by Oscar Otero (http://oscarotero.com / http://anavallasuiza.com)
*
* styleCow is released under the GNU Affero GPL version 3.
* More information at http://www.gnu.org/licenses/agpl-3.0.html
*/

namespace stylecow;

class Vendor_prefixes implements iPlugins {
	public $position = 2;

	private $property_prefixes = array(
		'animation' => array('moz', 'webkit'),
		'animation-delay' => array('moz', 'webkit'),
		'animation-direction' => array('moz', 'webkit'),
		'animation-duration' => array('moz', 'webkit'),
		'animation-fill-mode' => array('moz', 'webkit'),
		'animation-iteration-count' => array('moz', 'webkit'),
		'animation-name' => array('moz', 'webkit'),
		'animation-play-state' => array('moz', 'webkit'),
		'animation-timing-function' => array('moz', 'webkit'),
		'appearance' => array('moz', 'webkit'),
		'backface-visibility' => array('moz', 'webkit'),
		'background-clip' => array('moz', 'webkit'),
		'background-origin' => array('moz', 'webkit'),
		'background-size' => array('moz', 'webkit', 'o'),
		'border-after' => array('webkit'),
		'border-after-color' => array('webkit'),
		'border-after-style' => array('webkit'),
		'border-after-width' => array('webkit'),
		'border-before' => array('webkit'),
		'border-before-color' => array('webkit'),
		'border-before-style' => array('webkit'),
		'border-before-width' => array('webkit'),
		'border-bottom-image' => array('moz', 'webkit', 'o'),
		'border-bottom-left-image' => array('moz', 'webkit', 'o'),
		'border-bottom-left-radius' => array('webkit'),
		'border-bottom-right-image' => array('moz', 'webkit', 'o'),
		'border-bottom-right-radius' => array('webkit'),
		'border-corner-image' => array('moz', 'webkit', 'o'),
		'border-image' => array('moz', 'webkit', 'o'),
		'border-left-image' => array('moz', 'webkit', 'o'),
		'border-top-image' => array('moz', 'webkit', 'o'),
		'border-top-left-image' => array('moz', 'webkit', 'o'),
		'border-top-left-radius' => array('webkit'),
		'border-top-right-image' => array('moz', 'webkit', 'o'),
		'border-top-right-radius' => array('webkit'),
		'border-radius' => array('moz', 'webkit', 'o'),
		'border-right-image' => array('moz', 'webkit', 'o'),
		'box-align' => array('moz', 'webkit', 'ms'),
		'box-direction' => array('moz', 'webkit', 'ms'),
		'box-flex' => array('moz', 'webkit', 'ms'),
		'box-flex-group' => array('moz', 'webkit', 'ms'),
		'box-lines' => array('moz', 'webkit', 'ms'),
		'box-ordinal-group' => array('moz', 'webkit', 'ms'),
		'box-orient' => array('moz', 'webkit', 'ms'),
		'box-pack' => array('moz', 'webkit', 'ms'),
		'box-shadow' => array('moz', 'webkit', 'o'),
		'box-sizing' => array('moz', 'webkit'),
		'column-count' => array('moz', 'webkit'),
		'column-gap' => array('moz', 'webkit'),
		'column-rule' => array('moz', 'webkit'),
		'column-rule-color' => array('moz', 'webkit'),
		'column-rule-style' => array('moz', 'webkit'),
		'column-rule-width' => array('moz', 'webkit'),
		'column-span' => array('moz', 'webkit'),
		'column-width' => array('moz', 'webkit'),
		'columns' => array('moz', 'webkit'),
		'filter' => array('ms'),
		'grid-column' => array('ms'),
		'grid-column-align' => array('ms'),
		'grid-column-span' => array('ms'),
		'grid-columns' => array('ms'),
		'grid-layer' => array('ms'),
		'grid-row' => array('ms'),
		'grid-row-align' => array('ms'),
		'grid-row-span' => array('ms'),
		'grid-rows' => array('ms'),
		'hyphens' => array('moz', 'epub'),
		'opacity' => array('moz', 'webkit'),
		'text-overflow' => array('o'),
		'transform' => array('moz', 'webkit', 'o', 'ms'),
		'transform-origin' => array('moz', 'webkit', 'o', 'ms'),
		'transition' => array('moz', 'webkit', 'o'),
		'transition-delay' => array('moz', 'webkit', 'o'),
		'transition-duration' => array('moz', 'webkit', 'o'),
		'transition-property' => array('moz', 'webkit', 'o'),
		'transition-timing-function' => array('moz', 'webkit', 'o'),
		'user-select' => array('moz', 'webkit')
	);

	private $property_fn_prefixes = array(
		'border-top-left-radius' => 'borderRadius',
		'border-top-right-radius' => 'borderRadius',
		'border-bottom-left-radius' => 'borderRadius',
		'border-bottom-right-radius' => 'borderRadius'
	);

	private $value_prefixes = array(
		'display' => array(
			'box' => array('moz', 'webkit'),
			'inline-block' => array('moz')
		),
		'background' => array(
			'linear-gradient' => array('moz', 'webkit')
		),
		'background-image' => array(
			'linear-gradient' => array('moz', 'webkit')
		)
	);

	private $value_fn_prefixes = array(
		'background' => array(
			'linear-gradient' => 'linearGradient'
		),
		'background-image' => array(
			'linear-gradient' => 'linearGradient'
		)
	);

	private $selector_prefixes = array(
		'::selection' => array('::-moz-selection')
	);

	private $Css;

	/**
	 * public function __construct (Stylecow $Css)
	 *
	 * return none
	 */
	public function __construct (Stylecow $Css) {
		$this->Css = $Css;
	}


	/**
	 * public function transform ()
	 *
	 * return none
	 */
	public function transform () {
		$this->Css->code = $this->_transform($this->Css->code);
	}


	/**
	 * private function _transform (array $array_code)
	 *
	 * return none
	 */
	private function _transform ($array_code) {
		$new_array_code = array();

		foreach ($array_code as $code) {
			if (!$code['is_css']) {
				$new_array_code[] = $code;
				continue;
			}

			$new_code = $code;

			$new_code['properties'] = array();

			foreach ($code['properties'] as $property) {
				$new_code['properties'][] = $property;

				//Properties
				if ($fn = $this->property_fn_prefixes[$property['name']]) {
					$this->$fn($new_code, $property['name'], $property['value']);
				}

				if ($this->property_prefixes[$property['name']]) {
					foreach ($this->property_prefixes[$property['name']] as $prefix) {
						$new_code['properties'][] = array(
							'name' => '-'.$prefix.'-'.$property['name'],
							'value' => $property['value']
						);
					}
				}

				//Values
				if ($fn = $this->value_fn_prefixes[$property['name']]) {
					foreach ($this->value_fn_prefixes[$property['name']] as $property_value => $fn) {
						if (preg_match('/(^|[^-])'.preg_quote($property_value, '/').'([^\w]|$)?/', implode($property['value']))) {
							$this->$fn($new_code, $property['name'], $property['value']);
						}
					}
				}

				if ($this->value_prefixes[$property['name']]) {
					foreach ($this->value_prefixes[$property['name']] as $property_value => $prefixes) {
						if (preg_match('/(^|[^-])'.preg_quote($property_value, '/').'([^\w]|$)?/', implode($property['value']))) {
							foreach ($prefixes as $prefix) {
								$new_values = array();

								foreach ($property['value'] as $v) {
									$new_values[] = str_replace($property_value, '-'.$prefix.'-'.$property_value, $v);
								}

								$new_code['properties'][] = array(
									'name' => $property['name'],
									'value' => $new_values
								);
							}
						}
					}
				}
			}

			//Content
			if ($code['content']) {
				$new_code['content'] = $this->_transform($code['content']);
			}

			$new_array_code[] = $new_code;

			//Selectors
			if (!$code['type']) {
				foreach ($code['selector'] as $selector) {
					foreach ($this->selector_prefixes as $selector_prefix => $prefixes) {
						if (strpos($selector, $selector_prefix) !== false) {
							foreach ($prefixes as $prefix) {
								
								$new_array_code[] = array(
									'selector' => array(str_replace($selector_prefix, $prefix, $selector)),
									'type' => $code['type'],
									'properties' => $code['properties'],
									'is_css' => $code['is_css'],
									'content' => $code['content']
								);
							}
						}
					}
				}
			}
		}

		return $new_array_code;
	}


	/**
	 * private function borderRadius (&array $code, array $name, array $values)
	 *
	 * Return array
	 */
	private function borderRadius (&$code, $name, $values) {
		switch ($name) {
			case 'border-top-right-radius':
				$code['properties'][] = array(
					'name' => '-moz-border-radius-topright',
					'value' => $values
				);
				return;

			case 'border-top-left-radius':
				$code['properties'][] = array(
					'name' => '-moz-border-radius-topleft',
					'value' => $values
				);
				return;

			case 'border-bottom-right-radius':
				$code['properties'][] = array(
					'name' => '-moz-border-radius-bottomright',
					'value' => $values
				);
				return;

			case 'border-bottom-left-radius':
				$code['properties'][] = array(
					'name' => '-moz-border-radius-bottomleft',
					'value' => $values
				);
				return;
		}
	}


	/**
	 * private function linearGradient (&string $code, string $name, array $values)
	 *
	 * Return array
	 */
	private function linearGradient (&$code, $name, $values) {
		foreach ($values as $k => $value) {
			$sub_values = $this->Css->explode($value, ' ');

			foreach ($sub_values as $sk => $sub_value) {
				if (strpos($sub_value, 'linear-gradient') === false) {
					continue;
				}

				list($function, $params) = current($this->Css->explodeFunctions($sub_value));

				$point = 'top';

				if (preg_match('/(top|bottom|left|right|deg)/', $params[0])) {
					$point = array_shift($params);
				}

				switch ($point) {
					case 'top':
					case '90deg':
						$start = 'left top';
						$end = 'left bottom';
						break;

					case 'bottom':
					case '-90deg':
						$start = 'left bottom';
						$end = 'left top';
						break;

					case 'left':
					case '180deg':
					case '-180deg':
						$start = 'left top';
						$end = 'right top';
						break;

					case 'right':
					case '0deg':
					case '360deg':
						$start = 'right top';
						$end = 'left top';
						break;
				}

				$sub_values[$sk] = '-webkit-gradient(linear, '.$start.', '.$end.', from('.$params[0].'), to('.$params[1].'))';
			}

			$values[$k] = implode(' ', $sub_values);
		}

		$code['properties'][] = array(
			'name' => $name,
			'value' => $values
		);
	}
}