 <!-- partial:partials/_navbar.html -->
 <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
     <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
         <a class="navbar-brand brand-logo mr-5" href="#" data-toggle="tooltip" title="Tahun : <?= session()->get('tahun'); ?>">
             <img src="/assets/images/logo_sipakan.jpeg" class="mr-2" alt="logo" />
             <span style="font-weight: bold; font-size: 24px;">SI-PAKAN</span>
             <span style=" font-size: 14px;"><?= session()->get('tahun'); ?></span>
         </a>
     </div>
     <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
         <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
             <span class="icon-menu"></span>
         </button>

         <ul class="navbar-nav navbar-nav-right" style="display: flex; align-items: center; gap: 0px;">
             <li class="nav-item nav-profile dropdown" style="display: flex; align-items: center;">
                 <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown" style="display: flex; align-items: center;">
                     <!--  <img src="/assets/images/Power.PNG" alt="profile" style="width: 35px; height: auto;"> -->
                     <i class="ti-power-off text-primary" style="font-size: 1.7em; font-weight: bold;"></i>

                 </a>
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                     <!-- <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
            </a> -->
                     <a class="dropdown-item" href="/auth/logout">
                         <i class="ti-power-off text-primary"></i>
                         Logout
                     </a>
                 </div>
             </li>
             <li class="nav-item nav-settings d-none d-lg-flex" style="display: flex; align-items: center;">
                 <h5 style="margin: 0;"><?= session('username'); ?></h5>
             </li>
         </ul>

         <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
             <span class="icon-menu"></span>
         </button>
     </div>
 </nav>