<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
table tr td{padding: 5px;}
#button1, button {
    background-color: #101010; 
    border: none;
    color: white;
    padding: 10px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}
input{
     border-left-color: #FFF;
     
}
select {
   width: 240px;
   height: 34px;
   overflow: hidden;
   background: url(new_arrow.png) no-repeat right #FFF;
   border-left-color: #000;
}
</style>
</head>
<body>
    <?php
        include "menu_navigasi.php";
    ?>
<div class="container">
  <h2>Foodie - PEMBELIAN BAHAN MAKANAN</h2>
  <hr />   
  <?php
  if (!isset($_POST["banyak"])) {
   $nomor_nota = $_POST['nomor_nota'];
   $nama_supplier = $_POST['supplier'];
   $waktuTemp =  new DateTime();
   $waktu =$waktuTemp->format('Y-m-d H:i:s');
   $emailStaff = $_SESSION["userlogin"];
   $_SESSION["nomor_nota"] = $_POST["nomor_nota"];
   include "../connect.php";
   $sql2 = pg_query($conn,"INSERT INTO PEMBELIAN VALUES('$nomor_nota','$waktu','$nama_supplier','$emailStaff')"); 
   }
   /*
   INSERT KE TABEL PEMBELIAN DISINI
   */
  ?>
  <div class="row"  style="margin-bottom: 20px;">
    <div class="col-sm-6">
        <table>
            <tr>
                <td>Nomor Nota </td> 
                <td>: <?php echo $nomor_nota; ?></td>
            </tr>
            <tr>
                <td>Supplier </td> 
                <td>: <?php echo $nama_supplier; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-6">
        <button onclick="tambahBahan()">Tambah Bahan</button>
    </div>
  </div>                                                                                  
  <div class="table-responsive">          
  <table class="table" >
    <thead>
      <tr  style="background-color: beige;"> 
        <th>Nama Bahan</th>
        <th>Harga Satuan</th>
        <th>Satuan</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>
    </thead>
     
    <tbody id="wrapper">
   <form method="POST" action="">
      <tr>
        <td>
        <select name="bahanbaku0">
        <?php 
                        include "../connect.php";
                        $sql =  pg_query($conn,"SELECT nama FROM Bahan_baku"); 
                        while ($row_nama = pg_fetch_array($sql)) {
                            echo "<option value='".($row_nama['nama'])."'>".($row_nama['nama'])."</option>";
        }
        ?>
        </select>
        </td>
        <td><input class="form-control" onkeyup="calculate_total(0)" id="harga0" name="harga0">
        <td>
        <select name="satuan0">
              <?php 
                        include "../connect.php";
                        $sql =  pg_query($conn,"SELECT DISTINCT satuanawal FROM Konversi_bahan_baku "); 
                        while ($row_satuan = pg_fetch_array($sql)) {
                            echo "<option value='".($row_satuan['satuanawal'])."'>".($row_satuan['satuanawal'])."</option>";
                    }
            ?>
        </select>
        </td>
        <td>
          <input class="form-control" onkeyup="calculate_total(0)" id="qty0" name="jumlah0">
        </td>
		<td>
    <input class="form-control" id="total0" disabled> <input type="number" hidden="hidden" id="banyak" name="banyak" value="1">
    <input type="text" hidden="hidden" name="nomornota" value='<?php echo $nomor_nota;?>'>
    </td>
      </tr>
    </tbody>
    
  </table>
  <input type="submit" id="button1" value="Simpan">
  </form>
  </div>
</div>
<?php
            if (isset($_POST["banyak"])) {
                        include "../connect.php";
                        $banyak = $_POST["banyak"];
                        $nomor_nota = $_POST["nomornota"];
                        for($jj=0; $jj<=$banyak; $jj++){
                            $nama = $_POST["bahanbaku".$jj];
                            echo $nama;
                            $harga = $_POST["harga".$jj];
                            echo $harga;
                            $satuan = $_POST["satuan".$jj];
                            echo $satuan;
                            $jumlah = $_POST["jumlah".$jj];
                            $sql2 = pg_query($conn,"INSERT INTO PEMBELIAN_BAHAN_BAKU VALUES('$nama', '$nomor_nota','$jumlah','$satuan','$harga')");
                        }
                        
                }
?>
</body>
</html>
<script>
var id= 0;
function tambahBahan() {
     var newdiv = document.createElement('tr');
     ++id;
     newdiv.innerHTML = "<td><select name='bahanbaku"+id+"'><?php include "../connect.php";$sql =  pg_query($conn,"SELECT nama FROM Bahan_baku"); while ($row_nama = pg_fetch_array($sql)) {echo "<option value='".($row_nama['nama'])."'>".($row_nama['nama'])."</option>";}?> </select></td><td><input class='form-control' name='harga"+id+"' onkeyup='calculate_total("+id+")' id='harga"+id+"'></td><td><select name='satuan"+id+"'><?php include "../connect.php";$sql =  pg_query($conn,"SELECT DISTINCT satuanawal FROM Konversi_bahan_baku "); while ($row_satuan = pg_fetch_array($sql)) {echo "<option value='".($row_satuan['satuanawal'])."'>".($row_satuan['satuanawal'])."</option>";}?></select></td><td><input class='form-control' name='jumlah"+id+"' onkeyup='calculate_total("+id+")' id='qty"+id+"'></td><td><input class='form-control' id='total"+id+"' disabled></td>";
    document.getElementById("wrapper").appendChild(newdiv);
    $('#banyak').val(id);
}


function calculate_total(i) {
		$('#total' + i).val($('#harga' + i).val() * $('#qty' + i).val());
}
</script>
