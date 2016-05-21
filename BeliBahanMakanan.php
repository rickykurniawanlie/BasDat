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
        <td><input class="form-control" onkeyup="calculate_total(0)" id="harga0">
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
        <td>
          <input class="form-control" onkeyup="calculate_total(0)" id="qty0">
        </td>
		<td>
    <input class="form-control" id="total0" disabled>  
    </td>
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
		$('#total' + i).val($('#harga' + i).val() * $('#qty' + i).val());
}

</script>
