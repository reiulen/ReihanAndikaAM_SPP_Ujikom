<div class="section-header bg-transparent shadow-none pb-0">
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">{{ Auth::guard('siswa')->user() ? Auth::guard('siswa')->user()->level : Auth::user()->level }}</div>
        {{ $slot }}
    </div>
</div>
