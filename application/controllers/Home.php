<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Load the database library
        //$this->load->database();
    }

	
	public function index()
	{
		// Read the DATABASE query
		// Replace 'your_table_name' with your actual table name
		// $query = $this->db->get('opc6');
		// Fetch the result as an array
        //$data['menu'] = $query->result_array();

		// Read the JSON file
        $json_data = file_get_contents('application/models/dataoutstandmember.json');
        //$json_data = file_get_contents('application/models/dataoutstandmember1.json');
        // JSON data as a string
		$json_data1 = '
		[
		    {
		    	"No": "1",
		        "KodeNota": "00BQ5/01/NS/2024/004738",
		        "KodeMember": "00BQ5/01/0002CS",
		        "Nama": "AMIN SUBROTO",
		        "UserName": "AMIN2",
		        "Tgl": "2024-08-01 12:38:12.917",
		        "TglKonfirmasi": "2024-08-01 13:15:11.853",
		        "Total": "500000.0000",
		        "VoucherProduk": ".0000",
		        "MetodePembayaran": "Transfer",
		        "StatusBuktiPembayaran": "Sudah",
		        "StatusTrans": "Sudah dikonfirmasi",
		        "AlasanBatal": "",
		        "BuktiTransfer": "TRF0047382024080112813213.png",
		        "AlamatKirim": "AMBIL SENDIRI",
		        "Gudang": "00BQ5/01/04",
		        "NamaGudang": "Master Stockist Arkana - JaBar",
		        "Alamat": "new anggrek 2 blok v3 no 38 Grand depok city Sukmajaya, depok",
		        "Kota": "Depok",
		        "TotalBayar": "500980.0000000",
		        "PPNPersenManual": ".0000",
		        "PPN": ".0000"
		    },
		    {
		    	"No": "2",
		        "KodeNota": "00BQ5/01/NS/2024/004737",
		        "KodeMember": "00BQ5/01/0002CR",
		        "Nama": "Miryam Ulikita Prihartini",
		        "UserName": "Ulikita",
		        "Tgl": "2024-08-01 12:38:09.933",
		        "TglKonfirmasi": "2024-08-01 13:15:02.307",
		        "Total": "500000.0000",
		        "VoucherProduk": ".0000",
		        "MetodePembayaran": "Transfer",
		        "StatusBuktiPembayaran": "Sudah",
		        "StatusTrans": "Sudah dikonfirmasi",
		        "AlasanBatal": "",
		        "BuktiTransfer": "TRF0047372024080101815213.png",
		        "AlamatKirim": "KANTOR BKKBN BABEL JL. P. BANGKA NO 10 KOMPLEK PERKANTORAN AIR ITAM, BangkaBelitung, PangkalPinang Kota, BukitIntan",
		        "Gudang": "00BQ5/01/04",
		        "NamaGudang": "Master Stockist Arkana - JaBar",
		        "Alamat": "new anggrek 2 blok v3 no 38 Grand depok city Sukmajaya, depok",
		        "Kota": "Depok",
		        "TotalBayar": "529515.0000000",
		        "PPNPersenManual": ".0000",
		        "PPN": ".0000"
		    }
		]';

		// Decode the JSON data
		$menu = json_decode($json_data, true);

		// Check for errors in decoding
		if (json_last_error() !== JSON_ERROR_NONE) {
			die('Error decoding JSON: ' . json_last_error_msg());
		}

        //$menu = $menu["menu"];

		// Get items per page from URL parameter or default to 10
		$items_per_page = isset($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 10;

		// Pagination variables
		$total_items = count($menu); // Total number of items
		$total_pages = ceil($total_items / $items_per_page); // Total number of pages

		// Get the current page number from URL parameter
		$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		if ($current_page < 1) $current_page = 1;
		if ($current_page > $total_pages) $current_page = $total_pages;

		// Calculate offset and limit
		$offset = ($current_page - 1) * $items_per_page;
		$paginated_menu = array_slice($menu, $offset, $items_per_page);

		// Prepare data to pass to the view
		$data['menu'] = $menu;
		$data['total_pages'] = $total_pages;
        $data['current_page'] = $current_page;
        $data['items_per_page'] = $items_per_page;
        $data['offset'] = $offset;
        $data['paginated_menu'] = $paginated_menu;

        // Load the view and pass the data
        $this->load->view('home', $data);
	}
}
