<?php
ob_start();

// Include the main TCPDF library (search for installation path).
include('vendor\tecnickcom\tcpdf\examples\tcpdf_include.php');
include('vendor\tecnickcom\tcpdf\tcpdf.php');
include 'resources\php\DbConnection.php';
include 'resources\php\validate_user.php';
require_once __DIR__ . '/vendor/autoload.php';

$dbCon = new DbConnection();
$htmlContent = $_POST['htmlContent'];

if (isset($_POST['id_promo'])) {
    $id_promotion = $_POST['id_promo'];
}

if (isset($_POST['id_disc'])) {

    $id_discipline = $_POST['id_disc'];

    $sql = "SELECT abreviere FROM specializari WHERE id = (SELECT id_specializare FROM discipline WHERE discipline.id = '$id_discipline')";
    $result = mysqli_query($dbCon->getCon(), $sql);
    $specialization = mysqli_fetch_array($result);

    $sql = "SELECT cod FROM discipline WHERE(id = '$id_discipline' )";
    $result = mysqli_query($dbCon->getCon(), $sql);
    $discipline = mysqli_fetch_array($result);

    $sql = "SELECT * FROM promotii WHERE(id = '$id_promotion' )";
    $result = mysqli_query($dbCon->getCon(), $sql);
    $promotion = mysqli_fetch_array($result);
    $start = $promotion['inceput'];
    $end = $promotion['sfarsit'];

} elseif (isset($_POST['id_spec'])) {
    $id_specialization = $_POST['id_spec'];
    $current_year = date('Y');

    $sql = "SELECT abreviere FROM specializari WHERE id = $id_specialization";
    $result = mysqli_query($dbCon->getCon(), $sql);
    $specialization = mysqli_fetch_array($result);

    $sql = "SELECT * FROM promotii WHERE(inceput = '$current_year' )";
    $result = mysqli_query($dbCon->getCon(), $sql);
    $current_promotion = mysqli_fetch_array($result);
    $start = $current_promotion['inceput'];
    $end = $current_promotion['sfarsit'];
}

if (!file_exists('resources\pi\\' . $start . '-' . $end . '\\' . $specialization['abreviere'])) {
    mkdir('resources\pi\\' . $start . '-' . $end . '\\' . $specialization['abreviere'], 0777, true);
}

if (isset($_POST['id_spec'])) {

    $mpdf = new \Mpdf\Mpdf(['default_font_size' => 11,
        'mode' => 'utf-8',
        'format' => 'A4-L', 'default_font' => 'calibri']);
    $mpdf->shrink_tables_to_fit = 1;
    $mpdf->keep_table_proportions = false;
    $stylesheet = file_get_contents('resources\css\curriculum.css');
    if (!file_exists('path/to/directory')) {
        mkdir('path/to/directory', 0777, true);
    }
    $filename = 'resources\pi\\' . $start . '-' . $end . '\\' . $_POST['abr'] . '\\' . 'PI_' . $specialization['abreviere'] . '_an' . $_POST['year'] . '.pdf';

    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($htmlContent, \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output($filename, 'F');
    echo($filename);
//    $htmlContent.='<style>'.file_get_contents('resources\css\curriculum.css').'</style>';
//    $path = 'resources/pi/' . $current_promotion['inceput'].'-'.$current_promotion['sfarsit'] .'/'. $specialization['abreviere'] . '/PI_'. $specialization['abreviere'] .'an'. $_POST['year'] . '.pdf';
}

elseif (isset($_POST['id_disc'])) {
    $pdf = new TCPDF('P', 'mm', 'A4', 'UTF-8');
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);
// set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// create new PDF document
    $pdf->SetFont('dejavusans');
    $pdf->setPrintFooter(false);
    $pdf->setPrintHeader(false);
    $pdf->AddPage();

    $htmlContent .= '<style>' . file_get_contents('resources\css\pdf_disc_file.css') . '</style>';
    $pdf->WriteHtml($htmlContent, true, false, true, false, '');
    $path = 'resources/pi/' . $promotion['inceput'] . '-' . $promotion['sfarsit'] . '/' . $specialization['abreviere'] . '/' . $specialization['abreviere'] . $discipline['cod'] . '.pdf';
    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . '/managerdiscipline/' . $path, "F");
    ob_end_clean();
    echo $path;
}
