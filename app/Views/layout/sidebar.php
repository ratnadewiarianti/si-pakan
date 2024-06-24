   <?php
    $uri = $_SERVER['REQUEST_URI'];
    ?>

   <nav class="sidebar sidebar-offcanvas" id="sidebar">
       <ul class="nav">
           <li class="nav-item <?= (strpos($uri, '/home') !== false || $uri == '/') ? 'active' : '' ?>">
               <a class="nav-link" href="/">
                   <i class="ti-dashboard menu-icon"></i>
                   <span class="menu-title">Dashboard</span>
               </a>
           </li>
           <li class="nav-item  <?= (strpos($uri, '/starter') !== false) ? 'active' : '' ?>">
               <a class="nav-link" href="starter">
                   <i class="ti-write menu-icon"></i>
                   <span class="menu-title">Starter</span>
               </a>
           </li>
           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-folder menu-icon"></i>
                   <span class="menu-title">Master</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item <?= (strpos($uri, '/user/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/user">User</a></li>
                       <li class="nav-item <?= (strpos($uri, '/karyawan/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/karyawan">Karyawan</a></li>
                       <li class="nav-item <?= (strpos($uri, '/pajak/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/pajak">Pajak</a></li>
                       <li class="nav-item">
                           <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Master Rekening</a>
                           <div class="dropdown-menu " aria-labelledby="dropdownMenuIconButton1">
                               <h6 class="dropdown-header"><b>Master Rekening</b></h6>
                               <a class="dropdown-item <?= (strpos($uri, '/akun/') !== false) ? 'active' : '' ?>" href="/akun">Akun</a>
                               <a class="dropdown-item <?= (strpos($uri, '/kelompok/') !== false) ? 'active' : '' ?>" href="/kelompok">Kelompok</a>
                               <a class="dropdown-item <?= (strpos($uri, '/jenis/') !== false) ? 'active' : '' ?>" href="/jenis">Jenis</a>
                               <a class="dropdown-item <?= (strpos($uri, '/objek/') !== false) ? 'active' : '' ?>" href="/objek">Objek</a>
                               <a class="dropdown-item <?= (strpos($uri, '/rincianobjek/') !== false) ? 'active' : '' ?>" href="/rincianobjek">Rincian Objek</a>
                               <a class="dropdown-item <?= (strpos($uri, '/subrincian/') !== false) ? 'active' : '' ?>" href="/subrincian">Sub Rincian Objek</a>
                           </div>
                       </li>
                       <li class="nav-item">
                           <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Master Subkegiatan</a>
                           <div class="dropdown-menu " aria-labelledby="dropdownMenuIconButton1">
                               <h6 class="dropdown-header"><b>Master Subkegiatan</b></h6>
                               <a class="dropdown-item <?= (strpos($uri, '/urusan/') !== false) ? 'active' : '' ?>" href="/urusan">Urusan</a>
                               <a class="dropdown-item <?= (strpos($uri, '/bidang_urusan/') !== false) ? 'active' : '' ?>" href="/bidang_urusan">Bidang Urusan</a>
                               <a class="dropdown-item <?= (strpos($uri, '/program/') !== false) ? 'active' : '' ?>" href="/program">Program</a>
                               <a class="dropdown-item  <?= (strpos($uri, '/kegiatan/') !== false) ? 'active' : '' ?>" href="/kegiatan">Kegiatan</a>
                               <a class="dropdown-item <?= (strpos($uri, '/subkegiatan/') !== false) ? 'active' : '' ?>" href="/subkegiatan">Subkegiatan</a>
                           </div>
                       </li>
                   </ul>
               </div>

           </li>


           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-money menu-icon"></i>
                   <span class="menu-title">Anggaran</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic8">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item <?= (strpos($uri, '/rakbelanja/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/rakbelanja">Rak Belanja</a></li>
                       <li class="nav-item <?= (strpos($uri, '/dpa/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/dpa">DPA</a></li>
                   </ul>
               </div>
           </li>

           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-stamp menu-icon"></i>
                   <span class="menu-title">Penatausahaan</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic5">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item <?= (strpos($uri, '/penatausahaan/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/penatausahaan">Penatausahaan</a></li>
                   </ul>
               </div>
           </li>

           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-check menu-icon"></i>
                   <span class="menu-title">Verifikasi</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic6">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item <?= (strpos($uri, '/verifikasi') !== false && strpos($uri, '/bendahara') === false && strpos($uri, '/kasubbag') === false) ? 'active' : '' ?>">
                           <a class="nav-link" href="/verifikasi">Verifikasi</a>
                       </li>
                       <li class="nav-item <?= (strpos($uri, '/verifikasi/bendahara') !== false) ? 'active' : '' ?>">
                           <a class="nav-link" href="/verifikasi/bendahara">Bendahara</a>
                       </li>
                       <li class="nav-item <?= (strpos($uri, '/verifikasi/kasubbag') !== false) ? 'active' : '' ?>">
                           <a class="nav-link" href="/verifikasi/kasubbag">Kasubbag</a>
                       </li>
                   </ul>
               </div>
           </li>

           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-book menu-icon"></i>
                   <span class="menu-title">Laporan</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic7">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item <?= (strpos($uri, '/bp_kas_tunai/') !== false) ? 'active' : '' ?>"> <a class="nav-link" style="white-space: normal;word-wrap: break-word;" href="/bp_kas_tunai">Buku Pembantu Kas Tunai</a></li>
                       <li class="nav-item <?= (strpos($uri, '/bp_kas_tunai/') !== false) ? 'active' : '' ?>"> <a class="nav-link" style="white-space: normal;word-wrap: break-word;" href="/bp_kas_tunai">Buku Pembantu Pajak</a></li>
                       <li class="nav-item <?= (strpos($uri, '/bp_kas_tunai/') !== false) ? 'active' : '' ?>"> <a class="nav-link" style="white-space: normal;word-wrap: break-word;" href="/bp_kas_tunai">Buku Pembantu Simpanan Bank</a></li>
                       <li class="nav-item <?= (strpos($uri, '/bp_kas_tunai/') !== false) ? 'active' : '' ?>"> <a class="nav-link" style="white-space: normal;word-wrap: break-word;" href="/bp_kas_tunai">Laporan Untuk SI SPJ</a></li>
                   </ul>
               </div>
           </li>


       </ul>
   </nav>