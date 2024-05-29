<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Disposisi Surat Masuk</div>
                    <div class="card-body">
                        <form action="{{ route('disposisi_sm.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="surat_masuk" class="form-label">Pilih Surat Masuk</label>
                                <select class="form-select" id="surat_masuk" name="id_surat_masuk">
                                    @foreach($suratMasukList as $suratMasuk)
                                        <option value="{{ $suratMasuk->id }}">{{ $suratMasuk->no_surat }} - {{ $suratMasuk->isi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Pilih Pengguna Tujuan</label>
                                <div class="form-check">
                                    @foreach($users as $user)
                                        @if($user->id != auth()->user()->id) <!-- Cek apakah user yang sedang login bukan tujuan -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="user_{{ $user->id }}" name="tujuan[]" value="{{ $user->id }}">
                                                <label class="form-check-label" for="user_{{ $user->id }}">{{ $user->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
