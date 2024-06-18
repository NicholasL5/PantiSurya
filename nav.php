<div class="holder flex-col">
    <div class="content flex-col">
        <div class="logo">
            <h2 style="color: white;">Panti Surya</h2>
        </div>

        <nav class="nav">
            <a type="button" href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="3 3 20 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
                Overview
            </a>
            <a type="button" href="databerita.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                Berita
            </a>

            <a type="button" href="penduduk.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="3 2 20 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Data penduduk
            </a>
            
            <div class="dropdown">
                <a type="button" href="#" class="dropbtn" onclick="toggleSubMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="3 3 20 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9a3 3 0 0 0 0 6h6a3 3 0 0 1 0 6H9"></path></svg>
                    Keuangan
                    <span style="font-size: 14px; vertical-align: middle;">&#9660;</span>
                </a>
                <div class="dropdown-content" id="subMenu" style="display: none;">
                    <a href="keuangan_deposit.php" style="padding-left: 40px;">Keuangan Deposit</a>
                    <a href="keuangan_pondokkan.php" style="padding-left: 40px;">Keuangan Pondokkan</a>
                    <a href="keuangan_tabungan.php" style="padding-left: 40px;">Keuangan Tabungan</a>
                    <a href="keuangan_obat.php" style="padding-left: 40px;">Keuangan Obat</a>
                </div>
            </div>

            <a type="button" href="galeri.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="3 3 20 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                </svg>
                Galeri
            </a>

            <!-- <a type="button" href="cobaUpload.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="3 2 20 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Coba Upload
            </a> -->

            <a type="button" onclick="return confirm('Yakin keluar?')" href="logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="3 3 20 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg> Logout
            </a>
        </nav>
    </div>
</div>

<div class="filler"></div>

<script>
    function toggleSubMenu() {
        var subMenu = document.getElementById("subMenu");
        if (subMenu.style.display === "none") {
            subMenu.style.display = "block";
        } else {
            subMenu.style.display = "none";
        }
    }
</script>
