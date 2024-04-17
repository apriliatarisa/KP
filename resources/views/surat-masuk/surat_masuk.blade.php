<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Surat Masuk</div>

                    <div class="card-body">
                        <a href="{{ route('surat_masuk.create') }}" class="btn btn-primary mb-3">Tambah Surat Masuk</a>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Asal Surat</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">Tanggal Terima</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Aksi</th> <!-- Tambah kolom aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suratMasuk as $surat)
                                <tr>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ $surat->tgl_terima }}</td>
                                    <td>
                                        @if($surat->file)
                                            <a href="{{ asset('storage/' . $surat->file) }}" class="btn btn-sm btn-info">Unduh</a>
                                        @else
                                            <span class="text-muted">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td>{{ $surat->isi }}</td>
                                    {{-- <td>
                                        <a href="{{ route('surat_masuk.show', $surat->id) }}" class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('surat_masuk.edit', $surat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('surat_masuk.destroy', $surat->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus surat masuk ini?')">Hapus</button>
                                        </form>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
