 <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(180deg, #004d00 0%, #006600 100%); box-shadow: 2px 0 10px rgba(0, 77, 0, 0.15);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}" style="background: rgba(0, 0, 0, 0.1); border-bottom: 2px solid rgba(255, 255, 255, 0.1);">
                <div class="sidebar-brand-icon" style="font-size: 2rem;">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ATR BPN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" style="border-color: rgba(255, 255, 255, 0.15);">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}" style="border-left: 4px solid transparent; padding-left: 1.25rem; transition: all 0.3s ease;">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <li class="nav-item">
             <a class="nav-link" href="{{ route('admin.bukutanah.index') }}" style="border-left: 4px solid transparent; padding-left: 1.25rem; transition: all 0.3s ease;">
              <i class="fas fa-fw fa-book"></i>
             <span>Daftar Buku Tanah</span></a>
            </li>

            <li class="nav-item">
             <a class="nav-link" href="{{ route('admin.suratukur.index') }}" style="border-left: 4px solid transparent; padding-left: 1.25rem; transition: all 0.3s ease;">
                <i class="fas fa-fw fa-file"></i>
                <span>Daftar Surat Ukur</span></a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.peminjam.index') }}" style="border-left: 4px solid transparent; padding-left: 1.25rem; transition: all 0.3s ease;">
                <i class="fas fa-users"></i>
                <span>Peminjam</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pengembalian.index') }}" style="border-left: 4px solid transparent; padding-left: 1.25rem; transition: all 0.3s ease;">
                    <i class="fas fa-users"></i>
                    <span>Pengembalian</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider" style="border-color: rgba(255, 255, 255, 0.15);">
 

        </ul>

