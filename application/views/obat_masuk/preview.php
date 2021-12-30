<?php
$pdf = new FPDF("P", "cm", "A4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
// $pdf->Image('assets/img/aplikasi/logo.png',2.5,0.5,3,2.5);
$pdf->SetX(6);
$pdf->MultiCell(9, 0.6, "KLINIK PT. INDOFOOD", 0, 'C');
// $pdf->SetFont('Times', 'B', 14);
$pdf->SetX(6);
// $pdf->MultiCell(9, 0.6, "DOKTER CECEP ISMAWAN", 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->SetX(6);
// $pdf->MultiCell(9, 0.6, '' . $alamat . '', 0, 'C');
$pdf->Line(2, 3.1, 19, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(2, 3.2, 19, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->MultiCell(17, 2.0, "DATA TRANSAKSI OBAT MASUK", 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(17, 0.7, '' . $ket . '', 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 0.6, "Di cetak pada : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'KODE OBAT', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'NAMA OBAT', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'TANGGAL MASUK', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'HARGA', 1, 0, 'C');
$pdf->ln();

if (!empty($obat_masuk)) {
    $no = 1;
    foreach ($obat_masuk as $data) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(1, 0.6, $no++, 1, 0, 'C');
        $pdf->Cell(3.5, 0.6, ($data['kode_obat']), 1, 0, 'C');
        $pdf->Cell(3.5, 0.6, $data['nama_obat'], 1, 0, 'C');
        $pdf->Cell(5, 0.6, $data['tanggal_masuk'], 1, 0, 'C');
        $pdf->Cell(3.5, 0.6, $data['harga_perobat'], 1, 0, 'L');

        $pdf->ln();
    }
}

$pdf->Output("Laporan Transaksi Obat Masuk.pdf", "I");
