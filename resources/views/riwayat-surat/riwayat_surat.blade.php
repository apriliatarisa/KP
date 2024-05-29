<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Surat
        </h2>
    </x-slot>

    <style>
        th {
            text-align: center;
        }

        .action-buttons {
            margin-left: auto;
        }

        .action-buttons button {
            margin-right: 10px;
        }

        .filter-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Surat</h6>
                <div class="filter-controls ml-3">
                    <select id="filterCategory" class="form-control">
                        <option value="">Semua Kategori</option>
                        <option value="surat_masuk">Surat Masuk</option>
                        <option value="surat_keluar">Surat Keluar</option>
                    </select>
                    <input type="number" id="filterYear" class="form-control" placeholder="Tahun">
                </div>
                <div class="action-buttons">
                    <!-- Export Button -->
                    <button class="btn btn-secondary" id="exportData">Export Data</button>
                    <!-- Print PDF Button -->
                    <button class="btn btn-secondary" id="printPdf">Print</button>
                </div>
            </div>
        </div>


            <div class="card-body">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari riwayat surat...">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Jenis Surat</th>
                                <th>Petugas</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayatSurat as $index => $riwayat)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $riwayat->no_surat }}</td>
                                    <td>{{ $riwayat->jenis_surat }}</td>
                                    <td>{{ $riwayat->petugas }}</td>
                                    <td>{{ $riwayat->tahun }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Data -->
                <div>
                    <center><p class="mb-0" style="color: blue; font-weight: bold;">Total riwayat surat: {{ $riwayatSurat->count() }}</p></center>
                </div>
                <!-- End of Total Data -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.16/jspdf.plugin.autotable.min.js"></script>
    <script>
        // Fungsi untuk filter tabel berdasarkan kategori dan tahun
        document.getElementById("filterCategory").addEventListener("change", filterTable);
        document.getElementById("filterYear").addEventListener("input", filterTable);

        function filterTable() {
            var category = document.getElementById("filterCategory").value.toLowerCase();
            var year = document.getElementById("filterYear").value;
            var rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach(function(row) {
                var rowCategory = row.cells[2].innerText.toLowerCase();
                var rowYear = row.cells[4].innerText;
                var showRow = true;

                if (category && !rowCategory.includes(category)) {
                    showRow = false;
                }

                if (year && rowYear !== year) {
                    showRow = false;
                }

                row.style.display = showRow ? "" : "none";
            });
        }

        // Fungsi untuk ekspor data CSV
        document.getElementById("exportData").addEventListener("click", function() {
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Nomor Surat,Jenis Surat,Petugas,Tahun\n";
            var rows = document.querySelectorAll("#dataTable tbody tr");
            
            rows.forEach(function(row) {
                if (row.style.display !== "none") {
                    var cells = row.cells;
                    var rowContent = [
                        cells[1].innerText,
                        cells[2].innerText,
                        cells[3].innerText,
                        cells[4].innerText
                    ].join(",");
                    csvContent += rowContent + "\n";
                }
            });

            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "riwayat_surat.csv");
            document.body.appendChild(link);
            link.click();
        });

        // Fungsi untuk cetak PDF
        document.getElementById("printPdf").addEventListener("click", function() {
            var { jsPDF } = window.jspdf;
            var doc = new jsPDF();

            // Ambil hanya baris yang ditampilkan
            var tableRows = [];
            var rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach(function(row) {
                if (row.style.display !== "none") {
                    var rowData = [];
                    for (var i = 0; i < row.cells.length; i++) {
                        rowData.push(row.cells[i].innerText);
                    }
                    tableRows.push(rowData);
                }
            });

            doc.autoTable({
                head: [['No', 'Nomor Surat', 'Jenis Surat', 'Petugas', 'Tahun']],
                body: tableRows,
                styles: {
                    halign: 'center' // Center align text in each cell
                }
            });

            // Buka jendela baru untuk PDF
            var pdfWindow = window.open("", "_blank");
            pdfWindow.document.write("<iframe width='100%' height='100%' src='" + doc.output('datauristring') + "'></iframe>");

            // Cetak jendela setelah beberapa saat untuk memastikan PDF sudah dimuat
            setTimeout(function() {
                pdfWindow.print();
            }, 1000); // Sesuaikan waktu ini jika perlu
        });
    </script>
</x-app-layout>
