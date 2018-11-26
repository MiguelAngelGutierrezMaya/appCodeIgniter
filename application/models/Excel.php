<?php
class Excel extends CI_Model
{
	public function __construct()
	{
		require APPPATH.'libraries/PHPExcel.php';
	}

	public function users_excel($columns,$objects,$format,$data,$index,$filename)
	{
		$objPHPExcel = new PHPExceL();
		$objPHPExcel->getProperties()->setCreator($data['creator'])->setTitle($data['title'])->setDescription($data['description'])->setKeywords($data['key_words'])->setCategory($data['category']);
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setTitle($data['title']);

		$row= 2;

		$style_columns_title = $this->style_excel();

		$objPHPExcel->getActiveSheet()->getStyle($index[0].':'.$index[count($index) - 1])->applyFromArray($style_columns_title);

		for ($i=0; $i < count($columns); $i++)
		{ 
			$objPHPExcel->getActiveSheet()->setCellValue($index[$i],$columns[$i]);
		}

		foreach ($objects as $obj)
		{
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$obj->id);
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$obj->first_name);
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$obj->last_name);
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$obj->username);
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$obj->email);
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$obj->state == 0 ? 'Inactivo' : 'Activo');
			$objPHPExcel->getActiveSheet()->setCellValue('G'.$row,$obj->type == 5 ? 'Admin' : 'User');

			$row ++;
		}

		if($format == 'xls')
		{
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$filename.'.'.$format.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		}
		else
		{
			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="'.$filename.'.'.$format.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		}
		
		$objWriter->save('php://output');
	}

	/*
		columns style excel
	*/
	private function style_excel()
	{
		return array(
		    'font' => array(
				'name'  => 'Arial',
				'bold'  => true,
				'size' =>10,
				'color' => array(
				'rgb' => 'FFFFFF'
			)),
		    'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '538DD5')
		    ),
		    'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			),
	    	'alignment' =>  array(
			'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
	    	)
		);
	}

}