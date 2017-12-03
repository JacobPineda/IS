<?php
session_start();
//setting header to json
header('Content-Type: application/json');
include("../connect.php");


function isNotFromTable($columnName){
	
	$arrColsNotFromTable = array('manufacturer', 'importer', 'trader', 'distributor');
	
	foreach($arrColsNotFromTable  as $i){
		if($i == $columnName){
			return true;
		}
	}
	return false;
	
}

//for default graph generation only
function getQryFromOtherTable($column){
	$statement = "";
	$col = null;
	$relTable = null;
	$priKey = null;
	$criteria = null;
	
	switch($_SESSION['table']){
		case 'Drug':
			$col = 'drug_cpr_no';
			$priKey = 'cpr_no';
			break;
		case 'Food':
			$col = 'food_cpr_no';
			$priKey = 'cpr_no';
			break;
		case 'School':
			$col = 'school_id';
			$priKey = 'school_id';
			break;		
		default:
			$col = null;
			$priKey =  null;			
	}		
	
	switch($column){
		case 'manufacturer':
			$relTable = 'Manufactures';
			$criteria = "{$col} in (select {$priKey} from {$_SESSION['table']}) and {$col} not in ('0'))";
			break;
		case 'importer':
			$relTable = 'Imports';
			$criteria =  "{$col} in (select {$priKey} from {$_SESSION['table']}) and {$col} not in ('0'))";
			break;
		case 'trader':
			$relTable = 'Trades';
			$criteria =  "{$col} in (select {$priKey} from {$_SESSION['table']}) and {$col} not in ('0'))";
			break;
		case 'distributor':
			$relTable = 'Distributes';
			$criteria =  "{$col} in (select {$priKey} from {$_SESSION['table']}) and {$col} not in ('0'))";
			break;
		default:
			$relTable = null;
	}
	
	return ",(select count({$col}) from {$relTable} where {$criteria} as {$column}";
	
}

/*
*generate default result 
*conn - MySQL connection
*/
function generateDefaultResult($conn){
	$asColumns = "Total records";
	for ($i = 0; $i < count($_SESSION['arrCheckedVals']); $i++){
		$asColumns .= ",{$_SESSION['arrCheckedVals'][$i]}";
	}
	
	$remainingCols = "";
	for ($i = 0; $i < count($_SESSION['arrCheckedVals']); $i++){
		$remainingCols .= (!isNotFromTable($_SESSION['arrCheckedVals'][$i]))? ",count(*) -1 -  sum(case when {$_SESSION['arrCheckedVals'][$i]} is null then 1 else 0 end) as {$_SESSION['arrCheckedVals'][$i]}" : getQryFromOtherTable($_SESSION['arrCheckedVals'][$i]);
	}

	$query = sprintf("SELECT '{$asColumns}' as columns,  count(*) - 1 as 'Total records' {$remainingCols}  FROM {$_SESSION['table']} ");
	$result = $conn->query($query);
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	$data[] = (object) array('tableName' => $_SESSION['table']);
	$result->close();
	
	return $data;
}


function generate_prod_vs_Country($conn){
	
	$query = sprintf("SELECT country, count(*) as total FROM {$_SESSION['table']} where cpr_no not in ('0') GROUP BY country");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
		
}

function generate_no_of_school_region($conn){
	
	$query = sprintf("SELECT (SELECT region_name FROM region r where s.region_id = r.region_id) as region, count(*) as total FROM {$_SESSION['table']} s GROUP BY region");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
		
}

function generate_no_of_student_course($conn, $table){
	
	$query = sprintf("SELECT (SELECT course_name FROM course c where c.course_id = s.course_id) as course, count(*) as total FROM $table s GROUP BY course");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
	
}

function generate_no_of_students($conn, $table){
	
	$query = sprintf("SELECT gender, count(*) as total FROM $table GROUP BY gender");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
	
}

function generate_no_student_pes($conn, $table){
	$query = sprintf("SELECT (SELECT school_name FROM Public_Elementary_School p WHERE s.elementary_school_id = p.elementary_school_id) as school, SUM(s.no_of_students) as total FROM $table s GROUP BY elementary_school_id");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;		
	
}
function generate_no_student_grade($conn, $table){
	$query = sprintf("SELECT (SELECT level_name FROM Grade_Level g WHERE o.level_id = g.level_id) as level, SUM(o.no_of_students) as total FROM $table o GROUP BY level_id");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;		
	
}

function generate_no_of_entities($conn, $column, $table){
	
	$criteria = null;
	$priKey = null;
	switch($_SESSION['table']){
		case 'Drug':
			$priKey = 'drug_cpr_no';
			break;
		case 'Food':
			$priKey = 'food_cpr_no';
			break;
		default:
			$priKey = null;
	}
	switch($table){
		case 'Drug':
			$criteria = " where cpr_no not in ('0')";
			break;
		case 'Food':
			$criteria =  " where cpr_no not in ('0')";
			break;
		case 'Manufacturer':
			$criteria =  " where manu_no in (select manu_no from Manufactures where {$priKey} not in ('0'))";
			break;
		case 'Importer':
			$criteria =  " where importer_no in (select importer_no from Imports where {$priKey} not in ('0'))";
			break;
		case 'Trader':
			$criteria =  " where trader_no in (select trader_no from Trades where {$priKey} not in ('0'))";
			break;
		case 'Distributor':
			$criteria =  " where dist_no in (select dist_no from Distributes where {$priKey} not in ('0'))";
			break;
		default:
			$criteria = null;
		
	}	
	
	$query = sprintf("SELECT {$column}, count(*) as total FROM {$table}  {$criteria} GROUP BY {$column} ");
	$result = $conn->query($query);
	
	$data = array();
	foreach ($result as $row) {
		$data[] = $row;
	}
	
	$result->close();
	
	return $data;	
		
}



//start here
switch($_SESSION['selected_report']){
	case 'default': 
		$data = generateDefaultResult($conn);
		break;
	case 'no_of_prod_country':
		$data = generate_prod_vs_Country($conn);
		break;		
	case 'no_of_generic_name':
		$data = generate_no_of_entities($conn, 'generic_name',$_SESSION['table']);
		break;			
	case 'no_of_branded_prod':
		$data = generate_no_of_entities($conn, 'brand_name',$_SESSION['table']);
		break;			
	case 'no_of_manufacturer':
		$data = generate_no_of_entities($conn, 'name','Manufacturer');
		break;			
	case 'no_of_importer':
		$data = generate_no_of_entities($conn, 'name','Importer');
		break;			
	case 'no_of_trader':
		$data = generate_no_of_entities($conn, 'name','Trader');
		break;			
	case 'no_of_distributor':
		$data = generate_no_of_entities($conn, 'name','Distributor');
		break;				
	case 'no_of_school_region':
		$data = generate_no_of_school_region($conn);
		break;					
	case 'no_of_student_course':
		$data = generate_no_of_student_course($conn, 'Student');
		break;					
	case 'no_of_male_vs_female':
		$data = generate_no_of_students($conn, 'Student');
		break;			
	case 'no_of_student_public_elem_school':
		$data = generate_no_student_pes($conn, 'Offers');
		break;			
	case 'no_of_student_grade_level':
		$data = generate_no_student_grade($conn, 'Offers');
		break;			
		
	default: 
		$data = generateDefaultResult($conn);

}



$conn->close();
print json_encode($data);