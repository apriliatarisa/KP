<x-app-layout>
    <!-- HTML code for layout and meta tags -->

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
                    <!-- Export Button -->
                    <button class="btn btn-secondary" id="exportData">Export Data</button>
                    <!-- End of Export Button -->
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3">
                    <!-- Tambah Surat Masuk Button -->
                    <a href="{{ route('surat_masuk.create') }}" id="tambahSuratMasuk" class="btn btn-primary mr-2">Tambah Surat Masuk</a>
                    <!-- End of Tambah Surat Masuk Button -->
                </div>

                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari surat masuk...">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Asal Surat</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Terima</th>
                                <th>File</th>
                                <th>Isi</th>
                                <th>Penerima</th> 
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows here -->
                            @foreach($suratMasuk as $surat)
                                <tr>
                                    <td>{{ $loop->index + 1 + ($suratMasuk->currentPage() - 1) * $suratMasuk->perPage() }}</td>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tgl_terima)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($surat->file_path)
                                            <a href="{{ asset('storage/surat_masuk/' . $surat->file_path) }}" class="btn btn-sm btn-info" download>Unduh</a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>{{ $surat->isi }}</td>
                                    <td>{{ $surat->user->name ?? '-' }}</td>
                                    <td>{{ $surat->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('surat_masuk.show', $surat->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-info-circle fa-fw"></i>
                                        </a>
                                        <a href="{{ route('surat_masuk.edit', $surat->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit fa-fw"></i>
                                        </a>
                                        <form action="{{ route('surat_masuk.destroy', $surat->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus surat masuk ini?')">
                                                <i class="fas fa-trash fa-fw"></i>
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
                    @if($suratMasuk->previousPageUrl())
                        <a href="{{ $suratMasuk->previousPageUrl() }}" class="btn btn-secondary">&laquo; Sebelumnya</a>
                    @else
                        <button class="btn btn-secondary" disabled>&laquo; Sebelumnya</button>
                    @endif

                    <!-- Total Data -->
                    <div>
                        <p class="mb-0" style="color: blue; font-weight: bold;">Total surat masuk: {{ $suratMasuk->total() }}</p>
                    </div>
                    <!-- End of Total Data -->

                    @if($suratMasuk->nextPageUrl())
                        <a href="{{ $suratMasuk->nextPageUrl() }}" class="btn btn-secondary">Selanjutnya &raquo;</a>
                    @else
                        <button class="btn btn-secondary" disabled>Selanjutnya &raquo;</button>
                    @endif
                </div>
                <!-- End of Pagination Buttons -->

            </div>
        </div>
    </div>

    
    <script>
        $(document).ready(function () {
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
