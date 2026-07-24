@extends('admin.layouts.app')
@section('title', 'Médiathèque')

@push('styles')
<style>
.media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
}
.media-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: 10px;
    overflow: hidden;
    background: #F0E8E0;
    cursor: pointer;
    transition: transform .2s;
}
.media-item:hover { transform: scale(1.02); }
.media-item img { width:100%;height:100%;object-fit:cover; }
.media-item .media-overlay {
    position: absolute;
    inset: 0;
    background: rgba(61,43,31,.6);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    opacity: 0;
    transition: opacity .2s;
}
.media-item:hover .media-overlay { opacity: 1; }
.media-overlay .media-name {
    font-size: 11px;
    color: #fff;
    text-align: center;
    padding: 0 8px;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.media-overlay .media-actions { display:flex;gap:8px; }
.media-btn {
    background: rgba(255,255,255,.2);
    border: 1px solid rgba(255,255,255,.3);
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
    transition: background .2s;
}
.media-btn:hover { background: rgba(255,255,255,.35); }
.media-btn.del { background: rgba(212,84,122,.4); border-color: rgba(212,84,122,.6); }
.media-btn.del:hover { background: rgba(212,84,122,.7); }

#dropZone.drag-over { border-color:var(--rose);background:rgba(212,84,122,.06); }
</style>
@endpush

@section('topbar-actions')
    <button onclick="document.getElementById('uploadInput').click()" class="topbar-btn">
        <i class="fa-solid fa-upload"></i> Uploader des images
    </button>
@endsection

@section('content')

<div class="card" style="margin-bottom:20px">
    <div class="card-body" style="padding:0">
        <div id="dropZone" class="upload-zone" style="border-radius:0;border:none;border-bottom:2px dashed #D0C8C0;padding:24px"
             onclick="document.getElementById('uploadInput').click()">
            <div class="icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
            <p>Glissez des images ici ou <strong>cliquez pour uploader</strong></p>
            <p style="margin-top:4px;font-size:11px">PNG, JPG, WEBP, GIF — max 5 Mo par image</p>
            <input type="file" id="uploadInput" multiple accept="image/*" style="display:none" onchange="uploadFiles(this.files)">
        </div>
        <div id="uploadProgress" style="display:none;padding:16px 24px">
            <div style="font-size:13px;font-weight:600;margin-bottom:8px;color:var(--dark)">Upload en cours...</div>
            <div style="background:#F0E8E0;border-radius:6px;height:6px;overflow:hidden">
                <div id="progressBar" style="background:var(--rose);height:100%;width:0;transition:width .3s;border-radius:6px"></div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ count($files) }} image(s)</h2>
        <div style="font-size:13px;color:#9A8070">Cliquez pour copier l'URL · Survolez pour les actions</div>
    </div>
    <div class="card-body">
        @if(count($files))
        <div class="media-grid" id="mediaGrid">
            @foreach($files as $file)
            <div class="media-item" id="media-{{ md5($file['path']) }}" onclick="copyUrl('{{ $file['url'] }}', this)">
                <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" loading="lazy">
                <div class="media-overlay">
                    <span class="media-name">{{ $file['name'] }}</span>
                    <div class="media-actions">
                        <button class="media-btn" onclick="event.stopPropagation();copyUrl('{{ $file['url'] }}', document.getElementById('media-{{ md5($file['path']) }}'))">
                            <i class="fa-solid fa-copy"></i> Copier
                        </button>
                        <button class="media-btn del" onclick="event.stopPropagation();deleteMedia('{{ $file['path'] }}','media-{{ md5($file['path']) }}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                    <span style="font-size:10px;color:rgba(255,255,255,.6)">{{ round($file['size']/1024) }} Ko</span>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:40px;color:#B0A098">
            <i class="fa-solid fa-images" style="font-size:48px;display:block;margin-bottom:16px"></i>
            Aucune image. Uploadez vos premières images ci-dessus.
        </div>
        @endif
    </div>
</div>

{{-- Toast notification --}}
<div id="toast" style="position:fixed;bottom:24px;right:24px;background:var(--dark);color:#fff;padding:12px 20px;border-radius:10px;font-size:14px;font-weight:500;display:none;z-index:300;box-shadow:0 8px 24px rgba(0,0,0,.2)">
    <i class="fa-solid fa-check-circle" style="color:#2ECC71;margin-right:8px"></i>
    <span id="toastMsg">Copié !</span>
</div>
@endsection

@push('scripts')
<script>
const uploadUrl  = "{{ route('admin.media.upload') }}";
const deleteUrl  = "{{ route('admin.media.destroy') }}";
const csrfToken  = "{{ csrf_token() }}";

// Drag & drop
const zone = document.getElementById('dropZone');
zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
zone.addEventListener('drop', e => {
    e.preventDefault();
    zone.classList.remove('drag-over');
    uploadFiles(e.dataTransfer.files);
});

function uploadFiles(files) {
    if (!files || !files.length) return;
    const fd = new FormData();
    Array.from(files).forEach(f => fd.append('files[]', f));
    fd.append('_token', csrfToken);

    document.getElementById('uploadProgress').style.display = 'block';
    document.getElementById('progressBar').style.width = '30%';

    fetch(uploadUrl, { method: 'POST', body: fd })
        .then(r => r.json())
        .then(data => {
            document.getElementById('progressBar').style.width = '100%';
            setTimeout(() => {
                document.getElementById('uploadProgress').style.display = 'none';
                document.getElementById('progressBar').style.width = '0';
                if (data.success) { window.location.reload(); }
                else { alert('Erreur lors de l\'upload.'); }
            }, 500);
        })
        .catch(() => {
            document.getElementById('uploadProgress').style.display = 'none';
            alert('Erreur lors de l\'upload.');
        });
}

function copyUrl(url, el) {
    navigator.clipboard.writeText(url).then(() => {
        showToast('URL copiée dans le presse-papier !');
        if (el) {
            el.style.outline = '2px solid var(--rose)';
            setTimeout(() => el.style.outline = '', 1200);
        }
    });
}

function deleteMedia(path, id) {
    if (!confirm('Supprimer cette image définitivement ?')) return;
    fetch(deleteUrl, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ path })
    }).then(r => r.json()).then(data => {
        if (data.success) {
            const el = document.getElementById(id);
            if (el) { el.style.opacity = '0'; setTimeout(() => el.remove(), 300); }
            showToast('Image supprimée.');
        } else { alert('Erreur : ' + data.message); }
    });
}

function showToast(msg) {
    document.getElementById('toastMsg').textContent = msg;
    const t = document.getElementById('toast');
    t.style.display = 'block';
    setTimeout(() => t.style.display = 'none', 3000);
}
</script>
@endpush
