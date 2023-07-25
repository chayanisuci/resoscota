<?php
require_once 'assets/PHPExcel3/PHPExcel.php';
include 'proses/koneksi.php';
$conn = new Koneksi();

// create a new PHPExcel object
$objPHPExcel = new PHPExcel();

// sheet 1
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('RESOSCOTA');

// set the column headers
$objPHPExcel->getActiveSheet()
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', 'Kabupaten/Kota')
    ->setCellValue('C1', 'Cota L')
    ->setCellValue('D1', 'Cota P')
    ->setCellValue('E1', 'Anak')
    ->setCellValue('F1', 'Tahun');
    

// execute the query
$query = $conn->kueri("SELECT * FROM `tb_arsipadopsi`
GROUP BY `kota`, `cotal`, `cotap`, `anak`, `tahun`
ORDER BY id_adopsi");

// fetch the data and write it to the worksheet
$i = 2; // start from row 2
$no = 1192;
foreach ($query as $row) {
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $i, "$no")
        ->setCellValue('B' . $i, $row['kota'])
        ->setCellValue('C' . $i, $row['cotal'])
        ->setCellValue('D' . $i, $row['cotap'])
        ->setCellValue('E' . $i, $row['anak'])
        ->setCellValue('F' . $i, $row['tahun']);
    $i++;
    $no++;
}

// set the column widths
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);

// output the file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Data Cota.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;