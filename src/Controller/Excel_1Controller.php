<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Routing\Annotation\Route;

class Excel_1Controller  extends Controller
{
    /**
     * @Route("/excel/1", name="excel1")
     */
    public function index(): Response
    {
      $spreadsheet = new Spreadsheet();
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'CartLines');
        $sheet->setCellValue('B1', 'OrderCart');
        $sheet->setTitle("My First Worksheet");
        $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

$spreadsheet->getActiveSheet()->mergeCells('C1:E1');
 $sheet->setCellValue('C1', 'TestMerge');
$a=1;
  $em = $this->getDoctrine()->getManager();
  $carts= $em->getRepository('App\Entity\Cart')-> findAll();
   foreach ($carts as $cart)
                {
                	$a++;
         $spreadsheet->setActiveSheetIndex(0)



                        ->setCellValue('A' . (string)($a), $cart->getCartLines())
                         
                        ->setCellValue('B' . (string)($a), $cart->getOrderCart());
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