<!-- adminvisbrukere.php -->
<?php include "start.php"; ?>

<?php //Sjekk hvilken rolle bruker har
  @$innloggetBruker=$_SESSION; //@ for å slippe unødig warning
  if ($innloggetBruker['rolle']!="admin") {
    print("Denne siden krever innlogging!<br>");

    print("Du vil bli sendt til innlogging om 2 sekunder");

    include "slutt.html";

    die ("<meta http-equiv='refresh' content='2;url=innlogging.php'>");
  }
?>

<?php

	$sqlSetning		= "SELECT brukernavn, rolle FROM bruker ORDER BY brukernavn ASC;";
	$sqlResultat	= mysqli_query($db,$sqlSetning) or die ("ikke mulig å hente fra database-server");

	$antallRader	= mysqli_num_rows($sqlResultat);


	  print ("<h3>Registrerte Brukere</h3>");
	  print ("<table border=1>");  
	  print ("<tr><th align=left>Brukernavn</th> <th align=left>Rolle</th></tr>"); 


	for ($r=1;$r<=$antallRader;$r++) 
		{ 
			$rad=mysqli_fetch_array($sqlResultat,MYSQLI_ASSOC);
			$brukernavn=$rad['brukernavn']; 
			$rolle=$rad['rolle']; 

			//utf8_encode for at den skal vise spesialtegn som "å" vanlig.
			print("<tr> <td> $brukernavn </td> <td> $rolle </td></tr>");
		}
		print("</table>");

?>

<?php include "slutt.html" ?>