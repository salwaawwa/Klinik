
<div class="main-sidebar sidebar-style-2">
<aside id="sidebar-wrapper" class="mb-5">
  <div class="sidebar-brand">
    <a href="/">Klinik UROLOGI</a>
  </div>
  <div class="sidebar-brand sidebar-brand-sm">
    <a href="/">KU</a>
  </div>
  <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::route()->getName() == 'dashboard.index' ? ' active' : '' }}"><a class="nav-link" href="{{route('dashboard.index')}}"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
  </ul>

  <ul class="sidebar-menu">
      <li class="{{ Request::route()->getName() == 'user.index' ? ' active' : '' }}"><a class="nav-link" href="{{route('user.index')}}"><i class="fas fa-users"></i> <span>Users</span></a></li>
  </ul>

  <ul class="sidebar-menu">
      <li class="{{ Request::route()->getName() == 'produk.index' ? ' active' : '' }}"><a class="nav-link" href="{{route('produk.index')}}"><i class="fas fa-box"></i> <span>Data Tindakan</span></a></li>
  </ul>

   <ul class="sidebar-menu">
      <li class="{{ Request::route()->getName() == 'transaksi.create' ? ' active' : '' }}"><a class="nav-link" href="{{route('transaksi.create')}}"><i class="fas fa-shopping-cart"></i> <span>Transaksi</span></a></li>
  </ul>

  <ul class="sidebar-menu">
      <li class="{{ Request::route()->getName() == 'transaksi.index' ? ' active' : '' }}"><a class="nav-link" href="{{route('transaksi.index')}}"><i class="fas fa-table"></i> <span>Daftar Transaksi</span></a></li>
  </ul>

</aside>
</div>