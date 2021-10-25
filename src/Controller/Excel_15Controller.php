<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Routing\Annotation\Route;

class Excel_15Controller  extends Controller
{
    /**
     * @Route("/excel/15", name="excel15")
     */
    public function index(): Response
    {
      $spreadsheet = new Spreadsheet();
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Category');
        $sheet->setCellValue('B1', 'Slug');
		        $sheet->setCellValue('C1', 'Brochure');
        $sheet->setCellValue('D1', 'ImageUrl');
        $sheet->setCellValue('E1', 'CreateDate');

        $sheet->setTitle("My First Worksheet");
        $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

$spreadsheet->getActiveSheet()->mergeCells('C1:E1');
 $sheet->setCellValue('F1', 'Products');
$a=1;
  $em = $this->getDoctrine()->getManager();
  $sub_categories= $em->getRepository('App\Entity\SubCategory')-> findAll();
   foreach ($sub_categories as $sub_category)
                {
                	$a++;
         $spreadsheet->setActiveSheetIndex(0)



                        ->setCellValue('A' . (string)($a), $sub_category->getCategory())
						 ->setCellValue('B' . (string)($a), $sub_category->getSlug())
						                         ->setCellValue('C' . (string)($a), $sub_category->getBrochure())
                        ->setCellValue('D' . (string)($a), $sub_category->getImageUrl())
                        ->setCellValue('E' . (string)($a), $sub_category->getCreateDate())
                        ->setCellValue('F' . (string)($a), $sub_category->getProducts());


                         
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
