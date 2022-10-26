<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Diagnosa</h1>
                <div class="card">
                    <div class="card-body">

                        <p>Isi data berikut</p>

                        <form action="diagnosa_act.php" method="post" data-toggle="validator" data-focus="false">

                            <div class="form-group">
                                <label class="label-control" for="nemail">Nama Lengkap</label>
                                <input class="form-control" autocomplete="off" type="text" name="nama" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label class="label-control" for="nemail">Nomor HP</label>
                                <input class="form-control" autocomplete="off" type="number" name="hp" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>

                        </form> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

<br>
<br>
<br>
<br>

<?php include 'footer.php'; ?>