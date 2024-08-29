<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		$search_query = $this->input->get('search');

        // Load JSON data
        $data = file_get_contents('application/views/dataoutstandmember.json');
        $menu = json_decode($data, true);
        $menu = $menu["menu"];

        // Filter data based on search query
        $filtered_data = array_filter($menu, function($item) use ($search_query) {
            foreach ($item as $value) {
                if (stripos($value, $search_query) !== false) {
                    return true;
                }
            }
            return false;
        });

        // Return filtered data as HTML
        $output = '';
        foreach ($filtered_data as $row) {
            $output .= '<li class="list-group-item">';
            $output .= 'Kode Nota: ' . $row["KodeNota"] . '<br>';
            $output .= 'Nama: ' . $row["Nama"] . '<br>';
            // Add more fields if necessary
            $output .= '</li>';
        }
        echo $output;
	}
}
