#!/usr/bin/php -q
<?

/*********************************************
 * Recuerde cambiar la línea anterior        *
 * del binario de php, hacia la localización *
 * en su sistema.                            *
 *********************************************/

$fe = 0;
$paths = array(
	       '/usr/bin/wget',
	       '/bin/tar',
	       '/bin/gunzip',
	       '/usr/bin/cvs'
	      );
$cvsroot = ':pserver:anonymous@cvs.sourceforge.net:/cvsroot/phile';

for($a = 0; $a < 4; $a++) {
  if(!file_exists($paths[$a]) or !is_executable($paths[$a])) {
    print "ERROR: ".$paths[$a]." could not be found or it's not executable \n";
    $fe = 1;
  }
}

/*
$fr = fopen("php://stdin", "r");
$input = fgets($fr, 255);
$input = rtrim($input);
fclose($fr);
print $input;
*/

if($fe != 0) {
  print "\n";
  print "update.php - update tool for phile \n";
  print "  usage: php update.php [-wp -tp -gp -cp path]\n";
  print "         -wp path  Specify wget binary path \n";
  print "         -tp path  Specify tar binary path \n";
  print "         -gp path  Specify gunzip binary path \n";
  print "         -cp path  Specify cvs binary path \n";
} else {
  print "Press <ENTER> on CVS password input \n";
  $cvs = exec("$paths[3] -z3 -d$cvsroot login");

  if($cvs) {
    print "You are logged in :-) \n";
    $load = exec("$paths[3] -z3 -d$cvsroot co phile");
    if($load) {
      print "\n";
      print "Thanks for using phile - php file manager \n";
    } else {
      print "ERROR: Couldn't retrieve CVS tree \n";
    }
  } else {
    print "ERROR: Couldn't log in to CVS \n";
    die();
  }
}

print "\n";
?>