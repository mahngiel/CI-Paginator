<?php

class Example extends CI_Controller {
	/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------
/**
 * Example Controller
 *
 * Recalls database objects and creates pagination
 *
 * @package	CodeIgniter
 * @subpackage		Paginator Controller
 * @category	Controller
 * @author		Mahngiel (a/k/a) Kris Reeck
 * @license		http://opensource.org/licenses/mit-license.php MIT License (MIT)
 * @filesource https://github.com/mahngiel/CI-Pagination
 */
	/**
	 * Constructor
	 *
	 */	
	function __construct()
	{
		// Call the Controller constructor
		parent::__construct();
		
		// Load models
		$this->load->model('News_model', 'news');
		
		// Load libraries
		$this->load->library('Paginator');		
	}
	
	// --------------------------------------------------------------------
	/**
	 * Index
	 *
	 * Example usage for pagination
	 * Expects an database with news articles
	 */
	function index()
	{		
		// Set option parameters for news retrieval
		$options = array('news_status' => 1, 'news_permission' => 1);
	 
		 // the URI segment where /page/ will reside
		$page = $this->uri->segment(3);
		// The count per page
		$per_page = 15;
		// The amount of results $options returns
		$results_count = $this->news->count_newsbits($options);
		
		// Send to pagination library
		$pages = $this->paginator->page_maker($page, $per_page, $results_count);
		
		// Retrieve news
		$newsbits = $this->news->get_newsbits($per_page, $pages->offset, $options);
		
		// Create a reference to newsbits & pages
		$this->data->newsbits =& $newsbits;
		$this->data->pages =& $pages;
	
		// Load the newsbits view
		$this->load->view( 'news', $this->data);
	}

}

/* End of file newsbits.php */
/* Location: ./application/controllers/example.php */