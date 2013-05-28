<?php defined('SYSPATH') or die('No direct script access.');

class Media_Compiler_RECESS extends Media_Compiler implements Media_ICompiler {

	protected $_option_map = array(
		'compress'               => 'compress',
		'no_ids'                 => 'noIDs',
		'no_js_prefix'           => 'noJSPrefix',
		'no_overqualifying'      => 'noOverqualifying',
		'no_underscores'         => 'noUnderscores',
		'no_universal_selectors' => 'noUniversalSelectors',
		'prefix_whitespace'      => 'prefixWhitespace',
		'strict_property_order'  => 'strictPropertyOrder',
		'strip_colors'           => 'stripColors',
		'zero_units'             => 'zeroUnits',
	);

	public function compile(array $filepaths, array $options)
	{
		$recess_cmd = 'recess :infile --compile ';
		foreach ($this->_option_map as $key => $cmd)
		{
			$recess_cmd .= "--$cmd {$options[$key]} ";
		}

		foreach ($filepaths as $relative_path => $absolute_path)
		{
			$cmd = str_replace(':infile', $absolute_path, $recess_cmd).' > '.$options['save_dir'].$options['css_dir'].DIRECTORY_SEPARATOR.str_replace('.less', '.css', basename($relative_path));
			exec($cmd);
		}
	}

}