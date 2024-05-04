<x-app-layout>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Agenda</h6>
                <div class="float-right">
                    <button class="btn btn-secondary" id="exportData">Export Data</button>
                </div>
            </div>            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Agenda Surat Masuk</th>
                                <th>Nomor Surat Masuk</th>
                                <th>Nomor Agenda Surat Keluar</th>
                                <th>Nomor Surat Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agendas as $index => $agenda)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $agenda->no_agenda_sm }}</td>
                                    <td>{{ $agenda->surat_masuk }}</td>
                                    <td>{{ $agenda->no_agenda_sk }}</td>
                                    <td>{{ $agenda->surat_keluar }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
