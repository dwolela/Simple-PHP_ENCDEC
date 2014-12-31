<?php 
/**
 * Date: DEC 10, 2014
 * Course: Cryptography
 * Instructor: Dr. Jejaw
 * Assignment: Encryption|Decryption Functionlaity using Affine, Caesar and Shift Cipher
 * Author: Daniel Teshager
 * E-mail:dwolela@gmail.com
 */
 include 'inc/functions.php';
 $message="";
 $resultSet=array();
 $command="";
 $encryption="";
 $original_val="";
 if (isset($_POST['submit']) && $_POST['command']=='encrypt' && !empty($_POST['plainText'])) {

 	$command='Encryption';

 	

 		if($_POST['enc_type']=='ceasar'){
 			
 			$resultSet= eCaesar($_POST['plainText']);
 			$encryption=ucwords($_POST['enc_type']);
 			$original_val=$_POST['plainText'].' =>';
 		}

 	
		else if ($_POST['enc_type']=='shift') {
			
			
				$resultSet= eShift(trim(strtoupper($_POST['plainText'])), (int)$_POST['shift'] );
				$encryption=ucwords($_POST['enc_type']);
				$original_val=$_POST['plainText'].' =>';
			
		}

		else if ($_POST['enc_type']=='affine') {
				//echo 'called';
			
				$resultSet= eAffine(trim(strtoupper($_POST['plainText'])), (int)$_POST['a'], (int)$_POST['b']);
				$encryption=ucwords($_POST['enc_type']);
				$original_val=$_POST['plainText'].' =>';
			
		}

 

}
 



else if(isset($_POST['submit']) && $_POST['command']=='decrypt'  && !empty($_POST['plainText'])){

	$command='Decryption';

	if(!empty($_POST['plainText'])){

 		if($_POST['enc_type']=='ceasar'){
 			
 			$resultSet= dCaesar($_POST['plainText']);
 			$encryption=ucwords($_POST['enc_type']);
 			$original_val=$_POST['plainText'].' =>';
 		}
 		else if($_POST['enc_type']=='shift'){
 			if(empty($_POST['shift'])){
 				$resultSet= dShift(trim(strtoupper($_POST['plainText'])));
 				$encryption=ucwords($_POST['enc_type']);
 				$original_val=$_POST['plainText'].' =>';
 			}
 			else{
 				$resultSet= dShift(trim(strtoupper($_POST['plainText'])), trim($_POST['shift']));
 				$encryption=ucwords($_POST['enc_type']);
 				$original_val=$_POST['plainText'].' =>';
 			}
 			
 			//echo $resultSet;
 		}
 		else if($_POST['enc_type']=='affine'){

 			if(empty($_POST['b'])){
 				$resultSet= dAffine(trim(strtoupper($_POST['plainText'])));
				$encryption=ucwords($_POST['enc_type']);
				$original_val=$_POST['plainText'].' =>';
 			}else{
 				$resultSet= dAffine(trim(strtoupper($_POST['plainText'])),(int)trim($_POST['a']), (int)trim($_POST['b']));
				$encryption=ucwords($_POST['enc_type']);
				$original_val=$_POST['plainText'].' =>';

 			}
 			

 		}

 	}	

}
else
{
 $resultSet="";
}


 ?>

<!DOCTYPE html>
<html ng-app="">
<head>
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body class="">

<div id="message" class="hide">
			<p></p>
</div>


	<header>
		<div class="container text-center">
			<h1>Encryption & Decryption App</h1>
		</div>
	</header>

	<div class="container center-content">

	<form action="index.php" method="POST" role="form" class="form" >
		
		<h2>Choose Encryption Type: </h2>
		<hr>
				<label class="radio-inline">
					<input type="radio"   class="radio"  name="enc_type" value="ceasar" id="ceasar" class="form-control"  checked > Caesar
				</label>
				
				<label class="radio-inline">
				<input type="radio"   class="radio"  name="enc_type" value="affine" id="affine" class="form-control">
				Affine</label>
				
				<label class="radio-inline">
				<input type="radio"   class="radio"  name="enc_type" value="shift" id="shiftToggle" class="form-control">
				Shift</label>
			<br><br>

				
		

		
		
		<div class="form-group">
			<label for="plainText">Plain/Cipher Text</label>
			<input type="text" name="plainText" placeholder="Enter the plain text" id="plainText" class="form-control input-sm-4">
		</div>

		<div class="form-group shift hide">
			<label for="shift">Shift#</label>
			<input type="number" name="shift" placeholder="Shift" id="shift" class="hide shift form-control">
		</div>


		<!-- <input type="text" name="a" placeholder="a value" id="a" class="affine hide"> -->
		<div class="form-group affine hide">
			<label for="a">A Value</label>
			<select name="a" id="a" class="affine hide form-control">
				<option value="1">1</option>
				<option value="3">3</option>
				<option value="5">5</option>
				<option value="7">7</option>
				<option value="9">9</option>
				<option value="11">11</option>
				<option value="13">13</option>
				<option value="15">15</option>
				<option value="17">17</option>
				<option value="19">19</option>
				<option value="23">23</option>
				<option value="25">25</option>
			</select>

		</div>

		<div class="form-group affine hide">
			<label for="b" class="">B Value</label>
			<input type="number" name="b" placeholder="b value" id="b" class="affine hide form-control">
		</div>

		<div class="form-group">
		<label for="command">Command</label>
			<select name="command" class="form-control" id="command">
				<option value="encrypt">Encrypt</option>
				<option value="decrypt">Decrypt</option>
			</select>
		</div>

		<button type="submit" name="submit"  class="btn btn-primary">Compute</button>
		
		<input type="hidden" name="hidden_command" value="<?php if(isset($_POST['command'])){ echo ucwords($_POST['command']);}?>">
		
	</form><!--, end of form -->


	<div class="slideToggle "><p class="text-center">Less-</p></div>

	<br>
	<h2><?php echo $command; ?> Result  <?php echo 'of '.$encryption.' Cipher'; ?></h2>
	<hr>
	


	</div>

	<div class="container alert alert-success <?php if(sizeof($resultSet)<2){ echo 'show';}else{ echo 'hide';} ?>">
		<?php echo $original_val.' '.$resultSet; ?>
	</div>

	<div class="<?php if(sizeof($resultSet)<2){ echo 'hide';}else{ echo 'show';} ?> container">

		<table class="table table-striped table-hover content-center">
			<tr>
				
					<th id="th">Shift by</th>
					<th>Possible Plain Text</th>
				
			</tr>
			<?php 

				foreach ($resultSet as $key=>$value) {
					?>
					<tr>
						<td><?php  echo $key;?></td>
						<td class="message"><?php  echo $value;?></td>
						


					</tr>


					<?php 
				}

			 ?>

		</table>

	</div><!--, end of table container div -->


	</div><!--, end container -->
	<script src="js/angular.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/app.js"></script>

</body>



</html>



