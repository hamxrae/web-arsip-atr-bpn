@props(['title' => '', 'subtitle' => '', 'total' => 0, 'icon' => 'fas fa-info-circle', 'iconColor' => '#10b981', 'iconBg' => '#d1fae5'])

<!-- ===== PAGE HEADER (Partial) ===== -->
<div class="page-header">
    <div class="page-title">
        <i class="{{ $icon }}" style="color: {{ $iconColor }};"></i>
        {{ $title }}
    </div>
    <div class="page-subtitle">{{ $subtitle }}</div>
</div>

<!-- ===== STATISTICS CARD (shared) ===== -->
<div class="row g-4 mb-32">
    <div class="col-md-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-label">Total Data</div>
                        <div class="stat-value">{{ $total }}</div>
                    </div>
                    <div class="stat-icon" style="background-color: {{ $iconBg }}; color: {{ $iconColor }};">
                        <i class="{{ $icon }}"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .mb-32 { margin-bottom: 32px; }
    .page-header { margin-bottom: 20px; }
    .page-title { font-size: 24px; font-weight: 700; color: #111827; display:flex; gap:.6rem; align-items:center }
    .page-title i { font-size: 20px; }
    .page-subtitle { color: #6b7280; margin-top:4px }
    .stat-label { font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .stat-value { font-size: 28px; font-weight: 700; color: #111827; }
    .stat-icon { width:56px; height:56px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size: 24px }
</style>
