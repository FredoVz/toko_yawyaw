<?php
	$data = file_get_contents('application/views/dataoutstandmember.json');
	$menu = json_decode($data, true);

	$menu = $menu["menu"];

    // Ambil query pencarian
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Filter data berdasarkan query pencarian
    $filtered_menu = array_filter($menu, function($item) use ($search) {
        return stripos($item["Nama"], $search) !== false ||
               stripos($item["KodeNota"], $search) !== false ||
               stripos($item["KodeMember"], $search) !== false ||
               stripos($item["UserName"], $search) !== false ||
               stripos($item["Tgl"], $search) !== false ||
               stripos($item["TglKonfirmasi"], $search) !== false ||
               stripos($item["Total"], $search) !== false ||
               stripos($item["VoucherProduk"], $search) !== false ||
               stripos($item["MetodePembayaran"], $search) !== false ||
               stripos($item["StatusBuktiPembayaran"], $search) !== false ||
               stripos($item["StatusTrans"], $search) !== false ||
               stripos($item["AlasanBatal"], $search) !== false ||
               stripos($item["BuktiTransfer"], $search) !== false ||
               stripos($item["AlamatKirim"], $search) !== false ||
               stripos($item["Gudang"], $search) !== false ||
               stripos($item["Alamat"], $search) !== false ||
               stripos($item["Kota"], $search) !== false ||
               stripos($item["TotalBayar"], $search) !== false ||
               stripos($item["PPNPersenManual"], $search) !== false ||
               stripos($item["PPN"], $search) !== false;
    });

    // Tampilkan hasil pencarian
    if (!empty($filtered_menu)) {
        $no = 1;

        echo '<div class="container mt-5">';
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered">';
        echo '<tbody>';
        echo '<thead>';
				echo '<tr>';
					echo '<th scope="col">No</th>';
					echo '<th scope="col">Kode Nota</th>';
					echo '<th scope="col">Kode Member</th>';
					echo '<th scope="col">Nama</th>';
					echo '<th scope="col">Username</th>';
					echo '<th scope="col">Tgl</th>';
					echo '<th scope="col">Tgl Konfirmasi</th>';
					echo '<th scope="col">Total</th>';
					echo '<th scope="col">Voucher Produk</th>';
					echo '<th scope="col">Metode Pembayaran</th>';
					echo '<th scope="col">Status Bukti Pembayaran</th>';
					echo '<th scope="col">Status Trans</th>';
					echo '<th scope="col">Alasan Batal</th>';
					echo '<th scope="col">Bukti Transfer</th>';
					echo '<th scope="col">Alamat Kirim</th>';
					echo '<th scope="col">Gudang</th>';
					echo '<th scope="col">Nama Gudang</th>';
					echo '<th scope="col">Alamat</th>';
					echo '<th scope="col">Kota</th>';
					echo '<th scope="col">Total Bayar</th>';
					echo '<th scope="col">PPN Persen Manual</th>';
					echo '<th scope="col">PPN</th>';
				echo '</tr>';
			echo '</thead>';

        foreach ($filtered_menu as $row) {

            echo '<tr>';
                echo '<td>' . htmlspecialchars($no++) . '</td>';
                echo '<td>' . htmlspecialchars($row["KodeNota"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["KodeMember"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Nama"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["UserName"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Tgl"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["TglKonfirmasi"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Total"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["VoucherProduk"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["MetodePembayaran"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["StatusBuktiPembayaran"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["StatusTrans"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["AlasanBatal"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["BuktiTransfer"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["AlamatKirim"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Gudang"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Alamat"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Kota"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["TotalBayar"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["PPNPersenManual"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["PPN"]) . '</td>';
            // Add other columns as needed
            echo '</tr>';

        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';

    } else {
        echo '<tr><td colspan="5">No results found</td></tr>';
    }
?>