<?php 
	
	/**
	 * eCaesar Takes plain text encrypt it using Caesar cipher method and return the encrypted text.
	 * @param  string $plainText plain text or clear text
	 * @return string $cipherText          Encrypted text or Cipher text
	 */
	function eCaesar($plainText=""){

			$key=3;
			$plainText=trim(strtoupper($_POST['plainText']));
			//trim function removes white spaces from both end of the text
			$cipherText="";
			for($i=0; $i<strlen($plainText); $i++){//strlen() function return the length of the string.

				$cipherText.=ord($plainText[$i])+$key > 90 ? chr( (ord($plainText[$i])+$key)-25) : chr( (ord($plainText[$i])+$key)) ;
				//ord() {takes char as an argument} and returns the ASCII value of any character
				//chr() {takes int(ASCII Value) as an argument } and  returns its Character equivalent
			}

			return $cipherText;
	}

	/**
	 * dCaesar Takes Cipher text and return a equivalent plain text.
	 * @param  string $CipherText  Encrypted text
	 * @return string $plianText   Decrytped text or plain text
	 */
	function dCaesar($cipherText=""){

			$key=3;
			$cipherText=trim(strtoupper($_POST['plainText']));//strtoupper() funtion takes string as an argument and return  upper case string
			$plainText="";
			
			for($i=0; $i<strlen($cipherText); $i++){

				$plainText.=ord($cipherText[$i])-$key < 65 ? chr( (ord($cipherText[$i])-$key)+26) : chr( (ord($cipherText[$i])-$key)) ;

			}

			return $plainText;
	}

	/**
	 * eShift Takes plain text  and k vlaue to return a cipher text
	 * @param  string  $text  plain text
	 * @param  integer $shift k value
	 * @return string  $cipherText    Encrypted text or Cipher Text
	 */
	function eShift($text="",$shift=0){
			$cipherText="";
			$key=(int)$shift;//(int)type cast the $shit to integer

			for($i=0; $i<strlen($text); $i++){
				
				$cipherText.=ord($text[$i])+$key > 90 ? chr( (ord($text[$i])+$key)-26) : chr( (ord($text[$i])+$key)) ;
				//echo $cipherText;	
			}

			return $cipherText;

	}

	/**
	 * The function takes the cipher text and k value to generate the possible plain text
	 * @param string $cipher  cipher text
	 * @param integer $shift  The shift or k value of the decryption
	 * @return integer|array $plainText return a set of all possible decryption or a single plain text.
	 */

	function dShift($cipher="", $shift=26){

			$plainText="";
			$finalText= array();

			$key=(int)$shift;
			
			// if this function is called without no k value, then the following code will be executed
			// and array of possible plain text will be returned.
			if ($shift==26) {
				for ($key=0; $key<26 ; $key++) { 
			
					for($i=0; $i<strlen($cipher); $i++){
						
						$plainText.=ord($cipher[$i])-$key < 65 ? chr( (ord($cipher[$i])-$key)+26) : chr( (ord($cipher[$i])-$key)) ;
						//echo $cipherText;	
					}

					$finalText[]=$plainText;
					$plainText="";
				}
				
				return $finalText;
			}
			//the function takes the cipher text and the key value and go through the process of decryption and return a single plain text.
			else{
					//var_dump($_POST);
				for($i=0; $i<strlen($cipher); $i++){
					
					$plainText.=ord($cipher[$i])-$key < 65 ? chr( (ord($cipher[$i])-$key)+26) : chr( (ord($cipher[$i])-$key)) ;
					//echo $cipherText;	
				}

				return $plainText;
			}

			

	}

	/**
	 * Takes plain text, value of a and b and return  possible encrypted equivalent of a give plain text.
	 * @param  string  $text 			plain text
	 * @param  integer $a    			value of a
	 * @param  integer $b    			value of b
	 * @return string  $cipherText      cipher Text
	 */
	function eAffine($text="",$a=1, $b=0){

		$cipherText="";
		for ($i=0; $i < strlen($text); $i++) { 
			$cipherText.=chr((((ord($text[$i])-65)*$a)+$b)%26+65);
		}

		return $cipherText;
	}


	/**
	 * Takes the cipher text, a value, b value and return array of all the possible plain text.
	 * @param  string  $ctext cipherText
	 * @param  integer $a     aValue, must be comprime with 26
	 * @param  integer $b     b value must be set of integer from 1 to 25
	 * @return array|string        the function could return an array or a string based on the condition whether b is passed during invocation or not]
	 */
	function dAffine($ctext="", $a=1, $b=25){


		$ainv=array(1,3,5,7,9,11,15,17,19,21,23,25);
		$ainv_assoc=array(1=>1, 3=>9, 5=>21, 7=>15, 9=>3, 11=>19, 15=>7, 17=>23, 19=>11, 21=>5, 23=>17, 25=>25 );

		
		$ptext='';
		$final=array();

		//if the function is called without b value the following condition will be true
		//so at the end of the calle the funciton will return set of possible decryption results.
		if($b==25){

			for($i=0; $i<=$b; $i++ ){

				for($j=0; $j<sizeof($ainv); $j++ ){

					for($y=0; $y<strlen($ctext); $y++){
					$ainv_x_y=ord($ctext[$y])-65;
					 $ptext.=($ainv[$j]*($ainv_x_y-$i))%26+65 < 65 ? chr(($ainv[$j]*($ainv_x_y-$i))%26+65+26) : chr(($ainv[$j]*($ainv_x_y-$i))%26+65) ;
					 //chr((($ainv[$j]*ord($ctext[$y])))-$i)%26 < 65 ? chr(((($ainv[$j]*ord($ctext[$y])))-$i)%26+65) : chr((($ainv[$j]*ord($ctext[$y]))-$i)%26);
					
					 

					}
					
					$final[]=$ptext;
					$ptext="";

				}
				 
			}

			return $final;


		}
		//if b is passed when the function is called, then the following piece of code will be executed
		// and the funtion will return a single result.
		else{


			

			

				for($y=0; $y<strlen($ctext); $y++){

				 $ainv_x_y=ord($ctext[$y])-65;
				 $ptext.=($ainv_assoc[$a]*($ainv_x_y-$b))%26+65 < 65 ? chr(($ainv_assoc[$a]*($ainv_x_y-$b))%26+65+26) : chr(($ainv_assoc[$a]*($ainv_x_y-$b))%26+65) ;
				 //chr((($ainv[$j]*ord($ctext[$y])))-$i)%26 < 65 ? chr(((($ainv[$j]*ord($ctext[$y])))-$i)%26+65) : chr((($ainv[$j]*ord($ctext[$y]))-$i)%26);
				
				 

				}
					
					

		return $ptext;
		


		}

 
	}


 ?>