<x-app-layout>
    <style>
        .disposisi-completed {
            background-color: #f2f2f2;
            color: #999;
            pointer-events: none;
        }
    </style>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Disposisi Surat Keluar</h6>
                    <!-- Menampilkan Jumlah Disposisi yang Belum Dibaca Surat Keluar -->
                    @if(auth()->user()->unread_disposisisk_count > 0)
                        <span class="badge badge-danger">{{ auth()->user()->unread_disposisisk_count }}</span>
                    @endif
                    <!-- End of Menampilkan Jumlah Disposisi yang Belum Dibaca Surat Keluar -->
                    <!-- Export Button -->
                    <button class="btn btn-secondary" id="exportData">Export Data</button>
                    <!-- End of Export Button -->
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3">
                    <!-- Tambah Disposisi Surat Keluar Button -->
                    <a href="{{ route('disposisi_sk.create') }}" id="tambahDisposisiSK" class="btn btn-primary mr-2">Tambah Disposisi Surat Keluar</a>
                    <!-- End of Tambah Disposisi Surat Keluar Button -->
                </div>

                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari disposisi surat keluar...">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pengirim</th>
                                <th>Surat Keluar</th>
                                <th>Tujuan</th>
                                <th>Catatan</th>
                                <th>Tanggal Disposisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows here -->
                            @foreach ($disposisi_sk as $index => $disposisi)
                                <tr class="{{ $disposisi->completed ? 'disposisi-completed' : '' }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $disposisi->pengirim->name }}</td>
                                    <td>{{ $disposisi->suratKeluar->no_surat }}</td>
                                    <td>{{ $disposisi->user->name }}</td>
                                    <td>{{ $disposisi->catatan }}</td>
                                    <td>{{ $disposisi->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td style="white-space: nowrap;">
                                        {{-- Tombol Menyelesaikan Disposisi --}}
                                        <form action="{{ route('mark_as_completed_sk', $disposisi->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success" {{ $disposisi->status ? 'disabled' : '' }}>
                                                <i class="fas fa-check fa-fw"></i> Tandai Selesai
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Data -->
                <div>
                    <center><p class="mb-0" style="color: blue; font-weight: bold;">Total disposisi surat keluar: {{ $disposisi_sk->count() }}</p></center>
                </div>
                <!-- End of Total Data -->
            </div>
        </div>
    </div>

    <!-- Skrip JavaScript untuk Ekspor Data -->
    <script>
        document.getElementById('exportData').addEventListener('click', function() {
            var rows = Array.from(document.querySelectorAll('#dataTable tbody tr')).map(row => Array.from(row.querySelectorAll('td')).map(cell => cell.innerText));
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "No,Pengirim,Surat Keluar,Tujuan,Catatan,Tanggal Disposisi\n";
            rows.forEach(function(row) {
                csvContent += row.join(',') + "\n";
            });
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "disposisi_surat_keluar.csv");
            document.body.appendChild(link);
            link.click();
        });
    </script>
</x-app-layout>
