<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2016, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller
{

	/**
	 * Constructor.
	 * Establish view parameters & load common helpers
	 */

	function __construct()
	{
		parent::__construct();
		//  Set basic view parameters
		$this->data = array ();
		$this->data['pagetitle'] = 'CodeIgniter3.1 Starter 2';
		$this->data['ci_version'] = (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>'.CI_VERSION.'</strong>' : '';
		//Get user Role
		$this->data['userrole'] = $this->session->userdata('userrole');
		if ($this->data['userrole'] == NULL) $this->data['userrole'] = 'guest';
		if ($this->data['userrole'] == 'admin') $this->data['menudata'] = $this->config->item('adminmenudata');
		else if ($this->data['userrole'] == 'user') $this->data['menudata'] = $this->config->item('usermenudata');
		else  $this->data['menudata'] = $this->config->item('guestmenudata');
	}

	/**
	 * Render this page
	 */
	function render($template = 'template')
	{
    $this->data['menubar'] = $this->parser->parse('_menubar', $this->data,true);
		$this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
		$this->data['header'] = $this->parser->parse('_header', $this->data, true);
		$this->data['footer'] = $this->parser->parse('_footer', $this->data, true);
		$this->parser->parse('template', $this->data);
	}

}
