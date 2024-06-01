<x-app-layout>
    <!-- HTML code for layout and meta tags -->
    <style>
        th {
            text-align: center;
        }
    </style>

    <div class="container-fluid">
        <!-- Pesan Flash -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
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
                                    <td>{{ $loop->index + 1 }}</td>
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

                <!-- Total Data -->
                <div>
                    <center><p class="mb-0" style="color: blue; font-weight: bold;">Total surat masuk: {{ $suratMasuk->count() }}</p></center>
                </div>
                <!-- End of Total Data -->
            </div>
        </div>
    </div>

    <script>
        document.getElementById('exportData').addEventListener('click', function() {
            var rows = Array.from(document.querySelectorAll('#dataTable tbody tr')).map(row => Array.from(row.querySelectorAll('td')).map(cell => cell.innerText));
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "No,Asal Surat,Nomor Surat,Tanggal Terima,Isi,Penerima,Tanggal Input\n";
            rows.forEach(function(row) {
                csvContent += row.join(',') + "\n";
            });
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "surat_masuk.csv");
            document.body.appendChild(link);
            link.click();
        });

        function openPDF(url) {
            window.open(url, '_blank');
        }

        
    </script>
</x-app-layout>
