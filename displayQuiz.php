<?php
	include("header.php");
	include("LeftNav.php");
?>
<div class="col c8">
<form action="" method="GET">

<?php
if (isset($_GET["question1"]))
{
	$numQuestions=sizeof($_GET);
	$questionNo=0;
	$numCorrect=0;

	for ($i=0; $i<$numQuestions; $i+=2)
	{
		$questionNo=$i/2+1;
		$userAns=trim($_GET ["question".($questionNo)]);
		$correctAns=trim($_GET ["answear".($questionNo)]);
		echo "<p>question $questionNo. Your Answear Was " . $userAns . "   And the correct answer was $correctAns </p><br>";
		if ($userAns==$correctAns)
		{
			$numCorrect++;
			echo "<p style='color:green'>Correct</p>";
		}
		else 
		{
			echo "incorrect";
		}
	}
	echo "<p>You Got $numCorrect right answears </p><br>";
}
else
{


	$getQuiz=file("question.txt");
	$questionNo=0;
	for ($i=0; $i<sizeof($getQuiz); $i++)
	{
		if($i%6 == 0)				//modulo
		{
			$questionNo++;
			$answearNo=0;

			echo "<h3>". $questionNo .". ". $getQuiz[$i]."</h3>";
		}
		else if ($i%6 >0 && $i%6 <5)
		{
			$answearNo++;
			echo "<p><input type='radio' name='question$questionNo' value='$answearNo'/>". $getQuiz[$i]."</p>";	
		}
		else
		{
			$answear=$getQuiz[$i];
			echo "<input type='hidden' name='answear$questionNo' value='$answear'/>";
		}
	}
}
?>
<input type="submit" value="submit"/>
</form>


