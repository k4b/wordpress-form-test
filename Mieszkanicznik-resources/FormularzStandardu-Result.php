<?php 
/*
Template Name: FormularzStandardu
*/
?>

<?php get_header(); ?>
<h2  class="catheader">Formularz określania standardu mieszkania</h2>
<?php 

$form_score = 0;
$form_divider = 0;	
$final_score = 0;
$text_builder = '';
$is_text = false;

if ($_POST) { 

	foreach ($_POST as  $param_name => $param_val) {
		if($param_name == 'EndOfForm'){
			break;
		} else if($param_name == 'StartOfText') {
			$is_text = true;
		} else if($param_name == 'EndOfText') {
			$is_text = fase;
		}    

		if(is_array($param_val)){
			$text_builder .= $param_name . ': ';
			foreach($param_val as $param_val_array_element => $param_val_array_element_val){
                $labels = explode("=", $param_val_array_element_val); // parsuje "="
                $labels[0] = str_replace("-", " ", $labels[0]); // zamienia "-" na " "
                $labels[1] = str_replace("-", " ", $labels[1]); // zamienia "-" na " "
                $text_builder .= $labels[1] . ', ';
                if(is_int($labels[2])) {
                	$form_score += $labels[2];
                	$form_divider += 1;
                }
            }
        } else {
            $param_val_data = explode("=", $param_val); // parsuje "="
            $param_val_data[0] = str_replace("-", " ", $param_val_data[0]); // zamienia "-" na " "
            $param_val_data[1] = str_replace("-", " ", $param_val_data[1]); // zamienia "-" na " "

            if($is_text == true) {
            	if($param_name <> 'StartOfText' && $param_name <> 'EndOfText') {
            		$text_builder .= $param_name . ': ' . $param_val;
            	}
            } else {
            	$text_builder .= $param_val_data[0] . ': ' . $param_val_data[1];	
            }

            if(is_int($param_val)) {
            	$form_score += $param_val_data[2];
            	$form_divider += 1;
            }
        }
        $text_builder .= '<br />';
    } //foreach

    $final_score = round($form_score / $form_divider);

    echo $text_builder;

    	$numberOfStars = 3;

	switch ($numberOfStars) {
		case 1:
			$file_name = 'result01.png';
			break;
		case 2:
			$file_name = 'result02.png';
			break;
		case 3:
			$file_name = 'result03.png';
			break;
		case 4:
			$file_name = 'result04.png';
			break;
		case 5:
			$file_name = 'result05.png';
			break;		
	}

	$randomNum = rand();
	$file_copy_name =   $randomNum . $file_name;

	copy($file_name, $file_copy_name);

	echo '<img src="' . $file_copy_name . '">'; //wyswietla obrazek

} else { //ifPOST
	echo("<p> Nic nie odebrano!</p>");
} ?>

<p>Wynik punktowy to <?php echo $form_score; ?>. </p>

<script type="text/javascript">

	$(window).bind("load", function() {

		var dataString = 'id=<?php echo $file_copy_name; ?>';

  		$.ajax({
    		type:'POST',
    		data:dataString,
    		url:'FormularzStandardu-postResult.php'
  		});

	});

</script>

<?php get_footer(); ?>
