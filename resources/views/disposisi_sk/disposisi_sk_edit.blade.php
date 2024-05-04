<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit Disposisi Surat Keluar</div>
                    <div class="card-body">
                        <!-- Form untuk mengedit disposisi surat keluar -->
                        <form action="{{ route('disposisi_sk.update', $disposisi_sk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Isian untuk surat keluar -->
                            <div class="mb-3">
                                <label for="surat_keluar" class="form-label">Pilih Surat Keluar</label>
                                <select class="form-select" id="surat_keluar" name="id_surat_keluar">
                                    @foreach($suratKeluarList as $suratKeluar)
                                        <option value="{{ $suratKeluar->id }}">{{ $suratKeluar->no_surat }}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <!-- Isian untuk penerima -->
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Pilih Pengguna Tujuan</label>
                                <div class="form-check">
                                    @foreach($users as $user)
                                        @if($user->id != auth()->user()->id) <!-- Cek apakah user yang sedang login bukan tujuan -->
                                            <input class="form-check-input" type="checkbox" id="user_{{ $user->id }}" name="tujuan[]" value="{{ $user->id }}">
                                            <label class="form-check-label" for="user_{{ $user->id }}">{{ $user->name }}</label><br>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- Isian untuk catatan -->
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $disposisi_sk->catatan }}</textarea>
                            </div>
                            <!-- Tombol untuk menyimpan perubahan -->
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>                        
                        <!-- End of Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
