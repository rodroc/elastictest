<?php

require_once __DIR__ .'/vendor/autoload.php';

include_once __DIR__ .'/client.php';//localhost 
//include_once __DIR__ .'/cloud-client.php'; 

class Movie{
	public $indexNum;
	public $title;
	public $genre;
	public $producer;
	public $year;
	public $time;
	public $stars;
	public $keywords;
}

$fullPath=__DIR__ .'/files/TheMovieExcelList2.txt';

$inputFileType = PHPExcel_IOFactory::identify($fullPath);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objReader->setReadDataOnly(true);
$objReader->setDelimiter("\t");
$objPHPExcel=$objReader->load($fullPath);

$worksheet=$objPHPExcel->setActiveSheetIndex(0);
$highestRow=$worksheet->getHighestRow();

$indexNum=1;
foreach ($worksheet->getRowIterator() as $row) {

	//if($indexNum>100) break;

	$rowIndex=$row->getRowIndex();
	if($rowIndex<=1) continue;
	//if(in_array($indexNum,array(1))) continue;

    $Movie=new Movie();
    $Movie->indexNum=$indexNum;
    
    //reset
    $titleKWS=array();
    $genreKWS=array();
    $producerKWS=array();
    $yearKWS=array();
    $starsKWS=array();

    $cellIterator = $row->getCellIterator();
    
    foreach ($cellIterator as $cell) {
    	//print_r($cell);

	    $kws=array();

       	$cellCoordinate=$cell->getCoordinate();
    	$cellValue=trim($cell->getValue());
     	$cellColumn=preg_replace('/\d/', '', $cellCoordinate);
     	switch($cellColumn){

     		case 'A':
     			
     			if(strlen(trim($cellValue))==0) continue;

	     		$Movie->title=$cellValue;
	     		$kws=explode(' ',$cellValue);
	     		foreach($kws as $kw){
	     			if(strlen(trim($kw))>1) $titleKWS[]=trim($kw);
	     		}
	     		break;

        	case 'B':
	        	$Movie->genre=$cellValue;
	        	$kws=explode(' ',$cellValue);
	     		foreach($kws as $kw){
	     			if(strlen(trim($kw))>1) $genreKWS[]=trim($kw);
	     		}
    			break;

        	case 'C':
        		$Movie->producer=$cellValue;
	        	$kws=explode(' ',$cellValue);
	     		foreach($kws as $kw){
	     			if(strlen(trim($kw))>1) $producerKWS[]=trim($kw);
	     		}
        		break;

        	case 'D':
        		$Movie->year=preg_replace("/[^0-9\.-]/", '', $cellValue);
        		/*
	        	$kws=explode(' ',$cellValue);
	     		foreach($kws as $kw){
	     			if(strlen(trim($kw))==4) $yearKWS[]=trim($kw);
	     		}
	     		*/
        		break;

        	case 'E':
        		$Movie->time=$cellValue;
        		break;

        	case 'F':
        		$stars=array();
        		$array=explode(',',$cellValue);
        		foreach($array as $a){
        			$stars[]=trim($a);
        		}
        		$Movie->stars=$stars;

        		$starsKWS=[];
        		foreach($stars as $star){
					$kws=explode(' ',$star);
		     		foreach($kws as $kw){
		     			if(strlen(trim($kw))>1) $starsKWS[]=trim($kw);
		     		}
	     		}
        		break;

        }//switch


    }//foreach cell

    $movieKWS=array_merge(
    	$titleKWS,
    	$genreKWS,
    	$producerKWS,
    	$yearKWS,
    	$starsKWS
    	);

	$uniqMovieKWS=array_unique($movieKWS);

	$movieKeywords=[];
	foreach($uniqMovieKWS as $k){
		$movieKW=$k;
		//$movieKW=preg_replace("/[^a-Z0-9]/", "", $k);
		//$movieKW=preg_replace("/^[a-zA-Z\d]+$/","",$k);
		if(strlen(trim($movieKW))>1) $movieKeywords[]=$movieKW;
	}
	$Movie->keywords=$movieKeywords;

    print_r($Movie);

    $params = [
    'index' => 'movies',
    'type' => 'film',
    'id' => $indexNum,
    'body' => [
    	'title' => $Movie->title,
    	'genre' => $Movie->genre,
    	'producer'=> $Movie->producer,
    	'year'=> $Movie->year,
    	'time'=> $Movie->time,
    	'stars'=> $Movie->stars,
    	'keywords'=> $Movie->keywords
    	]
	];

	$response = $client->index($params);
	print_r($response);

    //break;

    $indexNum++;
}

?>