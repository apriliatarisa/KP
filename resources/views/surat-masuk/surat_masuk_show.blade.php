<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Surat Masuk</div>

                    <div class="card-body">
                        <p><strong>Asal Surat:</strong> {{ $suratMasuk->asal_surat }}</p>
                        <p><strong>Nomor Surat:</strong> {{ $suratMasuk->no_surat }}</p>
                        <p><strong>Tanggal Terima:</strong> {{ $suratMasuk->tgl_terima }}</p>
                        <p><strong>Isi:</strong> {{ $suratMasuk->isi }}</p>
                        @if($filePath)
                             <p><strong>File:</strong></p>
                             <!-- Menampilkan file PDF -->
                             <embed src="{{ asset('storage/' . $filePath) }}" type="application/pdf" width="100%" height="600px" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
