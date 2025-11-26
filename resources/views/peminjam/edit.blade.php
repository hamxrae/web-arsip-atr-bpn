@extends('layouts.app')

@section('content')
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .form-header {
        background: linear-gradient(135deg, #004d00 0%, #006600 100%);
        color: white;
        padding: 30px;
        border-radius: 15px 15px 0 0;
        margin-bottom: 0;
    }

    .form-header h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 0;
    }

    .form-body {
        background: white;
        border-radius: 0 0 15px 15px;
        padding: 40px 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        color: #333;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        font-weight: 500;
        background-color: #f9f9f9;
        width: 100%;
    }

    .form-control:focus {
        outline: none;
        border-color: #004d00;
        background-color: white;
        box-shadow: 0 0 0 4px rgba(0, 77, 0, 0.12);
    }

    .form-control::placeholder {
        color: #aaa;
    }

    .photo-section {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 20px;
        align-items: start;
        margin-bottom: 25px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
        border: 1px solid #e0e0e0;
    }

    .photo-preview {
        text-align: center;
    }

    .photo-preview img {
        width: 100%;
        max-width: 150px;
        height: auto;
        border-radius: 10px;
        border: 2px solid #e0e0e0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .photo-preview-placeholder {
        width: 150px;
        height: 150px;
        background: linear-gradient(135deg, #004d00, #006600);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 40px;
        margin: 0 auto;
    }

    .file-input-wrapper {
        position: relative;
    }

    .file-input-label {
        display: block;
        padding: 20px;
        border: 2px dashed #004d00;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: white;
    }

    .file-input-label:hover {
        background-color: rgba(0, 77, 0, 0.05);
        border-color: #006600;
    }

    .file-input {
        display: none;
    }

    .file-input-text {
        color: #004d00;
        font-weight: 600;
        font-size: 14px;
        margin: 0;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 35px;
    }

    .btn-submit {
        flex: 1;
        padding: 14px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #004d00 0%, #006600 100%);
        color: white;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 77, 0, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #006600 0%, #008000 100%);
        box-shadow: 0 6px 20px rgba(0, 77, 0, 0.4);
        transform: translateY(-2px);
    }

    .btn-cancel {
        flex: 1;
        padding: 14px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        background: white;
        color: #666;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        text-align: center;
    }

    .btn-cancel:hover {
        border-color: #004d00;
        color: #004d00;
        background: #f9f9f9;
    }

    @media (max-width: 768px) {
        .form-body {
            padding: 25px 20px;
        }

        .photo-section {
            grid-template-columns: 1fr;
        }

        .button-group {
            flex-direction: column;
        }
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h3><i class="fas fa-user-edit"></i> Edit Data Peminjam</h3>
    </div>

    <div class="form-body">
        @if($errors->any())
            <div style="background: #fee; padding: 15px; border-radius: 10px; border-left: 4px solid #dc3545; margin-bottom: 20px;">
                <h5 style="color: #dc3545; margin-bottom: 10px;">
                    <i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan
                </h5>
                <ul style="margin: 0; padding-left: 20px; color: #c33;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('peminjam.update', $peminjam->id) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <!-- Nama Peminjam -->
            <div class="form-group">
                <label for="nama_peminjam">
                    <i class="fas fa-user" style="margin-right: 5px;"></i> Nama Peminjam
                </label>
                <input 
                    type="text" 
                    name="nama_peminjam" 
                    id="nama_peminjam"
                    class="form-control @error('nama_peminjam') is-invalid @enderror" 
                    value="{{ old('nama_peminjam', $peminjam->nama_peminjam) }}"
                    required
                >
                @error('nama_peminjam')
                    <span class="error-message">
                        <i class="fas fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- No HP -->
            <div class="form-group">
                <label for="no_hp">
                    <i class="fas fa-phone" style="margin-right: 5px;"></i> Nomor HP
                </label>
                <input 
                    type="tel" 
                    name="no_hp" 
                    id="no_hp"
                    class="form-control @error('no_hp') is-invalid @enderror" 
                    value="{{ old('no_hp', $peminjam->no_hp) }}"
                    required
                >
                @error('no_hp')
                    <span class="error-message">
                        <i class="fas fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">
                    <i class="fas fa-envelope" style="margin-right: 5px;"></i> Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    class="form-control @error('email') is-invalid @enderror" 
                    value="{{ old('email', $peminjam->email) }}"
                    required
                >
                @error('email')
                    <span class="error-message">
                        <i class="fas fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Surat Ukur -->
            <div class="form-group">
                <label for="surat_ukur_id">
                    <i class="fas fa-file" style="margin-right: 5px;"></i> Surat Ukur
                </label>
                <select 
                    name="surat_ukur_id" 
                    id="surat_ukur_id"
                    class="form-control @error('surat_ukur_id') is-invalid @enderror" 
                    required
                >
                    @foreach($suratUkur as $surat)
                        <option value="{{ $surat->id }}" {{ $peminjam->surat_ukur_id == $surat->id ? 'selected' : '' }}>
                            {{ $surat->no_surat_tanah }}
                        </option>
                    @endforeach
                </select>
                @error('surat_ukur_id')
                    <span class="error-message">
                        <i class="fas fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Foto -->
            <div class="form-group">
                <label><i class="fas fa-image" style="margin-right: 5px;"></i> Foto Profil</label>
                
                @if($peminjam->foto)
                    <div class="photo-section">
                        <div class="photo-preview">
                            <p style="margin-bottom: 10px; color: #666; font-size: 12px; text-transform: uppercase; font-weight: 600;">Foto Saat Ini</p>
                            <img src="{{ asset('storage/peminjam/'.$peminjam->foto) }}" alt="Foto Peminjam">
                        </div>
                        <div>
                            <div class="file-input-wrapper">
                                <label class="file-input-label" for="foto">
                                    <div class="file-input-text">
                                        <i class="fas fa-cloud-upload-alt" style="font-size: 24px; display: block; margin-bottom: 10px;"></i>
                                        Klik untuk ganti foto
                                    </div>
                                </label>
                                <input 
                                    type="file" 
                                    name="foto" 
                                    id="foto"
                                    class="file-input" 
                                    accept="image/*"
                                >
                            </div>
                        </div>
                    </div>
                @else
                    <div class="file-input-wrapper">
                        <label class="file-input-label" for="foto">
                            <div class="file-input-text">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 28px; display: block; margin-bottom: 10px;"></i>
                                Klik untuk upload atau drag & drop
                            </div>
                        </label>
                        <input 
                            type="file" 
                            name="foto" 
                            id="foto"
                            class="file-input" 
                            accept="image/*"
                        >
                    </div>
                @endif
                @error('foto')
                    <span class="error-message">
                        <i class="fas fa-times-circle"></i>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('peminjam.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Drag and drop for file input
    const fileInput = document.getElementById('foto');
    const fileInputLabel = document.querySelector('.file-input-label');

    if (fileInputLabel) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileInputLabel.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileInputLabel.addEventListener(eventName, () => {
                fileInputLabel.style.backgroundColor = 'rgba(0, 77, 0, 0.1)';
                fileInputLabel.style.borderColor = '#006600';
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileInputLabel.addEventListener(eventName, () => {
                fileInputLabel.style.backgroundColor = '#f9f9f9';
                fileInputLabel.style.borderColor = '#004d00';
            });
        });

        fileInputLabel.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
        });
    }
</script>
@endsection