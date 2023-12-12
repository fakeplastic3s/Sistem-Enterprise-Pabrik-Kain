<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body onload="window.print()">
    <center>
        <table style="width: 100%; border-collapse: collapse; text-align: center;" border="0">
            <tr>
                <td>
                    <table style="width: 100%; text-align: center;" border="0">
                        <tr style="text-align: center;">
                            <td>
                                <!-- <h1>Hotel Horison</h1> -->
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%; text-align: center;" border="0">
                        <tr style="text-align: center;">
                            <td>
                                <h3>Laporan Penjualan</h3>
                                <h2>PT. AJI WIJAYATEX</h2>
                                <br>
                                Periode :
                                <?php
                                $tanggal = date('d M Y', strtotime($tglawal));
                                echo $tanggal
                                ?>
                                s/d
                                <?php
                                $tanggal = date('d M Y', strtotime($tglakhir));
                                echo $tanggal
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <table border="1" style="width: 90%; border-collapse: collapse; border: 1px solid #000;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Penjualan</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Sales</th>
                                                <th>Daerah Operasi</th>
                                                <th>Jumlah</th>
                                                <th>Harga Satuan</th>
                                                <th width="100px">Total Harga</th>
                                                <!-- <th></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php $totalSeluruhHarga = 0 ?>
                                            <?php foreach ($laporan as $row) : ?>
                                                <tr>
                                                    <td style="text-align: center;"><?= $i++; ?></td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        $tanggal = date('d M Y', strtotime($row['tanggal_penjualan']));
                                                        echo $tanggal
                                                        ?>
                                                    </td>
                                                    <td style="text-align: left;"><?= $row['nama_barang']; ?></td>
                                                    <td style="text-align: left;"><?= $row['nama_sales']; ?></td>
                                                    <td style="text-align: left;"><?= $row['daerah_operasi']; ?></td>
                                                    <td style="text-align: center;"><?= $row['jumlah_penjualan']; ?></td>
                                                    <td style="text-align: center;"><?= format_rupiah($row['harga']); ?></td>
                                                    <?php $total = $row['jumlah_penjualan'] * $row['harga']  ?>
                                                    <td style="text-align: center;"><?= format_rupiah($total); ?></td>
                                                    <?php $totalSeluruhHarga += $total ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="7">Total Seluruh Harga</th>
                                                <td colspan="2" style="text-align: right;"><?= format_rupiah($totalSeluruhHarga); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </center>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>