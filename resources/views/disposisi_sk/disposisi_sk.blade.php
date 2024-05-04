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
                    @if(auth()->user()->unread_disposisi_keluar_count > 0)
                        <span class="badge badge-danger">{{ auth()->user()->unread_disposisi_keluar_count }}</span>
                    @endif
                    <!-- End of Menampilkan Jumlah Disposisi yang Belum Dibaca Surat Keluar -->
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
                                    <td>{{ $index + 1 + ($disposisi_sk->currentPage() - 1) * $disposisi_sk->perPage() }}</td>
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

                <!-- Pagination Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    @if($disposisi_sk->previousPageUrl())
                        <a href="{{ $disposisi_sk->previousPageUrl() }}" class="btn btn-secondary">&laquo; Sebelumnya</a>
                    @else
                        <button class="btn btn-secondary" disabled>&laquo; Sebelumnya</button>
                    @endif

                    <!-- Total Data -->
                    <div>
                        <p class="mb-0" style="color: blue; font-weight: bold;">Total disposisi surat keluar: {{ $disposisi_sk->total() }}</p>
                    </div>
                    <!-- End of Total Data -->

                    @if($disposisi_sk->nextPageUrl())
                        <a href="{{ $disposisi_sk->nextPageUrl() }}" class="btn btn-secondary">Selanjutnya &raquo;</a>
                    @else
                        <button class="btn btn-secondary" disabled>Selanjutnya &raquo;</button>
                    @endif
                </div>
                <!-- End of Pagination Buttons -->
            </div>
        </div>
    </div>

    <!-- Skrip DataTables -->
    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables dengan pencarian aktif dan tombol ekspor
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
