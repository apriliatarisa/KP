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
            margin-bottom: 10px;
        }

        .action-buttons button {
            margin-right: 10px;
        }
    </style>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Surat</h6>
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
        // Fungsi untuk ekspor data CSV
        document.getElementById("exportData").addEventListener("click", function() {
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "Nomor Surat,Jenis Surat,Petugas,Tahun\n";
            @foreach ($riwayatSurat as $riwayat)
                csvContent += "{{ $riwayat->no_surat }},{{ $riwayat->jenis_surat }},{{ $riwayat->petugas }},{{ $riwayat->tahun }}\n";
            @endforeach
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

            doc.autoTable({
                html: '#dataTable',
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
