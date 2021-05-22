<?php

//---------------------never delete this method--------------------
function export($objPHPExcel, $filename = "spitech-data")
{
    $filename = $filename . '-[' . date('d-M-Y-H-i-s A') . "].xls";
// Redirect output to a client’s web browser (Excel5)
    header('Content-Type: app/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}

function export_transaction($aData, $filename = "demo", $sheet_title = "Exported-Report")
{    
    $ci = & get_instance();
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("SpiTech Web Services Pvt. Ltd.")
    ->setLastModifiedBy("SpiTech Web Services Pvt. Ltd.")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Reporting");
    $activeSheet = $objPHPExcel->getActiveSheet();

// Heading
    $heading = "A1:I1";
    $activeSheet->setCellValue('A1', 'Txn.Datetime')
    ->setCellValue('B1', 'Amount')
    ->setCellValue('C1', 'Customer')
    ->setCellValue('D1', 'Mobile')
    ->setCellValue('E1', 'Payment Datetime')
    ->setCellValue('F1', 'Particulars')
    ->setCellValue('G1', 'Type')
    ->setCellValue('H1', 'Remark')
    ->setCellValue('I1', 'Status');

// Body
    $body_style = array('font' => array('size' => 10, 'bold' => FALSE, 'color' => array('rgb' => '000000')));
    $i = 2;
    //debug($aData);
    foreach ($aData as $data) {
        $activeSheet->getStyle('A' . $i . ':I' . $i)->applyFromArray($body_style);
        $activeSheet->setCellValue('A' . $i, config_date($data->datetime))
            ->setCellValue('B' . $i, $data->amount)
            ->setCellValue('C' . $i, $data->first_name.' '.$data->last_name)
            ->setCellValue('D' . $i, $data->mobile)
            ->setCellValue('E' . $i, config_date($data->payment_datetime))
            ->setCellValue('F' . $i, $data->particulars)
            ->setCellValue('G' . $i, $data->type)
            ->setCellValue('H' . $i, $data->remark)
            ->setCellValue('I' . $i, get_payment_status($data->status));
            $i++;
        }

    //--decoration----------
        for ($col = ord('A'); $col <= ord('I'); $col++) {
            $activeSheet->getColumnDimension(chr($col))->setAutoSize(true);
        }
        $heading_style = array('font' => array('size' => 10, 'bold' => true, 'color' => array('rgb' => '000000')));
        $activeSheet->getStyle($heading)->applyFromArray($heading_style);
        $activeSheet->getStyle($heading)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

        $activeSheet->setTitle($sheet_title);
        $objPHPExcel->setActiveSheetIndex(0);
        export($objPHPExcel, $filename);
    }

    function export_customer($aData, $filename = "demo", $sheet_title = "Exported-Report")
    {    
        $ci = & get_instance();
        $objPHPExcel = new PHPExcel();
    // Set document properties
        $objPHPExcel->getProperties()->setCreator("SpiTech Web Services Pvt. Ltd.")
        ->setLastModifiedBy("SpiTech Web Services Pvt. Ltd.")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Reporting");
        $activeSheet = $objPHPExcel->getActiveSheet();

// Heading
        $heading = "A1:I1";
        $activeSheet->setCellValue('A1', 'First Name')
        ->setCellValue('B1', 'Last Name')
        ->setCellValue('C1', 'Mobile')
        ->setCellValue('D1', 'Email')
        ->setCellValue('E1', 'Department')
        ->setCellValue('F1', 'Address')
        ->setCellValue('G1', 'Country')
        ->setCellValue('H1', 'State')
        ->setCellValue('I1', 'City');

// Body
        $body_style = array('font' => array('size' => 10, 'bold' => FALSE, 'color' => array('rgb' => '000000')));
        $i = 2;
    //debug($aData);
        foreach ($aData as $data) {
            $activeSheet->getStyle('A' . $i . ':I' . $i)->applyFromArray($body_style);
            $activeSheet->setCellValue('A' . $i, $data->first_name)
            ->setCellValue('B' . $i, $data->last_name)
            ->setCellValue('C' . $i, $data->mobile)
            ->setCellValue('D' . $i, $data->email)
            ->setCellValue('E' . $i, $data->department)
            ->setCellValue('F' . $i, $data->address)
            ->setCellValue('G' . $i, $data->country_name)
            ->setCellValue('H' . $i, $data->state_name)
            ->setCellValue('I' . $i, $data->city_name);
            $i++;
        }

    //--decoration----------
        for ($col = ord('A'); $col <= ord('I'); $col++) {
            $activeSheet->getColumnDimension(chr($col))->setAutoSize(true);
        }
        $heading_style = array('font' => array('size' => 10, 'bold' => true, 'color' => array('rgb' => '000000')));
        $activeSheet->getStyle($heading)->applyFromArray($heading_style);
        $activeSheet->getStyle($heading)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

        $activeSheet->setTitle($sheet_title);
        $objPHPExcel->setActiveSheetIndex(0);
        export($objPHPExcel, $filename);
    }

    function export_staff($aData, $filename = "demo", $sheet_title = "Exported-Report")
    {
    //debug($aData);
        $ci = & get_instance();
        $objPHPExcel = new PHPExcel();
    // Set document properties
        $objPHPExcel->getProperties()->setCreator("SpiTech Web Services Pvt. Ltd.")
        ->setLastModifiedBy("SpiTech Web Services Pvt. Ltd.")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Reporting");
        $activeSheet = $objPHPExcel->getActiveSheet();

// Heading
        $heading = "A1:I1";
        $activeSheet->setCellValue('A1', 'First Name')
        ->setCellValue('B1', 'Last Name')
        ->setCellValue('C1', 'Mobile')
        ->setCellValue('D1', 'Email')
        ->setCellValue('E1', 'Department')
        ->setCellValue('F1', 'Address')
        ->setCellValue('G1', 'Country')
        ->setCellValue('H1', 'State')
        ->setCellValue('I1', 'City');

// Body
        $body_style = array('font' => array('size' => 10, 'bold' => FALSE, 'color' => array('rgb' => '000000')));
        $i = 2;
    //debug($aData);
        foreach ($aData as $data) {
            $activeSheet->getStyle('A' . $i . ':I' . $i)->applyFromArray($body_style);
            $activeSheet->setCellValue('A' . $i, $data->first_name)
            ->setCellValue('B' . $i, $data->last_name)
            ->setCellValue('C' . $i, $data->mobile)
            ->setCellValue('D' . $i, $data->email)
            ->setCellValue('E' . $i, $data->department)
            ->setCellValue('F' . $i, $data->address)
            ->setCellValue('G' . $i, $data->country_name)
            ->setCellValue('H' . $i, $data->state_name)
            ->setCellValue('I' . $i, $data->city_name);
            $i++;
        }

    //--decoration----------
        for ($col = ord('A'); $col <= ord('I'); $col++) {
            $activeSheet->getColumnDimension(chr($col))->setAutoSize(true);
        }
        $heading_style = array('font' => array('size' => 10, 'bold' => true, 'color' => array('rgb' => '000000')));
        $activeSheet->getStyle($heading)->applyFromArray($heading_style);
        $activeSheet->getStyle($heading)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

        $activeSheet->setTitle($sheet_title);
        $objPHPExcel->setActiveSheetIndex(0);
        export($objPHPExcel, $filename);
    }


//--------------Artist Export----------------
    function export_artist($aData, $filename = "demo", $sheet_title = "Exported-Report")
    {
    //debug($aData);
        $ci = & get_instance();
        $objPHPExcel = new PHPExcel();
    // Set document properties
        $objPHPExcel->getProperties()->setCreator("SpiTech Web Services Pvt. Ltd.")
        ->setLastModifiedBy("SpiTech Web Services Pvt. Ltd.")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Reporting");
        $activeSheet = $objPHPExcel->getActiveSheet();

// Heading
        $first_column="A";    
        $last_column="G";
        $heading = $first_column.'1:'.$last_column.'1';

        $activeSheet->setCellValue($first_column.'1', 'Artist Name')   
        ->setCellValue('B1', 'Mobile')
        ->setCellValue('C1', 'Email')
        ->setCellValue('D1', 'Address')
        ->setCellValue('E1', 'Country')
        ->setCellValue('F1', 'State')
        ->setCellValue($last_column.'1', 'City');

  // Body
        $body_style = array('font' => array('size' => 10, 'bold' => FALSE, 'color' => array('rgb' => '000000')));
        $i = 2;
    //debug($aData);
        foreach ($aData as $data) {
            $activeSheet->getStyle($first_column.$i . ':'.$last_column. $i)->applyFromArray($body_style);
            $activeSheet->setCellValue($first_column. $i, $data->name)      
            ->setCellValue('B' . $i, $data->mobile)
            ->setCellValue('C' . $i, $data->email)
            ->setCellValue('D' . $i, $data->address)
            ->setCellValue('E' . $i, $data->country_name)
            ->setCellValue('F' . $i, $data->state_name)
            ->setCellValue($last_column . $i, $data->city_name);
            $i++;
        }

    //--decoration----------
        for ($col = ord($first_column); $col <= ord($last_column); $col++) {
            $activeSheet->getColumnDimension(chr($col))->setAutoSize(true);
        }
        $heading_style = array('font' => array('size' => 10, 'bold' => true, 'color' => array('rgb' => '000000')));
        $activeSheet->getStyle($heading)->applyFromArray($heading_style);
        $activeSheet->getStyle($heading)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

        $activeSheet->setTitle($sheet_title);
        $objPHPExcel->setActiveSheetIndex(0);
        export($objPHPExcel, $filename);
    }