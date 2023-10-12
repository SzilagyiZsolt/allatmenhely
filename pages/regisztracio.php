<?php
$emailErr = $szigszamErr = $passErr = $pass2Err = "";
$emails = $szigszam = $pass1 = $pass2 = "";

if (filter_input(INPUT_POST, "regisztraciosAdatok", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
    $pass1 = filter_input(INPUT_POST, "InputPassword");
    $pass2 = filter_input(INPUT_POST, "InputPassword2");
    $szigszam = filter_input(INPUT_POST, "szigszam");
    //$emails = filter_input(INPUT_POST, "useremail");
    $usersnames = filter_input(INPUT_POST, "username");
    $name = htmlspecialchars(filter_input(INPUT_POST, "felhasznalonev"));
    //-- validálás 
    $uppercase = preg_match('@[A-Z]@', $pass1);
    $lowercase = preg_match('@[a-z]@',  $pass1);
    $number    = preg_match('@[0-9]@',  $pass1);
} 


if (empty($_POST["useremail"])) 
{
    $emailErr = "Adj meg emailcímet";
} 
else {
    $emails = test_input($_POST["useremail"]);
    // check if e-mail address is well-formed
    if (!filter_var($emails, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Nem valós emailcím";
    }
}
if (empty($_POST["szigszam"])) 
{
    $szigszamErr = "Add meg az igazolványszámod";
} 
else {
    $szigszam = test_input($_POST["szigszam"]);
    // check if e-mail address is well-formed
    if (strlen($szigszam)!=8) {
      $szigszamErr = "Nem valós igazolványszám";
    }
}
if (empty($_POST["InputPassword"])) 
{
    $passErr = "Add meg a jelszót";
} 
else {
    $pass1 = test_input($_POST["InputPassword"]);
    // check if e-mail address is well-formed
    if (!$uppercase || !$lowercase || !$number || strlen( $pass1) < 8) {
      $passErr = "A jelszó nem helyes";
    }
}
if (empty($_POST["InputPassword2"])) 
{
    $pass2Err = "Add meg a jelszót mégegyszer";
} 
else {
    $pass2 = test_input($_POST["InputPassword2"]);
    // check if e-mail address is well-formed
    if ($pass1!=$pass2)
    {
        $pass2Err = "A két jelszó nem egyezik";
    }
}
if ($passErr == "" && $szigszamErr == "" && $emailErr == "") 
{
    //-- regisztráció indítása
    $db->register($szigszam,$name,$emails,$usersnames, $pass1);
    header("Location:index.php"); //-- átvált a nyitólapra
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<div class="col-8 mx-auto">
    <form action="#" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="felhasznalonev" class="form-label">Felhasználó teljes neve</label>
            <input type="text" class="form-control" id="felhasznalonev" name="felhasznalonev" aria-describedby="felhasznalonevHelp" required minlength="3" maxlength="50">
            <div id="felhasznalonevHelp" class="form-text">Ez szerepel majd az örökbefogadási szerződésen.</div>
        </div>
        <div class="row">
            <div class="mb-3 col-7">
                <label for="useremail" class="form-label"></label>
                <span><?php echo$emailErr; ?></span>
                <input type="text" class="form-control" id="useremail" name="useremail" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Kapcsolattartási célból.</div>
                
            </div>
            <div class="mb-3 col-auto">
                <label for="szigszam" class="form-label"></label>
                <span><?php echo$szigszamErr; ?></span>
                <input type="text" class="form-control" id="szigszam" name="szigszam" aria-describedby="szigszamHelp" required pattern="[1-9]{1}[0-9]{5}[A-Za-z]{2}">
                <div id="szigszamHelp" class="form-text">A pontos beazonosítás miatt.</div>
                
            </div>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Felhasználó név</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" required>
            <div id="usernameHelp" class="form-text">Bejelentkezéshez.</div>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="InputPassword" class="form-label"></label>
                <input type="password" class="form-control" id="InputPassword" name="InputPassword" required>
                <span><?php echo$passErr; ?></span>
                <div id="usernameHelp" class="form-text">A jelszónak tartalmaznia kell: minimum 8 karaktert, egy nagy betűt, egy kis betűt és egy számot.</div>
            </div>
            <div class="mb-3 col-6">
                <label for="InputPassword2" class="form-label"></label>
                <input type="password" class="form-control" id="InputPassword2" name="InputPassword2" required>
                <span><?php echo$pass2Err; ?></span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="regisztraciosAdatok" value="true">Regisztráció</button>
    </form>
</div>
