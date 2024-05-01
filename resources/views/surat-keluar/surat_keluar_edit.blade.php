<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Surat Keluar</div>

                    <div class="card-body">
                        <form action="{{ route('surat_keluar.update', $suratKeluar->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="tujuan_surat" class="form-label">Tujuan Surat</label>
                                <input type="text" class="form-control" id="tujuan_surat" name="tujuan_surat" value="{{ $suratKeluar->tujuan_surat }}">
                            </div>
                            <div class="mb-3">
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" id="no_surat" name="no_surat" value="{{ $suratKeluar->no_surat }}">
                            </div>
                            <div class="mb-3">
                                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $suratKeluar->tgl_terbit }}">
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi</label>
                                <textarea class="form-control" id="isi" name="isi" rows="5">{{ $suratKeluar->isi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
