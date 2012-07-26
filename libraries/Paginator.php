<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
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
 * Pagination Library
 *
 * Prepares and creates pagination
 *
 * @package	CodeIgniter
 * @subpackage		CodeIgniter Media Library
 * @category	Library
 * @authors		Mahngiel (a/k/a) Kris Reeck, Brock Riemenschneider
 * @license		http://opensource.org/licenses/mit-license.php MIT License (MIT)
 * @filesource https://github.com/mahngiel/CI-Pagination-Library
 */
 
class Paginator {

	var $CI;
	
	/**
	 * Constructor
	 *
	 */	
	function __construct()
	{	
		// Create an instance to CI
		$this->CI =& get_instance();
	}
	
	// -------------------------------------------------------------------	
	/**
	 * Page Maker
	 *
	 * Creates pagination
	 *
	 * @access	private
	 * @param	string // URI of the /page/
	 * @param	integer // the count per page
	 * @param integer // total amount of items
	 * @return	object // contains all image information
	 */
	function page_maker($page, $per_page, $results_count)
	{
		// Check if page exists
		if($page == '')
		{
			// Page doesn't exist, assign it
			$page = 1;
		}
		
		//Set up the variables
		$offset = ($page - 1) * $per_page;
		
		$pages->total_pages = 0;
		
		// Create the pages
		for($i = 1; $i < ($results_count / $per_page) + 1; $i++)
		{
			// Itterate pages
			$pages->total_pages++;
		}
		
		// Check if there are no results
		if($results_count == 0)
		{
			// Assign total pages
			$pages->total_pages = 1;
		}
		
		// Set up pages
		$pages->current_page = $page;
		$pages->pages_left = ceil($results_count / $per_page);
		$pages->first = (bool) ($pages->current_page > $per_page);
		$pages->previous = (bool) ($pages->current_page > '1');
		$pages->next = (bool) ($pages->current_page != $pages->total_pages);
		$pages->before = array();
		$pages->after = array();
		
		// Check if the current page is towards the end
		if(($pages->current_page + $per_page) < $pages->total_pages)
		{
			// Current page is not towards the end, assign start
			$start = $pages->current_page - ($per_page - 1);
		}
		else
		{
			// Current page is towards the end, assign start
			$start = $pages->current_page - $pages->pages_left + ($pages->total_pages - $pages->current_page);
		}
		
		// Assign end
		$end = $pages->current_page + 1;

		// Loop through pages before the current page
		for($page = $start; ($page < $pages->current_page); $page++)
		{
			// Check if the page is vaild
			if($page > 0)
			{
				// Page is valid, add it the pages before, increment pages left
				$pages->before = array_merge($pages->before, array($page));
				$pages->pages_left--;
			}
		}
		
		// Loop through pages after the current page
		for($page = $end; ($pages->pages_left > 0 && $page <= $pages->total_pages); $page++)
		{
			// Add the page to pages after, increment pages left
			$pages->after = array_merge($pages->after, array($page));
			$pages->pages_left--;
		}
		
		// Set up pages
		$pages->last = (bool) (($pages->total_pages - $per_page) > $pages->current_page);
		
		$pages->offset = $offset;
		
		return $pages;
	} 


}

/* End of file pagination.php */
/* Location: ./czgaming/libraries/Pagination.php */