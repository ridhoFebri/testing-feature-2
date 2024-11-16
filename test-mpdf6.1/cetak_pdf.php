<?php
// Include mPDF
require_once __DIR__ . '/mpdf/mpdf.php';

$html = '

<pagefooter name="myFooter1" content-left="My Book Title" content-center="myFooter1" content-right="{PAGENO}" footer-style="font-family:sans-serif; font-size:8pt; font-weight:bold; color:#008800;" footer-style-left="" line="on" />
<p>
eifherufherifher ufheru erf

<br>

e8fherfgufoeheyr u

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
fweuih8fuheo8
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br><br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
gergregregrgr</p>
';

$mpdf = new mPDF();

$mpdf->SetFooter('Halaman {PAGENO} dari {nb}');
$mpdf->WriteHTML($html);

$mpdf->Output();
exit;