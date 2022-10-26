<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <h1>Hasil Diagnosa</h1>
            <p class="text-white">Hasil diagnosa kerusakan handphone.</p>
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-container">

                                <?php 
                                if(isset($_GET['id']) && $_GET['id'] != ""){
                                    ?>
                                    <?php 
                                    $id_user = $_GET['id'];
                                    $data = mysqli_query($koneksi,"select * from user where user.user_id='$id_user'");
                                    $cek = mysqli_num_rows($data);
                                    if($cek>0){
                                        while($d = mysqli_fetch_array($data)){
                                            ?>
                                            <table class="table table-bordered text-left">
                                                <tr>
                                                    <th width="30%">NAMA PENGGUNA</th>
                                                    <td class="text-uppercase"><?php echo $d['user_nama']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th width="30%">NO. HP</th>
                                                    <td><?php echo $d['user_hp']; ?></td>
                                                </tr> 
                                                <tr>
                                                    <th width="30%">JAWABAN PENGGUNA</th>
                                                    <td>
                                                        <ul>
                                                            <?php               
                                                            $user_input = mysqli_query($koneksi,"select * from user_input,gejala where user_input.gejala=gejala.gej_inisial and user_input.user='$id_user'");
                                                            while($i=mysqli_fetch_array($user_input)){
                                                                ?>
                                                                <li>
                                                                    <?php echo $i['gej_inisial']." - ".$i['gej_nama']; ?>

                                                                    <?php 
                                                                    if($i['nilai'] == "0"){
                                                                        echo "( Salah - tidak )";
                                                                    }else{
                                                                        echo "( Benar - ya )";
                                                                    }
                                                                    ?>
                                                                </li>

                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </td>
                                                </tr>        
                                                <?php 
                                                $hasil = $d['user_hasil'];
                                                if($hasil != "0"){
                                                    $alternatif = mysqli_query($koneksi,"select * from alternatif where alternatif.alt_id='$hasil'");
                                                    while($k=mysqli_fetch_array($alternatif)){
                                                        ?>
                                                        <tr>
                                                            <th width="30%">HASIL</th>
                                                            <td><b><?php echo $k['alt_inisial']; ?> - <?php echo $k['alt_nama']; ?></b></td>
                                                        </tr>                    
                                                        <tr>
                                                            <th width="30%">PENYEBAB KERUSAKAN</th>
                                                            <td><?php echo $k['alt_penyebab']; ?></td>
                                                        </tr>    
                                                        <tr>
                                                            <th width="30%">SOLUSI PERBAIKAN</th>
                                                            <td><?php echo $k['alt_solusi']; ?> </td>
                                                        </tr>  

                                                        <?php 
                                                    }
                                                }else{
                                                    ?>
                                                    <tr>
                                                        <th width="30%">HASIL</th>
                                                        <td><b><i>Kerusakan tidak ditemukan. mungkin handphone anda baik-baik saja.</i></b></td>
                                                    </tr>                     
                                                    <tr>
                                                        <th width="30%">PENYEBAB KERUSAKAN</th>
                                                        <td>-</td>
                                                    </tr>    
                                                    <tr>
                                                        <th width="30%">SOLUSI PERBAIKAN</th>
                                                        <td>-</td>
                                                    </tr> 
                                                    <?php 
                                                }
                                                ?>
                                            </table>
                                            <?php             
                                        }
                                    }else{
                                        header("location:diagnosa.php");
                                    }
                                }
                                ?>

                                <br>

                                <center>
                                    <a class="btn btn-primary mt-5 w-50" href="diagnosa.php">DIAGNOSA LAGI</a>
                                </center>

                            </div> 
                        </div> 
                    </div> 

                </div> 
            </div> 

        </div>
    </div>
</div>

<br>
<br>
<?php include 'footer.php'; ?>