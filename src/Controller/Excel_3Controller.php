<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Routing\Annotation\Route;

class Excel_3Controller  extends Controller
{
    /**
     * @Route("/excel/3", name="excel3")
     */
    public function index(): Response
    {
      $spreadsheet = new Spreadsheet();
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Slug');
        $sheet->setCellValue('B1', 'brochure');
		        $sheet->setCellValue('C1', 'ImageUrl');
        $sheet->setCellValue('D1', 'CreateDate');
        $sheet->setCellValue('E1', 'Products');
		        $sheet->setCellValue('F1', 'SubCategories');


        $sheet->setTitle("My First Worksheet");
        $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF0000');

$spreadsheet->getActiveSheet()->mergeCells('C1:E1');
 $sheet->setCellValue('C1', 'Cart');
$a=1;
  $em = $this->getDoctrine()->getManager();
  $categories= $em->getRepository('App\Entity\Category')-> findAll();
   foreach ($categories as $category)
                {
                	$a++;
         $spreadsheet->setActiveSheetIndex(0)



                        ->setCellValue('A' . (string)($a), $category->getSlug())
                         
                        ->setCellValue('B' . (string)($a), $category->getBrochure())
						 ->setCellValue('C' . (string)($a), $category->getImageUrl())
						 						 ->setCellValue('D' . (string)($a), $category->getCreateDate())
						 ->setCellValue('E' . (string)($a), $category->getProducts())
						 ->setCellValue('F' . (string)($a), $category->getSubCategories());
						 


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
