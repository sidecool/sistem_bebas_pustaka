                    <?php
                        if(isset($_GET['p'])) {
                            echo '<script>
                                toastr.options.onHidden = function() { document.location="index.php"; }
                                toastr.options.timeOut = 3000;
                            </script>';
                            switch ($_GET['p']) {
                                case 'berhasil-simpan':
                                    echo '<script>toastr.success("Data telah ditambahkan, Anda berhasil menambah data.", "Pesan Berhasil");</script>';
                                    break;
                                case 'berhasil-edit':
                                    echo '<script>toastr.success("Data telah diedit, Anda berhasil mengedit data.", "Pesan Berhasil");</script>';
                                    break;
                                case 'berhasil-hapus':
                                    echo '<script>toastr.success("Data telah dihapus, Anda berhasil menghapus data.", "Pesan Berhasil");</script>';
                                    break;
                                case 'gagal-simpan':
                                    echo '<script>toastr.error("Data tidak dapat ditambahkan, Anda tidak berhasil menambah data.", "Pesan Gagal");</script>';
                                    break;
                                case 'gagal-edit':
                                    echo '<script>toastr.error("Data tidak dapat diedit, Anda tidak berhasil mengedit data.", "Pesan Gagal");</script>';
                                    break;
                                case 'gagal-hapus':
                                    echo '<script>toastr.error("Data tidak dapat dihapus, Anda tidak berhasil menghapus data.", "Pesan Gagal");</script>';
                                    break;
                            }                            
                        }
                    ?>
                </div>
            </main>            
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div><!-- End Content  -->
    </div><!-- End Side Navigation  -->    
    <script src="<?php echo $baseurl; ?>/admin/assets/js/FontAwesome/all.min.js"></script>  
    <script src="<?php echo $baseurl; ?>/admin/assets/js/Bootstrap4/bootstrap.bundle.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/admin/assets/js/Chart/Chart.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/dataTables.bootstrap4.min.js"></script> 
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/dataTables.buttons.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/jszip.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/pdfmake.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/vfs_fonts.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/buttons.html5.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/buttons.print.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/datatables-admin.js" ></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/scripts_admin.js" ></script>
    <script>
        $(document).ready(function() {
            window.history.pushState(null, "", window.location.href);        
            window.onpopstate = function() {
                window.history.pushState(null, "", window.location.href);
            };
        });

        $("input[required], textarea[required]").attr("oninvalid", "this.setCustomValidity('Form tidak boleh kosong')");
        $("input[required], textarea[required]").attr("oninput", "setCustomValidity('')");
        $("select[required]").attr("oninvalid", "this.setCustomValidity('Pilih salah satu')");
        $("select[required]").attr("oninput", "setCustomValidity('')");
    </script>
    <script> // Data Tabel
        $(function () {
            $("#dataTable").dataTable({
                bDestroy: true,

                oLanguage: {
                    url: 'http://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian.json',
                    url: 'http://cdn.datatables.net/plug-ins/1.10.20/i18n/Indonesian-Alternative.json',
                    sEmptyTable: 'Tidak ada data di database'
                },
                
                fixedHeader: true,
                ordering: false,
                dom: 'flitBp',
                lengthMenu: [
                    [5, 25, 50, -1], [5, 25, 50, 'All']
                ],
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]                
            });                        
        });                
    </script> 
    <script> // Cek enter
        function f_cekenter(sender, e) {
            if(e.which == 13 || e.keyCode == 13) {
                for (i = 0; i < sender.form.elements.length; i++) {                    
                    if (sender.form.elements[i].tabIndex == sender.tabIndex + 1) {
                        sender.form.elements[i].focus();                        
                    }
                }                
                return false;
            }       
            return true;     
        };            
    </script>
</body>
</html>