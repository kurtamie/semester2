<li class="nav-item">
    <a href="{{ url('home') }}" class="nav-link">
        <i class="nav-icon fas fa-home" style="color: white"></i>
        <p style="color: white">
            Dashboard
        </p>
    </a>
</li>

{{-- Menu Admin --}}
@if($user->level == 'admin')
<li class="nav-header"></li>
<li class="nav-item">
    <a href="{{ url('/riwayat/{id}') }}" class="nav-link">
        <i class="nav-icon fas fa-tasks" style="color: white"></i>
        <p style="color: white">
            Riwayat Pengajuan
        </p>
    </a>
</li>
{{-- <li class="nav-item">
    <a href="{{ url('satuan') }}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>

        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('produk') }}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>

        </p>
    </a>
</li>
<li class="nav-header"></li>
<li class="nav-item">
    <a href="{{ url('penjualan') }}" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>

        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ url('pembelian') }}" class="nav-link">
        <i class="nav-icon fas fa-tasks"></i>
        <p>

        </p>
    </a>
</li> --}}

{{-- Menu Mahasiswa --}}
@elseif ($user->level== 'mahasiswa')
<li class="nav-header"></li>
<li class="nav-item">
    <a href="{{ url('/pengajuan/{id}') }}" class="nav-link">
        <i class="nav-icon fas fa-book" style="color: white"></i>
        <p style="color: white">
            Surat Pengajuan
        </p>
    </a>
</li>
@endif
