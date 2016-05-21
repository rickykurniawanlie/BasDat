<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
table tr td{padding: 5px;}
button {
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
   $nomor_nota = $_POST['nomor_nota'];
   $nama_supplier = $_POST['supplier']
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
      <tr>
        <td>
        <select name="bahanbaku1">
        <?php 
                        include "../connect.php";
                        $sql =  pg_query($conn,"SELECT nama FROM Bahan_baku"); 
                        while ($row_nama = pg_fetch_array($sql)) {
                            echo "<option value='".($row_nama['nama'])."'>".($row_nama['nama'])."</option>";
        }
        ?>
        </select>
        </td>
        <td><input id="row_hargasatuan_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mprice[]"></td>
        <td>
        <select name="satuan1">
              <?php 
                        include "../connect.php";
                        $sql =  pg_query($conn,"SELECT DISTINCT satuanawal FROM Konversi_bahan_baku "); 
                        while ($row_satuan = pg_fetch_array($sql)) {
                            echo "<option value='".($row_satuan['satuanawal'])."'>".($row_satuan['satuanawal'])."</option>";
                    }
            ?>
        </select>
        </td>
        <td><input id="row_jumlah_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini" name="mqty[]"></td>
		<td><input id="row_total_` + i + `" onkeyup="calculate_total(` + i + `)" type="number" min="0" value="0" class="form-control mini nodisable" disabled name="mtotal[]"></td>
      </tr>
    </tbody>
  </table>
  <button>Simpan</button>
  </div>
</div>

</body>
</html>
<script>
var id= 1;
function tambahBahan() {
     var newdiv = document.createElement('tr');
     ++id;
     newdiv.innerHTML = "<td><select name='bahanbaku"+id+"'><?php include "../connect.php";$sql =  pg_query($conn,"SELECT nama FROM Bahan_baku"); while ($row_nama = pg_fetch_array($sql)) {echo "<option value='".($row_nama['nama'])."'>".($row_nama['nama'])."</option>";}?> </select></td><td><input type='text' name='harga'"+id+"></td><td><select name='satuan"+id+"'><?php include "../connect.php";$sql =  pg_query($conn,"SELECT DISTINCT satuanawal FROM Konversi_bahan_baku "); while ($row_satuan = pg_fetch_array($sql)) {echo "<option value='".($row_satuan['satuanawal'])."'>".($row_satuan['satuanawal'])."</option>";}?></select></td><td><input type='text' name='jumlah"+id+"'></td><td>000000</td>";
    document.getElementById("wrapper").appendChild(newdiv);
}


function calculate_total(i) {
		$('#row_total_' + i).val($('#row_hargasatuan_' + i).val() * $('#row_jumlah_' + i).val());
}

</script>
