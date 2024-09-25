<?php 
include 'koneksi.php';
include 'navbar.php';
$query ="SELECT * FROM inventory";
$result = mysqli_query($con, $query);

if (!$result){
    die("query error: " . mysqli_error($con));
}
?>
<div class="container">
    <header><h3>Data Inventory</h3></header>
    <a href="inventory_insert.php">
        <button type="button" class="insert-button">Insert Data Inventory</button>
    </a>
    <table border="1">
     <tr>
        <th>Id</th>
        <th>Nama Barang</th>
        <th>Jenis Barang</th>
        <th>Kuantitas Stock</th>
        <th>Lokasi Gudang</th>
        <th>Serial Number</th>
        <th>Harga</th>
        <th>Action</th>
     </tr>
    <?php 
       while ($row = mysqli_fetch_assoc($result)) {?>
       <tr>
       <td><?php echo $row['Id'];?></td>
       <td><?php echo $row['Nama_barang'];?></td>
       <td><?php echo $row['Jenis_barang'];?></td>
       <td><?php echo $row['Kuantitas_stock'];?></td>
       <td><?php echo $row['Lokasi_gudang'];?></td>
       <td><?php echo $row['Serial_number'];?></td>
       <td><?php echo $row['harga'];?></td>
       <td>
        <a href="inventory_update.php?id=<?php echo $row['Id']; ?>" class="action-button update-button">Update</a>
        <a href="inventory_delete.php?id=<?php echo $row['Id']; ?>" class="action-button delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</a>
     </td>
       </tr>
       <?php } ?>
    </table>
</div>
<style>
        .insert-button {
    background-color: #6a0dad; /* Warna ungu */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.insert-button:hover {
    background-color: #4b0082; /* Ungu tua */
}

.action-button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    color: white;
}

.update-button {
    background-color: #8a2be2; /* Ungu medium */
    margin-right: 10px;
}

.update-button:hover {
    background-color: #6a0dad; /* Ungu tua */
}

.delete-button {
    background-color: #f44336; /* Merah */
    color: white;
}

.delete-button:hover {
    background-color: #d32f2f; /* Merah tua */
}

</style>
