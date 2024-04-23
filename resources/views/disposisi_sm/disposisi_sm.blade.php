<!-- resources/views/disposisi_sm/disposisi_sm.blade.php -->

<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Daftar Disposisi Surat Masuk</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">
                            <!-- Tambah Disposisi Surat Masuk Button -->
                            <a href="{{ route('disposisi_sm.create') }}" class="btn btn-primary mr-2">Tambah Disposisi Surat Masuk</a>
                            <!-- End of Tambah Disposisi Surat Masuk Button -->
                        </div>

                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari disposisi surat masuk...">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pengirim</th>
                                        <th>Surat Masuk</th>
                                        <th>Tujuan</th>
                                        <th>Catatan</th>
                                        <th>Tanggal Disposisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disposisi_sm as $index => $disposisi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $disposisi->user->name }}</td>
                                            <td>{{ $disposisi->surat_masuk->judul }}</td>
                                            <td>{{ $disposisi->tujuan }}</td>
                                            <td>{{ $disposisi->catatan }}</td>
                                            <td>{{ $disposisi->created_at->format('d/m/Y H:i:s') }}</td>
                                            <td>
                                                {{-- Tambahkan tombol aksi di sini --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            @if($disposisi_sm->previousPageUrl())
                                <a href="{{ $disposisi_sm->previousPageUrl() }}" class="btn btn-secondary">&laquo; Sebelumnya</a>
                            @else
                                <button class="btn btn-secondary" disabled>&laquo; Sebelumnya</button>
                            @endif

                            <!-- Total Data -->
                            <div>
                                <p class="mb-0" style="color: blue; font-weight: bold;">Total disposisi surat masuk: {{ $disposisi_sm->total() }}</p>
                            </div>
                            <!-- End of Total Data -->

                            @if($disposisi_sm->nextPageUrl())
                                <a href="{{ $disposisi_sm->nextPageUrl() }}" class="btn btn-secondary">Selanjutnya &raquo;</a>
                            @else
                                <button class="btn btn-secondary" disabled>Selanjutnya &raquo;</button>
                            @endif
                        </div>
                        <!-- End of Pagination Buttons -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Kode JavaScript untuk DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        }); --}}
    </script>
</x-app-layout>
