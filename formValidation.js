function validateForm()
{

	var firstName=document.forms["theForm"]["forename"].value;
	var secondName=document.forms["theForm"]["surname"].value;
	var x=document.forms["theForm"]["email"].value;
	var password=document.forms["theForm"]["password"].value;
	var cpassword=document.forms["theForm"]["cpassword"].value;
	var type=document.forms["theForm"]["type"].value;

	var numberExpression = /^[0-9]+$/;
	var letterExpression = /^[a-zA-Z]+$/;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");

	if (firstName=="")
		{
		alert("First name must be filled out");
		return false;
		}

	if (!firstName.match(letterExpression))
		{
		alert("Letters Only Please");
		return false;
		}

	if (firstName.length <= 2)
	{
		alert("First name must more than 2 characters long");
		return false;
	}

	if (secondName=="")
		{
		alert("Second name must be filled out");
		return false;
		}

	if (!secondName.match(letterExpression))
			{
			alert("Letters Only Please");
			return false;
			}

	if (secondName.length <= 2)
		{
			alert("Surname name must more than 2 characters long");
			return false;
		}
	if ((atpos<1) || (dotpos<atpos+2) || (dotpos+2>=x.length))
		{
			alert ("Not a valid e-mail address");
			return false;
		}

	if (password == "")
		{
			alert("Please Enter a Password");
			return false;
		}

	if (cpassword !== password)
		{
			alert("Passwords do not match");
			return false;
		}

	if (type=="Please Choose")
		{
			alert("You must choose a user type");
			return false;
		}

}