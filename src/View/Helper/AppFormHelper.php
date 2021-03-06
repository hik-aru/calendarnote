<?php
namespace App\View\Helper;


use Cake\View\Helper\FormHelper;
use Cake\View\View;
use Cake\Error\Debugger;

/**
 * AppForm helper
 */
class AppFormHelper extends FormHelper
{

    /**
     * Default configuration.
     *
     * @var array
     */
	

    function input($fieldName, $options = array()) {
		$label = null;
		if(!empty($options['label'])) {
			$label = $options['label'];
		}
		$options['label'] = false;
		$out = '';
		$out .= '<tr>';
		$out .= '<th>';
		$out .= parent::label($fieldName, $label);
		$out .= '</th>';
		$out .= '<td>';
		$out .= parent::input($fieldName, $options);
		$out .= '</td>';
		$out .= '</tr>';

		return $out;
	}

	/**
	 * @example of use
	 * 		echo $appForm->create('Schedule');
	 * @example of output
	 * 		<form >
	 *			<tabel class="form">
	 *
	 */
	function create($model = null, $options = array()) {
		$out = parent::create($model, $options);
		$out .= '<table class="form">';
		return $out;
	}

	/**
	 * @example of use
	 * 		echo $appForm->end();
	 * @example of output
	 * 			</table>
	 *		</form>
	 *
	 */
	function end($options = null) {
		$out = '</table>';
		$out .= parent::end();
		return $out;
	}
}
