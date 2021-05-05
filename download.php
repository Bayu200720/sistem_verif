<?php 
	require_once('includes/load.php');
	error_reporting(0);
	// Enter the name of directory 
	$pathPr 	= "uploads/products/";  
	$pathSPM 	= "uploads/spm/";  
	$pathSP2D 	= "uploads/sp2d/";  
	$pathPJ 	= "uploads/pertanggungjawaban/";
	$pathK 		= "uploads/kekurangan/";
	
	$zip = new ZipArchive; 

	if(!empty($_GET['spm'])){
		$user 	= find_by_id('users',$_SESSION['user_id']);
		$satker = find_all_global('satker',$user['id_satker'], 'id');
		$sales 	= find_nodin_j_pengajuan_spm($_GET['spm']);

		// Enter the name to creating zipped directory 
		$zipcreated = "uploads/dokumen/Dokumen Rampung SPM ".$_GET['spm']." Tgl. ".strtotime(date('d-m-Y')).".zip"; 

		if($zip->open($zipcreated, ZipArchive::CREATE ) === TRUE) {
			if(!empty($sales[0]['upload'])){
				$zip->addFile($pathPr.$sales[0]['upload'], 'Dokumen Pengajuan '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
			}

			if(!empty($sales[0]['file_spm'])){
				$zip->addFile($pathSPM.$sales[0]['file_spm'], 'Dokumen SPM '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
			}
			
			if(!empty($sales[0]['file_sp2d'])){
				$zip->addFile($pathSP2D.$sales[0]['file_sp2d'], 'Dokumen SP2D '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
			}
			if(!empty($sales[0]['upload_pertanggungjawaban'])){
				$zip->addFile($pathSP2D.$sales[0]['upload_pertanggungjawaban'], 'Dokumen Pertanggungjawaban '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
			}
			if(!empty($sales[0]['upload_kekurangan'])){
				$zip->addFile($pathK.$sales[0]['upload_kekurangan'], 'Dokumen Kekurangan '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
			}
			$zip ->close(); 

		}

		if(filesize($zipcreated) > 0){

			$file_name = basename($zipcreated);

			header("Content-Type: application/zip");
			header("Content-Disposition: attachment; filename=$file_name");
			header("Content-Length: " . filesize($zipcreated));
			
			readfile($zipcreated);
			exit();
		}else{
			echo "<script>alert('Dokumen kosong..');window.location='Pertanggungjawaban.php';</script>";
		}
	}else if(empty($_GET['spm'])){
		$user 	= find_by_id('users',$_SESSION['user_id']);
		$satker = find_all_global('satker',$user['id_satker'], 'id');
		$arr 	= explode(',', $_GET['arr']);

		foreach ($arr as $value) {
			$sales 	= find_nodin_j_pengajuan_spm($value);
			if(!in_array('', $sales[0])){
				// Enter the name to creating zipped directory 
				$zipcreated = "uploads/dokumen/Dokumen Rampung SPM ".$value." Tgl. ".strtotime(date('d-m-Y')).".zip"; 

				if($zip->open($zipcreated, ZipArchive::CREATE ) === TRUE) {  
					if(!empty($sales[0]['upload'])){
						$zip->addFile($pathPr.$sales[0]['upload'], 'Dokumen Pengajuan '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
					}

					if(!empty($sales[0]['file_spm'])){
						$zip->addFile($pathSPM.$sales[0]['file_spm'], 'Dokumen SPM '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
					}
					
					if(!empty($sales[0]['file_sp2d'])){
						$zip->addFile($pathSP2D.$sales[0]['file_sp2d'], 'Dokumen SP2D '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
					}
					if(!empty($sales[0]['upload_pertanggungjawaban'])){
						$zip->addFile($pathSP2D.$sales[0]['upload_pertanggungjawaban'], 'Dokumen Pertanggungjawaban '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
					}
					if(!empty($sales[0]['upload_kekurangan'])){
						$zip->addFile($pathK.$sales[0]['upload_kekurangan'], 'Dokumen Kekurangan '." Tgl. ".strtotime(date('d-m-Y')).'.pdf'); 
					} 
					$zip ->close(); 
				} 
				
				if(filesize($zipcreated) > 0){

					$file_name = basename($zipcreated);

					header("Content-Type: application/zip");
					header("Content-Disposition: attachment; filename=$file_name");
					header("Content-Length: " . filesize($zipcreated));
					
					readfile($zipcreated);
					exit();
				}
			}else{
				echo "<script>alert('Dokumen kosong..');window.location='Pertanggungjawaban.php';</script>";
			}
		}
	}

?>