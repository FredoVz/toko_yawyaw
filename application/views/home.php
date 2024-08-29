<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Toko YawYaw</title>
<style>
    .
    .table th, .table td {
        vertical-align: middle;
        text-align: center;
        font-size: 12px;
    }

    .table thead {
        background-color: #f8f9fa;
        position: sticky;
        top: 0;
        z-index: 2; /* Ensure the header stays on top */
    }

    .pagination {
        margin-top: 20px;
    }

    .table-responsive {
        overflow-x: auto; /* Allow horizontal scrolling */
        position: relative;
        height: 560px; /* Adjust this height based on your needs */
    }

    #search-container {
        position: relative;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 20px;
    }

    #no-results {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        z-index: 4;
    }

    .custom-spacing {
        margin-right: 0.5rem;
        display: flex;
        align-items: center;
    }

    .clearable {
        position: relative;
    }
    .clearable input[type=text] {
        padding-right: 24px;
    }
    .clearable__clear {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        display: none;
    }
    .clearable input[type=text]:not(:placeholder-shown) + .clearable__clear {
        display: inline;
    }

    .table tbody {
        position: relative;
        /*display: block;*/
        overflow-y: auto;
        height: 500px; /* Adjust this height based on your needs */
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0px;
    }

    .table thead, .table tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .table-responsive thead th {
        position: sticky;
        top: 0;
        z-index: 3; /* Ensure the header stays on top */
    }

    .container-fluid, .container {
        max-width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }

