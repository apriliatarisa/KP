<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Surat Masuk</div>

                    <div class="card-body">
                        <form action="{{ route('surat_masuk.update', $surat_masuk->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="asal_surat" class="form-label">Asal Surat</label>
                                <input type="text" class="form-control" id="asal_surat" name="asal_surat" value="{{ $surat_masuk->asal_surat }}">
                            </div>
                            <div class="mb-3">
                                <label for="no_surat" class="form-label">Nomor Surat</label>
                                <input type="text" class="form-control" id="no_surat" name="no_surat" value="{{ $surat_masuk->no_surat }}">
                            </div>
                            <div class="mb-3">
                                <label for="tgl_terima" class="form-label">Tanggal Terima</label>
                                <input type="date" class="form-control" id="tgl_terima" name="tgl_terima" value="{{ $surat_masuk->tgl_terima }}">
                            </div>
                            <div class="mb-3">
                                <label for="isi" class="form-label">Isi</label>
                                <textarea class="form-control" id="isi" name="isi" rows="5">{{ $surat_masuk->isi }}</textarea>
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
