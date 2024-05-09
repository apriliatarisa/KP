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
    </style>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Surat</h6>
                    <!-- Export Button -->
                    <button class="btn btn-secondary" id="exportData">Export Data</button>
                    <!-- End of Export Button -->
                </div>
            </div>
            <div class="card-body">

                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari riwayat surat...">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th> <!-- Berikan judul kolom No -->
                                <th>Nomor Surat</th>
                                <th>Jenis Surat</th>
                                <th>Petugas</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows here -->
                            @foreach ($riwayatSurat as $riwayat)
                                <tr>
                                    <!-- Table data for each riwayat surat -->
                                    <td>{{ $loop->index + 1 }}</td> <!-- Ubah menjadi loop index + 1 -->
                                    <td>{{ $riwayat->no_surat }}</td> <!-- Ubah menjadi no_surat -->
                                    <td>{{ $riwayat->jenis_surat }}</td>
                                    <td>{{ $riwayat->petugas }}</td>
                                    <td>{{ $riwayat->tahun }}</td> <!-- Ubah menjadi tahun -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    @if ($riwayatSurat->previousPageUrl())
                        <a href="{{ $riwayatSurat->previousPageUrl() }}" class="btn btn-secondary">&laquo; Sebelumnya</a>
                    @else
                        <button class="btn btn-secondary" disabled>&laquo; Sebelumnya</button>
                    @endif

                    <!-- Total Data -->
                    <div>
                        <p class="mb-0" style="color: blue; font-weight: bold;">Total riwayat surat:
                            {{ $riwayatSurat->total() }}</p>
                    </div>
                    <!-- End of Total Data -->

                    @if ($riwayatSurat->nextPageUrl())
                        <a href="{{ $riwayatSurat->nextPageUrl() }}" class="btn btn-secondary">Selanjutnya &raquo;</a>
                    @else
                        <button class="btn btn-secondary" disabled>Selanjutnya &raquo;</button>
                    @endif
                </div>
                <!-- End of Pagination Buttons -->

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                searching: true, // Aktifkan pencarian
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>
</x-app-layout>
