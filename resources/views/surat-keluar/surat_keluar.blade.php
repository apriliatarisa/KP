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
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
                    <!-- Export Button -->
                    <button class="btn btn-secondary" id="exportData">Export Data</button>
                    <!-- End of Export Button -->
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3">
                    <!-- Tambah Surat Keluar Button -->
                    <a href="{{ route('surat_keluar.create') }}" id="tambahSuratKeluar"
                        class="btn btn-primary mr-2">Tambah Surat Keluar</a>
                    <!-- End of Tambah Surat Keluar Button -->
                </div>

                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Cari surat keluar...">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tujuan Surat</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Terbit</th>
                                <th>Isi</th>
                                <th>Pengirim</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add your table rows here -->
                            @foreach ($suratKeluar as $surat)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $surat->tujuan_surat }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($surat->tgl_terbit)->format('d/m/Y') }}</td>
                                    <td>{{ $surat->isi }}</td>
                                    <td>{{ $surat->user->name }}</td>
                                    <td>{{ $surat->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($surat['file_path'])
                                            <a href="#"
                                                onclick="openPDF('{{ asset('storage/surat_keluar/' . $surat['file_path']) }}');"
                                                target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </a>
                                        @else
                                            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal"
                                                data-target="#staticBackdrop">
                                                <i class="fas fa-info-circle fa-fw"></i>
                                            </a>
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
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Kembali</button>
                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                              
                                        @if ($surat->id_user === Auth::id())
                                            <a href="{{ route('surat_keluar.edit', $surat->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit fa-fw"></i>
                                            </a>
                                        @endif

                                        <!-- Show "Delete" button only for the logged-in user -->
                                        <form action="{{ route('surat_keluar.destroy', $surat->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            @if ($surat->id_user === Auth::id())
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus surat keluar ini?')">
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
                    <center><p class="mb-0" style="color: blue; font-weight: bold;">Total surat keluar: {{ $suratKeluar->count() }}</p></center>
                </div>
                <!-- End of Total Data -->
            </div>
        </div>
    </div>

    <script>
        document.getElementById('exportData').addEventListener('click', function() {
            // Get table element
            var table = document.getElementById('dataTable');
            
            // Generate CSV content from table
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "No,Tujuan Surat,Nomor Surat,Tanggal Terbit,Isi,Pengirim,Tanggal Input\n";
            var rows = table.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].getElementsByTagName('td');
                var rowData = [];
                for (var j = 0; j < cells.length; j++) {
                    rowData.push(cells[j].innerText);
                }
                csvContent += rowData.join(',') + "\n";
            }
            
            // Create a CSV file and download
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "surat_keluar.csv");
            document.body.appendChild(link);
            link.click();
        });

        function openPDF(url) {
            window.open(url, '_blank');
        }
    </script>
</x-app-layout>
