<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Routing\Annotation\Route;

class Excel_8Controller  extends Controller
{
    /**
     * @Route("/excel/8", name="excel8")
     */
    public function index(): Response
    {
      $spreadsheet = new Spreadsheet();
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'TruckNumber');
        $sheet->setCellValue('B1', 'FullName');
		        $sheet->setCellValue('C1', 'Phone');
        $sheet->setCellValue('D1', 'OrderDate');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'OrderBookDate');
        $sheet->setCellValue('G1', 'BookTalbe');
        $sheet->setCellValue('H1', 'Adress');
        $sheet->setCellValue('I1', 'DeliveryOption');
        $sheet->setCellValue('J1', 'City');
                $sheet->setCellValue('K1', 'Note');
$sheet->setCellValue('L1', 'Carts');

        $sheet->setTitle("My First Worksheet");
        $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

$spreadsheet->getActiveSheet()->mergeCells('C1:E1');
 $sheet->setCellValue('M1', 'StatusHistory');
$a=1;
  $em = $this->getDoctrine()->getManager();
  $orders= $em->getRepository('App\Entity\Order')-> findAll();
   foreach ($orders as $order)
                {
                	$a++;
         $spreadsheet->setActiveSheetIndex(0)



                        ->setCellValue('A' . (string)($a), $order->getTruckNumber())
						                        ->setCellValue('B' . (string)($a), $order->getFullName())
                        ->setCellValue('C' . (string)($a), $order->getPhone())
                        ->setCellValue('D' . (string)($a), $order->getOrderDate())
                        ->setCellValue('E' . (string)($a), $order->getStatus())
                        ->setCellValue('F' . (string)($a), $order->getOrderBookDate())
                        ->setCellValue('G' . (string)($a), $order->getBookTalbe())
                        ->setCellValue('H' . (string)($a), $order->getAdress())
                        ->setCellValue('I' . (string)($a), $order->getDeliveryOption())
                        ->setCellValue('J' . (string)($a), $order->getCity())
                        ->setCellValue('K' . (string)($a), $order->getNote())
                        ->setCellValue('L' . (string)($a), $order->getCarts())

                         
                        ->setCellValue('M' . (string)($a), $order->getStatusHistory());
}
$spreadsheet->setActiveSheetIndex(0)->getTabColor()->setRGB('FF0000');

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        
        // In this case, we want to write the file in the public directory
        $publicDirectory = $this->get('kernel')->getProjectDir() . '/public';
        // e.g /var/www/project/public/my_first_excel_symfony4.xlsx
        $excelFilepath =  $publicDirectory . '/my_first_excel_symfony4.xlsx';
        
        // Create the file
        $writer->save($excelFilepath);
        $nomfichier="rapport.xlsx";

  header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=' . $nomfichier);
       // $writer->setIncludeCharts(true);
        $writer->save('php://output');
        exit();

        // Return a text response to the browser saying that the excel was succesfully created
        return new Response("Excel generated succesfully");
    }
	
}
