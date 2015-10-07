<?php
	include 'excel_reader.php';       // include the class
	$excel = new PhpExcelReader;      // creates object instance of the class
	$excel->read('iCleanData.xls');   // reads and stores the excel file data
	
	function getData($sheet) {		
		$users[$sheet['numCols'] - 1][3] = array();
		
		$user_task_counts[$sheet['numCols'] - 1][$sheet['numRows'] - 3] = array();
		
		$x = 1;
		
		while($x <= $sheet['numRows']) {
			
			$y = 1;
			while($y <= $sheet['numCols']) {
				if($x == 1){
					if($y <= 3){
						$titles[] = $sheet['cells'][$x][$y];
					} else {
						$tasks[] = $sheet['cells'][$x][$y];
					}
				} else {
					if($y <= 3){
						$users[$x - 2][$y - 1] = $sheet['cells'][$x][$y];
					} else {
						$user_task_counts[$x - 2][$y - 4] = $sheet['cells'][$x][$y];
					}
				}
				
				$y++;
			}  
			
			$x++;
		}
		
		sheetData($sheet, $titles, $tasks, $users, $user_task_counts);
	}
	
	function sheetData($sheet, $titles, $tasks, $users, $user_task_counts){
		for($i = 0; $i < $sheet['numRows'] - 1; $i++){
			echo "<div class = 'col-md-4 col-sm-12 col-xs-12'>";
				echo "<div class='pricing-table'>";
					echo "<div class='pricing-header'>";
						echo "<p class='pricing-title'>" . $users[$i][1] . " " . $users[$i][2] . "</p>";
						echo "<p class='pricing-rate'><sup>ID</sup> " . $users[$i][0] . "</p>";
					echo "</div>";
					
					echo "<div class='pricing-list'><ul>";
						echo "<li><i class='fa fa-signal'></i><span>" . $tasks[0] ." </span>" . $user_task_counts[$i][0] . "</li>";
						echo "<li><i class='fa fa-signal'></i><span>" . $tasks[1] ." </span>" . $user_task_counts[$i][1] . "</li>";
						echo "<li><i class='fa fa-signal'></i><span>" . $tasks[2] ." </span>" . $user_task_counts[$i][2] . "</li>";
					echo "</ul></div>";
				echo "</div>";
			echo "</div>";
		}
	}
	
	/*$nr_sheets = count($excel->sheets);       // gets the number of worksheets
	$excel_data = '';              // to store the the html tables with data of each sheet

	// traverses the number of sheets and sets html table with each sheet data in $excel_data
	for($i=0; $i<$nr_sheets; $i++) {
		$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
	}

	echo $excel_data;      // outputs HTML tables with excel file data*/
?>
        <!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>iClean</title>

            <!-- Bootstrap -->
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
            
            <!-- Main Style -->
            <link rel="stylesheet" type="text/css" href="assets/css/main.css">

            <!--Icon Fonts-->
            <link rel="stylesheet" media="screen" href="assets/fonts/font-awesome/font-awesome.min.css" />
                        
          </head>

        <body>
		<div class="container">
			<div class="jumbotron text-center clear">
				<img src = "assets/img/iClean.png" alt = "iClean.png" class = "title-image">
			</div>
	  </div>
     	<!-- Pricing Table Section -->
        <section id="pricing-table">
            <div class="container">
                <div class="row">
                    <div class="pricing">
						<?php getData($excel->sheets[0]); ?>
                    </div>
                </div>
            </div>
        </section>
		<!-- Pricing Table Section End -->
        </body>
        </html>