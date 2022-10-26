<?php include 'header.php'; ?>

<style type="text/css">

    .checkmark {
      /*position: absolute;*/
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border-radius: 50%;
  }
</style>

<header id="header" class="ex-header" style="padding-top: 8rem;padding-bottom: 2rem;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form">
                    <div class="container">
                        <p class="text-white">Jawab pertanyaan berikut sesuai dengan yang terjadi pada printer anda.</p>

                        <div class="">
                            <div class="card">
                                <div class="card-body">

                                    <?php
                                    $no = 0;
                                    $rule = array();
                                    $alternatif = mysqli_query($koneksi,"select * from alternatif");        
                                    while($ker=mysqli_fetch_array($alternatif)){
                                        $nox = $no++;
                                        ?>

                                        <?php 
                                        $xx = 0;
                                        $id_ker = $ker['alt_id'];
                                        $rule2 = array();
                                        $kecocokan2 = mysqli_query($koneksi,"select * from kecocokan,gejala where kec_gejala=gej_id and kec_alternatif='$id_ker' and kec_nilai=1");        
                                        while($kec2=mysqli_fetch_array($kecocokan2)){
                                            $xxx = $xx++;
                                            array_push($rule2, $kec2['gej_inisial']);
                                        }                                              
                                        array_push($rule, $rule2);
                                        ?>

                                        <?php 

                                    }
                                    ?>

                                    <?php 
                                    if(isset($_GET['gejala'])){
                                        $gejala = $_GET['gejala'];
                                        ?>
                                        <!-- tampilkan pertanyaan pertama -->

                                        <form action="diagnosa_mulai2.php" method="post" class="m-0">
                                            <?php 
                                            $inisial_pertanyaan_selanjutnya = $gejala;                                            
                                            $pertanyaan_pertama = mysqli_query($koneksi,"select * from gejala where gej_inisial='$inisial_pertanyaan_selanjutnya'");
                                            $pp = mysqli_fetch_array($pertanyaan_pertama);
                                            ?>

                                            <div class="row justify-item-center">

                                                <div class="col-12">

                                                 <center>
                                                    <br>
                                                    <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                                                    <input type="hidden" name="inisial" value="<?php echo $pp['gej_inisial']; ?>">
                                                    <h2 class="mb-5 text-dark"> <?php echo $pp['gej_inisial']; ?> - <?php echo $pp['gej_nama']; ?> ? </h2>
                                                    <br>
                                                </center>
                                            </div>

                                            <div class="col-md-6">
                                                <center>
                                                    <input type="radio" name="jawaban" value="1" class="form-control checkmark" required> YA
                                                </center>
                                            </div>

                                            <div class="col-md-6">
                                                <center>
                                                    <input type="radio" name="jawaban" value="0" class="form-control checkmark" required> TIDAK
                                                </center>
                                            </div>

                                            <div class="col-md-12">

                                                <center>
                                                    <br>
                                                    <br>
                                                    <input class="btn btn-primary" type="submit" value="SIMPAN JAWABAN" style="">
                                                    <br>
                                                    <br>
                                                </center>

                                            </div>

                                        </div>
                                    </form> 

                                    <?php
                                }else{
                                    ?>
                                    <!-- tampilkan pertanyaan pertama -->

                                    <form action="diagnosa_mulai2.php" method="post" class="m-0">
                                        <?php 
                                        $inisial_pertanyaan_pertama = $rule[0][0];                                            
                                        $pertanyaan_pertama = mysqli_query($koneksi,"select * from gejala where gej_inisial='$inisial_pertanyaan_pertama'");
                                        $pp = mysqli_fetch_array($pertanyaan_pertama);
                                        ?>


                                        <div class="row justify-item-center">   

                                            <div class="col-12">

                                               <center>
                                                <br>
                                                <input type="hidden" name="id_user" value="<?php echo $_GET['id']; ?>">
                                                <input type="hidden" name="inisial" value="<?php echo $pp['gej_inisial']; ?>">
                                                <h2 class="mb-5 text-dark"><?php echo $pp['gej_inisial']; ?> - <?php echo $pp['gej_nama']; ?> ?</h2>
                                                <br>
                                            </center>

                                        </div>

                                        <div class="col-md-6">
                                            <center>
                                                <input type="radio" name="jawaban" value="1" class="form-control checkmark" required> YA
                                            </center>
                                        </div>

                                        <div class="col-md-6">
                                            <center>
                                                <input type="radio" name="jawaban" value="0" class="form-control checkmark" required> TIDAK
                                            </center>
                                        </div>

                                        <div class="col-md-12">

                                            <center>
                                                <br>
                                                <br>
                                                <input class="btn btn-primary" type="submit" value="SIMPAN JAWABAN" style="">
                                            </center>

                                        </div>

                                    </div>
                                </form>  

                                <?php
                            }

                            ?>






                        </div> 
                    </div> 
                </div> 

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
<br>
<br>

<?php include 'footer.php'; ?>