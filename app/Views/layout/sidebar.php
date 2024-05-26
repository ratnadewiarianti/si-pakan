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
                       
                   </ul>
               </div>

           </li>
           
           
           
           <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-credit-card menu-icon"></i>
                   <span class="menu-title">Master Rekening</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic2">
                   <ul class="nav flex-column sub-menu">

                       <li class="nav-item <?= (strpos($uri, '/akun/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/akun">Akun</a></li>
                       <li class="nav-item <?= (strpos($uri, '/kelompok/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/kelompok">Kelompok</a></li>
                       <li class="nav-item <?= (strpos($uri, '/jenis/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/jenis">Jenis</a></li>
                       <li class="nav-item <?= (strpos($uri, '/objek/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/objek">Objek</a></li>
                       <li class="nav-item <?= (strpos($uri, '/rincianobjek/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/rincianobjek">Rincian Objek</a></li>
                       <li class="nav-item <?= (strpos($uri, '/subrincian/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/subrincian">Sub Rincian Objek</a></li>
                   </ul>
               </div>

               </li>
           
               <li class="nav-item  ">
               <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                   <i class="ti-files menu-icon"></i>
                   <span class="menu-title">Master Subkegiatan </span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="ui-basic4">
                   <ul class="nav flex-column sub-menu">
                    
                       <li class="nav-item <?= (strpos($uri, '/urusan/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/urusan">Urusan</a></li>
                       <li class="nav-item <?= (strpos($uri, '/bidang_urusan/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/bidang_urusan">Bidang Urusan</a></li>
                       <li class="nav-item <?= (strpos($uri, '/program/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/program">Program</a></li>
                       <li class="nav-item <?= (strpos($uri, '/kegiatan/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                       <li class="nav-item <?= (strpos($uri, '/subkegiatan/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/subkegiatan">Subkegiatan</a></li>
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
                       <li class="nav-item <?= (strpos($uri, '/verifikasi/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/verifikasi">Verifikasi</a></li>
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
                       <li class="nav-item <?= (strpos($uri, '/bp_kas_tunai/') !== false) ? 'active' : '' ?>"> <a class="nav-link" href="/bp_kas_tunai">Buku Pembantu Kas Tunai</a></li>
                   </ul>
               </div>
               </li>
       </ul>
   </nav>