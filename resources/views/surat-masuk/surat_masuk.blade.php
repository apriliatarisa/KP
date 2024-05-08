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
                    <a href="{{ route('surat_masuk.create') }}" id="tambahSuratMasuk" class="btn btn-primary mr-2">Tambah
                        Surat Masuk</a>
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
                                <th>Isi</th>
                                <th>Penerima</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows here -->
                            @foreach ($suratMasuk as $surat)
                                <tr>
                                    <!-- Table data for each surat masuk -->
                                    <td>{{ $loop->index + 1 + ($suratMasuk->currentPage() - 1) * $suratMasuk->perPage() }}
                                    </td>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tgl_terima)->format('d/m/Y') }}</td>
                                    <td>{{ $surat->isi }}</td>
                                    <td>{{ $surat->user->name ?? '-' }}</td>
                                    <td>{{ $surat->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <!-- Show "Info" button if file_path exists -->
                                        @if ($surat['file_path'])
                                            <a href="#"
                                                onclick="openPDF('{{ asset('storage/surat_masuk/' . $surat['file_path']) }}');"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </a>
                                            <!-- If file_path doesn't exist, show "Tambah Berkas" button -->
                                        @else
                                            <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#staticBackdrop">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </button>
                                        @endif

                                        <!-- Modal for "Berkas tidak tersedia" -->
                                        <div class="modal fade" id="staticBackdrop" data-backdrop="static"
                                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <center>
                                                            <div class="alert alert-danger" role="alert">
                                                                <i class="fa fa-exclamation-triangle"
                                                                    aria-hidden="true"></i>
                                                                Berkas tidak tersedia!
                                                            </div>
                                                        </center>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                        <!-- Tautan untuk pergi ke halaman edit -->
                                                        @if(Auth::check() && Auth::user()->id == $surat->id_user)
                                                        <a href="{{ route('surat_keluar.edit', $surat->id) }}" class="btn btn-primary">Tambah Berkas</a>
                                                        @endif
                                                        <!-- End of Tautan -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Show "Edit" button only for the logged-in user -->
                                        @if ($surat->id_user === Auth::id())
                                            <a href="{{ route('surat_masuk.edit', $surat->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                        @else
                                        @endif

                                        <!-- Show "Delete" button only for the logged-in user -->
                                        <form action="{{ route('surat_masuk.destroy', $surat->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            @if ($surat->id_user === Auth::id())
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus surat masuk ini?')">
                                                    <i class="fas fa-trash fa-fw"></i>
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    @if ($suratMasuk->previousPageUrl())
                        <a href="{{ $suratMasuk->previousPageUrl() }}" class="btn btn-secondary">&laquo; Sebelumnya</a>
                    @else
                        <button class="btn btn-secondary" disabled>&laquo; Sebelumnya</button>
                    @endif

                    <!-- Total Data -->
                    <div>
                        <p class="mb-0" style="color: blue; font-weight: bold;">Total surat masuk:
                            {{ $suratMasuk->total() }}</p>
                    </div>
                    <!-- End of Total Data -->

                    @if ($suratMasuk->nextPageUrl())
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
        $(document).ready(function() {
            $('#dataTable').DataTable({
                searching: true, // Aktifkan pencarian
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

        function openPDF(url) {
            window.open(url, '_blank');
        }
    </script>
</x-app-layout>
