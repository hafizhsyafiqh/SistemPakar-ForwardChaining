<?php include 'header.php'; ?>
<?php mysqli_query($koneksi,"delete from tmp_kecocokan"); ?>


<div class="container">
    <br>
    <h2>Riwayat Diagnosa</h2>

    <div class="card mt-5">
        <div class="card-body">
            <div class="table-responsive">             
                <table class="table table-bordered" id="tableku">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama</th>
                            <th>No.HP</th>
                            <th>Kerusakan</th>
                            <th width="1%">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no=1;
                        $data = mysqli_query($koneksi,"select * from user,alternatif where user.user_hasil=alternatif.alt_id order by user.user_id desc");
                        while($d=mysqli_fetch_array($data)){
                            ?>            
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['user_nama']; ?></td>
                                <td><?php echo $d['user_hp']; ?></td>
                                <td><?php echo $d['alt_inisial']; ?> - <?php echo $d['alt_nama']; ?></td>
                                <td><a class="btn btn-primary" href="diagnosa_hasil.php?id=<?php echo $d['user_id']; ?>"> Detail</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<br>
<br>
<br>
<br>

<?php include 'footer.php'; ?>