<?php
error_reporting(0);	
include 'datacleaning.php';

//$sentencetag=getTokenPOSTags($trainingds);
//$sentencestem=getTokenStemming($trainingds);

//writePOSTags($trainingds);
//writeStemmedTokens($trainingds);

function writePOSTags($trainingds)
{ 
	
	$tagger = new PosTagger('lexicon.txt');
	
	$filename='posTagsrawpostings.txt';
	$fp = fopen("./textfiles/" .$filename, 'w') or die("can't open file");
	   //check 800 tweets in the training dataset
   for ($i=0;$i<1025;$i++)
   {
		$j=0;

		$trainingds[$i][$j];
		//echo "<br/>";
		$string=$trainingds[$i][$j];
		$string = preg_replace('/(\s+|^)@\S+/', 'usermention', $string); 	//@usermention	
		$string = preg_replace('/(\s+|^)#\S+/', 'hastag', $string); //hashtag
		$string =preg_replace("/\'s/", "", $string); //possessive noun
		$urlRegex = '~(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))~';
		$string = preg_replace($urlRegex, '', $string); // remove urls
		$string	= preg_replace('/([0-9#][\x{20E3}])|[\x{00ae}\x{00a9}\x{203C}\x{2047}\x{2048}\x{2049}\x{3030}\x{303D}\x{2139}\x{2122}\x{3297}\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $string);
		$string	= preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $string);
		$string = preg_replace('/\s\s+/i', '', $string); // replace whitespace
		$string = trim($string); // trim the string
		$string = preg_replace('/[^a-zA-Z0-9  -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…*/
		$string = strtolower($string); // make it lowercase
	
		$tokens = explode(" ",$string);
		//$tags = $tagger->tag($string);

		$tags = $tagger->tag($string);
		/*$fe1="array number: ";
		fwrite($fp, $fe1);
		
		$fe1=$i;
		fwrite($fp, $fe1);
		$fe1=" : ";
		fwrite($fp, $fe1);*/
		
		$tokenCounter=0;
		//printTag($tags);
		foreach($tokens as $fe1) 
		{
					//echo $fe1. " ";
			fwrite($fp, "\"".$fe1."\"".",");
					//$arrayOfTokens[$i] = "\"".$fe1."\"";
					
			$tokenCounter++;	
		}
		$fe1="\r\n";
		fwrite($fp, $fe1);
		$tagCounter = 0;
		//this one gets the tags for each token of one single tweet
		foreach ($tags as $key)
		{
			$fe1=$key['tag'];
			fwrite($fp, "\"".$fe1."\"".","."\t");
			$arrayOfTags[$i][$tagCounter] = $key['tag'];
			
			$tagCounter++;
		}
		$fe1="\r\n";
		fwrite($fp, $fe1);
   }
   fclose($fp);
}	
	
/************************************************************************************
Function to get Tokens and Stemmed for each string
*************************************************************************************/
function writeStemmedTokens($trainingds)
{
	$tagger = new PosTagger('lexicon.txt');
	
	$filename='stemmedText.txt';
	$fp = fopen("./textfiles/" .$filename, 'w') or die("can't open file");
	
	
   //check 800 tweets in the training dataset
   for ($i=0;$i<1025;$i++)
   {
		$j=0;

		$trainingds[$i][$j];
		//echo "<br/>";
		$string=$trainingds[$i][$j];
		$string = preg_replace('/(\s+|^)@\S+/', 'usermention', $string); 	//@usermention	
		$string = preg_replace('/(\s+|^)#\S+/', 'hastag', $string); //hashtag
		$string =preg_replace("/\'s/", "", $string); //possessive noun
		$urlRegex = '~(?i)\b((?:[a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))~';
		$string = preg_replace($urlRegex, '', $string); // remove urls
		$string	= preg_replace('/([0-9#][\x{20E3}])|[\x{00ae}\x{00a9}\x{203C}\x{2047}\x{2048}\x{2049}\x{3030}\x{303D}\x{2139}\x{2122}\x{3297}\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $string);
		$string	= preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $string);
		$string = preg_replace('/\s\s+/i', '', $string); // replace whitespace
		$string = trim($string); // trim the string
		$string = preg_replace('/[^a-zA-Z0-9  -]/', '', $string); // only take alphanumerical characters, but keep the spaces and dashes too…*/
		$string = strtolower($string); // make it lowercase
	
		$tokens = explode(" ",$string);
		//$tags = $tagger->tag($string);

		$tags = $tagger->tag($string);
		//printTag($tags);
		//echo "array number ";
		//echo $i;
		//echo ": ";
		
		$tokenCounter=0;
		//printTag($tags);
		foreach($tokens as $fe1) 
		{
					echo $fe1. " ";
			fwrite($fp, "\"".$fe1."\"".",");
					$arrayOfTokens[$i] = "\"".$fe1."\"";
					
			$tokenCounter++;	
		}
		$fe1="\r\n";
		fwrite($fp, $fe1);
		$fe1="=>";
		fwrite($fp, $fe1);
		
		$stemCounterArray=0;
		
		foreach ($tokens as $value)
		{
			$value;
			$stem = PorterStemmer::Stem($value);
			$fe1=$stem;
			fwrite($fp, "\"".$fe1."\"".",");
			//echo $stem. "//" . " ";
			$tokenStem[$i][$stemCounterArray]=$stem;
			$stemCounterArray++;		
		}
		$arrayOfStemTokens[$i]=$tokenStem;	
		$fe1="\r\n";
		fwrite($fp, $fe1);
		$fe1="\r\n";
		fwrite($fp, $fe1);
   } //end of for loop
   fclose($fp);
} //end of function getTokenStemming()

	
	
?>
