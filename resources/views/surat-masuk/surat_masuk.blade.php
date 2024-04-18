<x-app-layout>
    <!-- HTML code for layout and meta tags -->

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Surat Masuk</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('surat_masuk.create') }}" class="btn btn-primary mb-3">Tambah Surat Masuk</a>
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
                            @foreach($suratMasuk as $index => $surat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
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
                                    {{-- <!-- Form for disposition -->
                                    <form action="{{ route('surat_masuk.disposisi', $surat->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <select name="user_id" class="form-control">
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda yakin ingin menyimpan dan mengirim surat masuk ini untuk disposisi?')">
                                            Disposisi
                                        </button>
                                    </form>
                                    <!-- End of Form for disposition --> --}}
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
            </div>
        </div>
    </div>
</x-app-layout>
@include('template.script')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