</style>
</head>
<body>
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script-->
<div class="container-fluid mx-md-3">
    <div class="container mt-5 mx-md-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex flex-row align-items-center mb-3 mb-md-0">
                <div class="custom-spacing me-2">Show</div>
                <div class="custom-spacing me-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">10</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(10)">10</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(25)">25</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(50)">50</a></li>
                        <li><a class="dropdown-item" href="#" onclick="changeItemsPerPage(100)">100</a></li>
                    </ul>
                </div>
                <div class="ms-2"> Entries</div>
            </div>
            <div class="d-flex align-items-center flex-grow-1 justify-content-md-end">
                <div class="clearable position-relative">
                    <input type="text" id="search" class="form-control" placeholder="Search...">
                    <i class="clearable__clear" id="clear-button">&times;</i>
                </div>
                <button type="button" class="btn btn-primary ml-2" id="refresh-button"><i class="bi bi-arrow-clockwise"></i></button>
            </div>
        </div>
    </div>

    <div class="container mt-5 mx-md-3">
        <div class="table-responsive">
            <table class="table table-bordered" id="data-table">
                <thead id=data-head>
                    <tr>
                        <th scope="col" style="width:50px;" data-column="No">No <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="UserName">Username <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="Tgl">Tgl <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="Total">Total <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="VoucherProduk">Voucher Produk <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:150px;" data-column="TotalBayar">Total Bayar <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="MetodePembayaran">Metode Pembayaran <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="StatusBuktiPembayaran">Status Bukti Pembayaran <i class="bi bi-caret-down-fill"></i></th>
                        <th scope="col" style="width:102px;" data-column="StatusTrans">Status Trans <i class="bi bi-caret-down-fill"></i></th>
                    </tr>
                </thead>
                <tbody id="data-body">
                    <?php
                    $no = $offset + 1;
                    foreach ($paginated_menu as $row) : ?>
                        <tr>
                            <td scope="row" style="width:50px;" data-label="No"><?php echo $no++ ?></td>
                            <td scope="row" style="width:102px;" data-label="Username"><?php echo $row["UserName"] ?></td>
                            <td scope="row" style="width:102px;" data-label="Tgl"><?php echo $row["Tgl"] ?></td>
                            <td scope="row" style="width:102px;" data-label="Total"><?php echo $row["Total"] ?></td>
                            <td scope="row" style="width:102px;" data-label="Voucher Produk"><?php echo $row["VoucherProduk"] ?></td>
                            <td scope="row" style="width:150px;" data-label="Total Bayar"><?php echo $row["TotalBayar"] ?></td>
                            <td scope="row" style="width:102px;" data-label="Metode Pembayaran"><?php echo $row["MetodePembayaran"] ?></td>
                            <td scope="row" style="width:102px;" data-label="Status Bukti Pembayaran"><?php echo $row["StatusBuktiPembayaran"] ?></td>
                            <td scope="row" style="width:102px;" data-label="Status Trans"><?php echo $row["StatusTrans"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div id="no-results">No results found.</div>
        </div>
    </div>

    <div class="container mt-5 mx-md-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div id="entries-info" class="mb-3 mb-md-0">Showing 1 to 10 of 3053 entries</div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center justify-content-md-end">
                        <?php if ($current_page > 1): ?>
                            <!--li class="page-item">
                                <button class="page-link" onclick="navigatePage(1)">First</button>
                            </li-->
                            <li class="page-item">
                                <button class="page-link" onclick="navigatePage(<?php echo $current_page - 1; ?>)">Previous</button>
                            </li>
                        <?php else: ?>
                            <!--li class="page-item disabled">
                                <button class="page-link">First</button>
                            </li-->
                            <li class="page-item disabled">
                                <button class="page-link">Previous</button>
                            </li>
                        <?php endif; ?>

                        <?php
                        $start_page = max(1, $current_page - 1);
                        $end_page = min($total_pages, $current_page + 1);

                        if ($start_page > 1): ?>
                            <li class="page-item disabled">
                                <button class="page-link">...</button>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <?php if ($i == $current_page): ?>
                                <li class="page-item active">
                                    <!--button class="page-link">< ?php echo $i; ?> <span class="sr-only">(current)</span></button-->
                                    <button class="page-link"><?php echo $i; ?> <span class="sr-only"></span></button>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <button class="page-link" onclick="navigatePage(<?php echo $i; ?>)"><?php echo $i; ?></button>
                                </li>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($end_page < $total_pages): ?>
                            <li class="page-item disabled">
                                <button class="page-link">...</button>
                            </li>
                        <?php endif; ?>

                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <button class="page-link" onclick="navigatePage(<?php echo $current_page + 1; ?>)">Next</button>
                            </li>
                            <!--li class="page-item">
                                <button class="page-link" onclick="navigatePage(<?php echo $total_pages; ?>)">Last</button>
                            </li-->
                        <?php else: ?>
                            <li class="page-item disabled">
                                <button class="page-link">Next</button>
                            </li>
                            <!--li class="page-item disabled">
                                <button class="page-link">Last</button>
                            </li-->
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<script>
    var allData = <?php echo json_encode($menu); ?>;
    var itemsPerPage = <?php echo $items_per_page; ?>;
    var currentPage = <?php echo $current_page; ?>;
    var totalItems = allData.length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    var sortColumn = '';  // Default sort column
    var sortOrder = 'asc';  // Default sort order
    var filteredData = initializeData(allData);  // Clone allData to filteredData initially
    var button = document.getElementById('dropdownMenuButton');

    function initializeData(data) {
        return data.map((item, index) => {
            return { ...item, originalIndex: index + 1};
        });
    }

    function renderTable(data) {
        var $dataBody = $('#data-body');
        $dataBody.empty();
        var offset = (currentPage - 1) * itemsPerPage;
        var paginatedData = data.slice(offset, offset + itemsPerPage);

        var no = offset + 1; // Set nomor urut berdasarkan offset saat ini

        paginatedData.forEach(row => {
            $dataBody.append(`
                <tr>
                    <td scope="row" style="width:50px;" data-label="No">${row.originalIndex}</td>
                    <td scope="row" style="width:102px;" data-label="UserName">${row.UserName}</td>
                    <td scope="row" style="width:102px;" data-label="Tgl">${row.Tgl}</td>
                    <td scope="row" style="width:102px;" data-label="Total">${row.Total}</td>
                    <td scope="row" style="width:102px;" data-label="VoucherProduk">${row.VoucherProduk}</td>
                    <td scope="row" style="width:150px;" data-label="TotalBayar">${row.TotalBayar}</td>
                    <td scope="row" style="width:102px;" data-label="MetodePembayaran">${row.MetodePembayaran}</td>
                    <td scope="row" style="width:102px;" data-label="StatusBuktiPembayaran">${row.StatusBuktiPembayaran}</td>
                    <td scope="row" style="width:102px;" data-label="StatusTrans">${row.StatusTrans}</td>
                </tr>
            `);
        });

    }

    function sortData(column, order) {

        if (column === '') {
            return filteredData.slice();
        }

        if (column === 'No') {
            return filteredData.slice().sort((a, b) => {
                var valA = a.originalIndex;
                var valB = b.originalIndex;

                if (valA < valB) return order === 'asc' ? -1 : 1;
                if (valA > valB) return order === 'asc' ? 1 : -1;

                return 0;
            });
        }

        return filteredData.slice().sort((a, b) => {
            var valA = a[column] || '';
            var valB = b[column] || '';
            if (typeof valA === 'string') valA = valA.toLowerCase();
            if (typeof valB === 'string') valB = valB.toLowerCase();

            if (valA < valB) return order === 'asc' ? -1 : 1;
            if (valA > valB) return order === 'asc' ? 1 : -1;

            return 0;
        });
    }

    function navigatePage(page) {
        currentPage = page;
        var sortedData = sortData(sortColumn, sortOrder);
        renderTable(sortedData);
        updatePagination();
        updateEntriesInfo();
    }

    function updatePagination() {
        var $pagination = $('.pagination');
        $pagination.empty();

        if (currentPage > 1) {
            $pagination.append(`<li class="page-item"><button class="page-link" onclick="navigatePage(${currentPage - 1})">Previous</button></li>`);
        } else {
            $pagination.append(`<li class="page-item disabled"><button class="page-link">Previous</button></li>`);
        }

        var startPage = Math.max(1, currentPage - 1);
        var endPage = Math.min(totalPages, currentPage + 1);

        if (startPage > 1) {
            $pagination.append(`<li class="page-item disabled"><button class="page-link">...</button></li>`);
        }

        for (let i = startPage; i <= endPage; i++) {
            if (i === currentPage) {
                $pagination.append(`<li class="page-item active"><button class="page-link">${i} <span class="sr-only"></span></button></li>`);
            } else {
                $pagination.append(`<li class="page-item"><button class="page-link" onclick="navigatePage(${i})">${i}</button></li>`);
            }
        }

        if (endPage < totalPages) {
            $pagination.append(`<li class="page-item disabled"><button class="page-link">...</button></li>`);
        }

        if (currentPage < totalPages) {
            $pagination.append(`<li class="page-item"><button class="page-link" onclick="navigatePage(${currentPage + 1})">Next</button></li>`);
        } else {
            $pagination.append(`<li class="page-item disabled"><button class="page-link">Next</button></li>`);
        }
    }

    function debounce(func, wait) {
        var timeout;
        return function(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function changeItemsPerPage(newItemsPerPage) {
        itemsPerPage = newItemsPerPage;
        totalPages = Math.ceil(totalItems / itemsPerPage);
        currentPage = 1;
        var sortedData = sortData(sortColumn, sortOrder);
        renderTable(sortedData);
        updatePagination();
        updateEntriesInfo();
        button.textContent = `${newItemsPerPage}`;
    }

    function handleSort(column) {

        if (sortColumn === column) {
            sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            sortColumn = column;
            sortOrder = 'asc';
        }

        $('#data-head th').each(function() {
            var $this = $(this);
            var column = $this.data('column');
            var $icon = $this.find('i');
            if (column === sortColumn) {

                $icon.removeClass('bi-caret-down-fill bi-caret-up-fill').addClass(sortOrder === 'asc' ? 'bi-caret-up-fill' : 'bi-caret-down-fill');
            } else {
                $icon.removeClass('bi-caret-up-fill bi-caret-down-fill').addClass('bi-caret-down-fill');
            }
        });

        var sortedData = sortData(sortColumn, sortOrder);
        renderTable(sortedData);
        updatePagination();
        updateEntriesInfo();
    }

    function updateEntriesInfo() {
        var startEntry = (currentPage - 1) * itemsPerPage + 1;
        var endEntry = Math.min(currentPage * itemsPerPage, totalItems);
        $('#entries-info').text(`Showing ${startEntry} to ${endEntry} of ${totalItems} entries`);
    }

    $(document).ready(function() {
    function refreshTable() {
        var sortedData = sortData(sortColumn, sortOrder);
        renderTable(sortedData);
        updatePagination();
        updateEntriesInfo();
    }

    $('#search').on('keyup', debounce(function() {
    var query = $(this).val().toLowerCase(); 
    filteredData = initializeData(allData).filter(row => 
        Object.values(row).some(val => {
            // Pastikan val adalah string sebelum memanggil toLowerCase
            if (typeof val === 'string') {
                return val.toLowerCase().includes(query);
            }
            // Jika val bukan string, kita bisa memilih untuk mengabaikannya atau melakukan sesuatu
            return false;
        })
    );

    if (query.length > 2 && filteredData.length === 0) {
        $('#no-results').show();
    } else {
        $('#no-results').hide();
    }

    totalItems = filteredData.length;
    totalPages = Math.ceil(totalItems / itemsPerPage);
    currentPage = 1;
    refreshTable();
    }, 300));

    $('#data-head th').on('click', function() {
        var column = $(this).data('column');
        handleSort(column);
        updateEntriesInfo();
    });

    $('#refresh-button').on('click', function() {
        allData = <?php echo json_encode($menu); ?>;
        filteredData = initializeData(allData);
        totalItems = filteredData.length;
        totalPages = Math.ceil(totalItems / itemsPerPage);
        currentPage = 1;
        $('#no-results').hide();  // Pastikan pesan "No results found" disembunyikan
        refreshTable();
    });

    $('#clear-button').on('click', function() {
        $('#search').val('');
        allData = <?php echo json_encode($menu); ?>;
        filteredData = initializeData(allData);
        totalItems = filteredData.length;
        totalPages = Math.ceil(totalItems / itemsPerPage);
        currentPage = 1;
        $('#no-results').hide();  // Pastikan pesan "No results found" disembunyikan
        refreshTable();
    });

    filteredData = initializeData(allData);  // Initialize filteredData with allData on page load
    refreshTable();
    });
</script>
</body>
</html>
