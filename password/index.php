                        <div id="ProfilForm">
                            <div class="card mb-4">
                                <div class="card-header container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-table mr-1"></i>
                                            Form Ganti Password
                                        </div>                                                                                
                                    </div>                                    
                                </div>
                                <div class="card-body">
                                    <form method="post" action="" autocomplete="off" id="in-form">
                                        <div class="row">
                                            <label for="paswd_old" class="col-sm-4 col-form-label-sm text-right font-weight-bold">Password Lama</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">                                                    
                                                    <input type="password" id="paswd_old" name="paswd_old" class="form-control form-control-sm" placeholder="Password Lama" required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="showOld"><i class="fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <label for="paswd_new" class="col-sm-4 col-form-label-sm text-right font-weight-bold">Password Baru</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="password" id="paswd_new" name="paswd_new" class="form-control form-control-sm" placeholder="Password Baru" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="showNew"><i class="fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>    
                                            </div>                                            
                                        </div>
                                        <div class="row">
                                            <label for="paswd_conf" class="col-sm-4 col-form-label-sm text-right font-weight-bold">Re-type Password</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="password" id="paswd_conf" name="paswd_conf" class="form-control form-control-sm" placeholder="Re-type Password" required tabIndex="3">                                                    
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="showConf"><i class="fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                                <p id="pesan"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button class="btn btn-sm btn-primary" type="submit" id="simpan" form="in-form" onclick="return validatePaswdConf()"><i class="fa fa-save"></i><span> Simpan</span></button>
                                                <button class="btn btn-sm btn-warning" type="reset" id="batal" onclick="location.reload()"><i class="fa fa-reply"></i><span> Batal</span></button>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                        </div> 
                        
                        <script>
                            $('#showOld').click(function(){
                                $('#paswd_old').focus();
                                var x = document.getElementById("paswd_old");
                                var y = document.getElementById("showOld");
                                if (x.type === "password") {
                                    x.type = "text";
                                    y.innerHTML = "<i class='fa fa-eye'>";
                                } else {
                                    x.type = "password";
                                    y.innerHTML = "<i class='fa fa-eye-slash'>";
                                }
                            });

                            $('#showNew').click(function(){
                                $('#paswd_new').focus();
                                var x = document.getElementById("paswd_new");
                                var y = document.getElementById("showNew");
                                if (x.type === "password") {
                                    x.type = "text";
                                    y.innerHTML = "<i class='fa fa-eye'>";
                                } else {
                                    x.type = "password";
                                    y.innerHTML = "<i class='fa fa-eye-slash'>";
                                }
                            });

                            $('#showConf').click(function(){
                                $('#paswd_conf').focus();
                                var x = document.getElementById("paswd_conf");
                                var y = document.getElementById("showConf");
                                if (x.type === "password") {
                                    x.type = "text";
                                    y.innerHTML = "<i class='fa fa-eye'>";
                                } else {
                                    x.type = "password";
                                    y.innerHTML = "<i class='fa fa-eye-slash'>";
                                }
                            });

                            function validatePaswdConf(){
                                var pold = document.getElementById("paswd_old").value;
                                var pnew = document.getElementById("paswd_new").value;
                                var pconf = document.getElementById("paswd_conf").value;


                                if (pnew != pconf) {
                                    document.getElementById("pesan").innerHTML = "Re-type Password belum sama dengan Password Baru";
                                    return false;
                                }
                            };                                                        
                        </script>