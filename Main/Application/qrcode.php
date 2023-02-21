<?php
//include "../../Main/Config/db_conn.php";
include('../../Patients/phpqrcode/qrlib.php');
//include('../../Patients/Application/PatientCard.php');
//$Id=156;
$PatId=htmlentities($_REQUEST['PatId'],ENT_QUOTES);
$FirstName=htmlentities($_REQUEST['FirstName'],ENT_QUOTES);
$Lastname=htmlentities($_REQUEST['Lastname'],ENT_QUOTES);
$HospitalName=htmlentities($_REQUEST['HospitalName'],ENT_QUOTES);
$qrcode = 'PATIENT NAME: '.$FirstName .' '.$Lastname.' | PATIENT NO: '.$PatId.'<br>[TREATED AT '.$HospitalName."]";
    QRcode::png($qrcode);
