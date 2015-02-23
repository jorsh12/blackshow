<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\extensions\helper;

use lithium\util\Set;
use lithium\util\Inflector;

class Form extends \lithium\template\helper\Form {

	protected function _init() {
		parent::_init();

		$this->config(array(
			'templates' => array(
				'error' => '<p{:options}>{:content}</p>',
			),
			'error' => array(
				'class' => 'help-block'
			),
			'submit' => array(
				'class' => 'btn btn-primary',
			),
			'field' => array(
				'wrap' => array(
					'class' => 'form-group'
				),
			),
			'text' => array(
				'class' => 'form-control',
			),
			'password' => array(
				'class' => 'form-control',
			),
			'textarea' => array(
				'class' => 'form-control',
			),
			'select' => array(
				'class' => 'form-control',
			),
			'number' => array(
				'class' => 'form-control',
			),
			'email' => array(
				'class' => 'form-control',
			),
			'date' => array(
				'class' => 'form-control',
			),
			'time' => array(
				'class' => 'form-control',
			),
			'datetime' => array(
				'class' => 'form-control',
			),
			'datetime-local' => array(
				'class' => 'form-control',
			),
			'url' => array(
				'class' => 'form-control',
			),
			'tel' => array(
				'class' => 'form-control',
			),
			'range' => array(
				'class' => 'form-control',
			),
			'color' => array(
				'class' => 'form-control',
			),
			'month' => array(
				'class' => 'form-control',
			),
			'week' => array(
				'class' => 'form-control',
			),
		));
	}

	/**
	 * Generates a form field with a label, input, and error message (if applicable), all contained
	 * within a wrapping element.
	 *
	 * {{{
	 *  echo $this->form->field('name');
	 *  echo $this->form->field('present', array('type' => 'checkbox'));
	 *  echo $this->form->field(array('email' => 'Enter a valid email'));
	 *  echo $this->form->field(array('name','email','phone'), array('div' => false));
	 * }}}
	 *
	 * @param mixed $name The name of the field to render. If the form was bound to an object
	 *        passed in `create()`, `$name` should be the name of a field in that object.
	 *        Otherwise, can be any arbitrary field name, as it will appear in POST data.
	 *        Alternatively supply an array of fields that will use the same options
	 *        array($field1 => $label1, $field2, $field3 => $label3)
	 * @param array $options Rendering options for the form field. The available options are as
	 *        follows:
	 *        - `'label'` _mixed_: A string or array defining the label text and / or
	 *          parameters. By default, the label text is a human-friendly version of `$name`.
	 *          However, you can specify the label manually as a string, or both the label
	 *          text and options as an array, i.e.:
	 *          `array('Your Label Title' => array('class' => 'foo', 'other' => 'options'))`.
	 *        - `'type'` _string_: The type of form field to render. Available default options
	 *          are: `'text'`, `'textarea'`, `'select'`, `'checkbox'`, `'password'` or
	 *          `'hidden'`, as well as any arbitrary type (i.e. HTML5 form fields).
	 *        - `'template'` _string_: Defaults to `'template'`, but can be set to any named
	 *          template string, or an arbitrary HTML fragment. For example, to change the
	 *          default wrapper tag from `<div />` to `<li />`, you can pass the following:
	 *          `'<li{:wrap}>{:label}{:input}{:error}</li>'`.
	 *        - `'wrap'` _array_: An array of HTML attributes which will be embedded in the
	 *          wrapper tag.
	 *        - `list` _array_: If `'type'` is set to `'select'`, `'list'` is an array of
	 *          key/value pairs representing the `$list` parameter of the `select()` method.
	 * @return string Returns a form input (the input type is based on the `'type'` option), with
	 *         label and error message, wrapped in a `<div />` element.
	 */
	public function field($name, array $options = array()) {
		if (is_array($name)) {
			return $this->_fields($name, $options);
		}
		list(, $options, $template) = $this->_defaults(__FUNCTION__, $name, $options);
		$defaults = array(
			'label' => null,
			'type' => isset($options['list']) ? 'select' : 'text',
			'template' => $template,
			'wrap' => array(),
			'list' => null
		);
		list($options, $field) = $this->_options($defaults, $options);

		$label = $input = null;
		$wrap = $options['wrap'];
		$type = $options['type'];
		$list = $options['list'];
		$template = $options['template'];
		$notText = $template === 'field' && $type !== 'text';

		if ($notText && $this->_context->strings('field-' . $type)) {
			$template = 'field-' . $type;
		}
		if (($options['label'] === null || $options['label']) && $options['type'] !== 'hidden') {
			if (!$options['label']) {
				$options['label'] = Inflector::humanize(preg_replace('/[\[\]\.]/', '_', $name));
			}
			$label = $this->label(isset($options['id']) ? $options['id'] : '', $options['label']);
		}

		$call = ($type === 'select') ? array($name, $list, $field) : array($name, $field);
		$input = call_user_func_array(array($this, $type), $call);
		$error = ($this->_binding) ? $this->error($name) : null;

		if ($error) {
			//# @FIXME: Hacer estas clases de css customisables.
			$wrap['class'] .= ' has-error';
		}

		return $this->_render(__METHOD__, $template, compact('wrap', 'label', 'input', 'error'));
	}

	public function fields(array $fields = array()) {
		$result = array();
		foreach ($fields as $field => $options) {
			if (is_numeric($field)) {
				$field = $options;
				$options = array();
			}
			$result[] = $this->field($field, $options);
		}
		return join("\n", $result);
	}

	public function fromEntity($binding, array $whitelist = array()) {
		if ($entity = $this->binding($binding)) {
			$fields = $entity->formFields($whitelist, $binding);
			return $this->fields($fields);
		}
	}
}
