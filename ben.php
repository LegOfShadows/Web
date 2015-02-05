<?php
if (isset ( $_POST ['get'] )) {
	require_once (ROOT . '\tcpdf\examples\tcpdf_include.php');
	
	$invoice = $_POST['get'];
	
	$num = $invoice ['num'];
	$date = DateTime::createFromFormat("dmY",$invoice ['date']);
	$date = date_format($date, "M j, Y");
	$qty = $invoice ['qty'];
	$cost = $invoice ['cost'];
	$total = $invoice ['total'];
		
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Benoit Courville');
	$pdf->SetTitle('BC$num');
	$pdf->SetSubject('Invoice');
	//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
	
	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}
	
	// ---------------------------------------------------------
	
	// set font
	//$pdf->SetFont('times', 'B', 20);
	
	// add a page
	$pdf->AddPage();
	
	// set some text to print
	$txt = <<<EOD
<html>
<head>
<style>
html, body {
	margin: 0px;
	padding: 15px;
	font-size: 19px;
	font-family: Helvetica;
}
div {
	height: 20px;
	line-height: 20px;
}
h4 {
	font-size: 27px;
}
h1 {
	font-size: 36px;
	font-style: italic;
	text-decoration: underline;
}

table {
	margin-top: 50px;
	margin-bottom: 50px;
	width: 100%;
	border-collapse: collapse;
	font-size: 13px;
}
#phone {
	margin-left: 75px;
}
th {
	border-bottom: 1px solid #aaa;
	text-align: left;
	font-weight: bold;
	height: 23px;
}
td {
	padding: 5px;
	height: 21px;
}
.ralign {
	text-align: right;
}
.lalign {
	text-align: left;
}
.bold {
	font-weight: bold;
}
.uline {
	text-decoration: underline;
}
.space {
	height: 50px;
}
</style>
</head>
<body>
<h4>Invoice BC$num</h4>
<h1>Benoit Courville</h1>
<div>
	<a href="mailto:benoit.courville@outlook.com">benoit.courville@outlook.com</a>
	<span id="phone">(514) 358-3701</span>
</div>
<div>18372 Amalfi, Pierrefonds, Quebec, Canada</div>
<div class="space"></div>
<div>Invoice Period: ending $date</div>
<div>Invoiced to: Synergy Cycle -- <a href="mailto:info@synergycycle.ca">info@synergycycle.ca</a></div>
<div class="space"></div>
<table>
	<tr>
		<th style="width:10%;">Quantity</th>
		<th style="width:70%;">Description of Items Invoiced</th>
		<th style="width:10%;">Price</th>
		<th style="width:10%;">Total</th>
	</tr>
	<tr>
		<td class="ralign">$qty</td>
		<td>x 1 Hour of Mechanical Service for Bicycles + Management Assistance</td>
		<td>$$cost</td>
		<td>$$total</td>
	</tr>
	<tr class="bold">
		<td class="ralign" colspan="3">Grand Total</td>
		<td class="lalign">$$total</td>
	</tr>
</table>
<div class="space"></div>
<div class="ralign uline" >Invoice Status: <span class="bold">UNPAID</span></div>
<div class="ralign">Merci!</div>
<div class="ralign">Benoit Courville</div>

</body>
</html>
EOD;
	
	// print a block of text using Write()
	$pdf->writeHTML($txt, true, false, true, false, '');
	
	// ---------------------------------------------------------
	
	//Close and output PDF document
	$pdf->Output('example_002.pdf', 'I');
	
	//============================================================+
	// END OF FILE
	//============================================================+
	
}