<?php
include_once 'config.inc.php';

if(!isset($_POST['g-recaptcha-response'], $_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['geburtsdatum'], $_POST['iban'])) {
    header('location: index.php');
    die('Fehler, bitte von vorne: https://mitgliedsantrag.ssv-wehrden.de/');
}

$betreff = "Mitgliedsantrag: ".$_POST['vorname']." ".$_POST['nachname'];
$mitgliedContent = "Hallo ".$_POST['vorname'].",<br/>";
$mitgliedContent .= "vielen Dank fuer deinen Mitgliedsantrag im ".VEREINSNAME."<br/><br/>";
$mitgliedContent .= "Hier ist die Zusammenfassung deiner Daten:<br/><br/>";
$mitgliedContent .= "Vorname: " . $_POST['vorname'] ."<br/>";
$mitgliedContent .= "Nachname: " . $_POST['nachname'] ."<br/>";
$mitgliedContent .= "Strasse: " . $_POST['strasse'] ."<br/>";
$mitgliedContent .= "PLZ: " . $_POST['plz'] ."<br/>";
$mitgliedContent .= "Ort: " . $_POST['ort'] ."<br/>";
$mitgliedContent .= "<br/>";
$mitgliedContent .= "Telefon: " . $_POST['telefon'] ."<br/>";
$mitgliedContent .= "Mobil: " . $_POST['mobil'] ."<br/>";
$mitgliedContent .= "E-Mail: " . $_POST['email'] ."<br/>";
$mitgliedContent .= "<br/>";
$mitgliedContent .= "Geschlecht: " . $_POST['geschlecht'] ."<br/>";
$mitgliedContent .= "Geburtsdatum: " . $_POST['geburtsdatum'] ."<br/>";
$mitgliedContent .= "<br/>";
$mitgliedContent .= "Sportgruppe: " . $_POST['sportgruppe'] ."<br/>";
$mitgliedContent .= "<br/>";
$mitgliedContent .= "Beitrag: " . $_POST['beitrag'] ."<br/>";
$mitgliedContent .= "IBAN: " . $_POST['iban'] ."<br/>";
$mitgliedContent .= "BIC: " . $_POST['bic'] ."<br/>";
$mitgliedContent .= "Kontoinhaber: " . $_POST['kontoinhaber'] ."<br/>";
$mitgliedContent .= "<br/>";
$mitgliedContent .= "Satzung: Akzeptiert<br/>";
$mitgliedContent .= "Ehrenamtliches Engagement: " . (isset($_POST['ehrenamtliches-engagement']) ? "Ja" : "Nein") ."<br/>";
$mitgliedContent .= "Unterstuetzung bei Veranstaltungen: " . (isset($_POST['ehrenamtliche-hilfe']) ? "Ja" : "Nein") ."<br/>";
$mitgliedContent .= "<br/>";
$mitgliedContent .= "Bitte bestaetige deine Anmeldung durch den Klick auf diesen Link:<br/>";
$href = CONFIRM_URL."?key=".md5($_POST['email']);
$mitgliedContent .= "<a href=\"".$href."\" />".$href."</a><br/><br/>";
$mitgliedContent .= "sportliche Gruesse<br/>";
$mitgliedContent .= "gez. der Vorstand<br/>";

function mail_att($to,$subject,$message,$anhang = null) {
   $mime_boundary = "-----=" . md5(uniqid(mt_rand(), 1));

   $header  ="From:".VEREINSNAME."<".ABSENDER_MAILADRESSE.">\n";
   $header .= "Reply-To: ".ABSENDER_MAILADRESSE."\n";

   $header.= "MIME-Version: 1.0\r\n";
   $header.= "Content-Type: multipart/mixed;\r\n";
   $header.= " boundary=\"".$mime_boundary."\"\r\n";

   $content = "This is a multi-part message in MIME format.\r\n\r\n";
   $content.= "--".$mime_boundary."\r\n";
   $content.= "Content-Type: text/html charset=\"iso-8859-1\"\r\n";
   $content.= "Content-Transfer-Encoding: 8bit\r\n\r\n";
   $content.= $message."\r\n";

    if($anhang != null) {
        //$anhang ist ein Mehrdimensionals Array
        //$anhang enthält mehrere Dateien
        if(is_array($anhang) && is_array(current($anhang))) {
            foreach($anhang as $dat) {
                $data = chunk_split(base64_encode($dat['data']));
                $content.= "--".$mime_boundary."\r\n";
                $content.= "Content-Disposition: attachment;\r\n";
                $content.= "\tfilename=\"".$dat['name']."\";\r\n";
                $content.= "Content-Length: .".$dat['size'].";\r\n";
                $content.= "Content-Type: ".$dat['type']."; name=\"".$dat['name']."\"\r\n";
                $content.= "Content-Transfer-Encoding: base64\r\n\r\n";
                $content.= $data."\r\n";
            }
            $content .= "--".$mime_boundary."--"; 
        } else { //Nur 1 Datei als Anhang
            
            $data = chunk_split(base64_encode($anhang['data']));
            $content.= "--".$mime_boundary."\r\n";
            $content.= "Content-Disposition: attachment;\r\n";
            $content.= "\tfilename=\"".$anhang['name']."\";\r\n";
            $content.= "Content-Length: .".$dat['size'].";\r\n";
            $content.= "Content-Type: ".$anhang['type']."; name=\"".$anhang['name']."\"\r\n";
            $content.= "Content-Transfer-Encoding: base64\r\n\r\n";
            $content.= $data."\r\n";
        } 
    }

    if(@mail($to, $subject, $content, $header)) {
       return true;
    } else {
        return false;
    }
}

// Mail an neues Mitglied ohne Anhang
mail_att($_POST['email'], $betreff, $mitgliedContent);

// CSV Datei
$csvContent = "";
$csvContent .= "Vorname;Nachname;Strasse;PLZ;Ort;Geburtsdatum;Geschlecht;IBAN;BIC;Kontoinhaber;E-Mail;Telefon;Mobil;Beitrag;Satzung;Sportgruppe;Betreuer;Funktion;Eintrittsdatum;Anmerkung\n";
$csvContent .= "\"".$_POST['vorname']."\";"; // 1
$csvContent .= "\"".$_POST['nachname']."\";"; // 2
$csvContent .= "\"".$_POST['strasse']."\";"; // 3
$csvContent .= "\"".$_POST['plz']."\";"; // 4
$csvContent .= "\"".$_POST['ort']."\";"; // 5
$csvContent .= "\"".date("d.m.Y", strtotime($_POST['geburtsdatum']))."\";"; // 6
$csvContent .= "\"".($_POST['geschlecht'] == "maennlich" ? "M" : "W")."\";"; // 7
$csvContent .= "\"".$_POST['iban']."\";"; // 8
$csvContent .= "\"".$_POST['bic']."\";"; // 9
$csvContent .= "\"".$_POST['kontoinhaber']."\";"; // 10
$csvContent .= "\"".$_POST['email']."\";"; // 11
$csvContent .= "\"".$_POST['telefon']."\";"; // 12
$csvContent .= "\"".$_POST['mobil']."\";"; // 13

if($_POST['beitrag'] == "aktiv") {
        $beitrag = "Aktives Mitglied";
} else if($_POST['beitrag'] == "familie") {
    $beitrag = "Familienbeitrag";
} else if($_POST['beitrag'] == "ermaessigt") {
    $beitrag = "Jugendliche bis 18 Jahren";
} else if($_POST['beitrag'] == "passiv") {
    $beitrag = "Passives Mitglied";
} else {
    $beitrag = "Aktives Mitglied";
}
$csvContent .= "\"".$beitrag."\";"; // 14
$csvContent .= "\"Satzung\";"; // 15
$csvContent .= "\"".trim(explode(" -", $_POST['sportgruppe'])[0])."\";"; // 16 
$csvContent .= "\"".trim(explode(" -", $_POST['sportgruppe'])[1])."\";"; // 17
$csvContent .= "\"Mitglied\";"; // 18
$csvContent .= "\"".date("d.m.Y")."\";"; // 19
$ehrenamtlichesEngagement = (isset($_POST['ehrenamtliches-engagement']) ? "Ja" : "Nein");
$ehrenamtlicheHilfe = (isset($_POST['ehrenamtliche-hilfe']) ? "Ja" : "Nein");
$csvContent .= "\"Ehrenamtliches Engagement: ".$ehrenamtlichesEngagement." - Hilfe bei Veranstalatungen: ".$ehrenamtlicheHilfe."\";"; // 20
$csvContent .= "\"".$ehrenamtlichesEngagement."\";"; // 21
$csvContent .= "\"".$ehrenamtlicheHilfe."\";"; // 22
$csvContent .= "\"01.01.".date("Y")."\";"; // 23
file_put_contents("input.csv", iconv("UTF-8", "ISO-8859-1", $csvContent));


// WISO Vorlage Datei
$anhang[] = array("name"=>"wiso_mein_verein.imp", "size"=>filesize("wiso_mein_verein.imp"), "type"=>mime_content_type("wiso_mein_verein.imp"), "data"=> implode("",file("wiso_mein_verein.imp")));
$anhang[] = array("name"=>"input.csv", "size"=>filesize("input.csv"), "type"=>mime_content_type("input.csv"), "data"=> implode("",file("input.csv")));
mail_att("info@ssv-wehrden.de",$betreff, $mitgliedContent, $anhang);

?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title><?php echo VEREINSNAME; ?> - Antrag auf Mitgliedschaft</title>

    <link rel="canonical" href="https://mitgliedsantrag.ssv-wehrden.de">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  <div class="py-5 text-center">
    <h2>Fast geschafft! - Antrag auf Mitgliedschaft</h2>
    <div class="alert alert-primary" role="alert">
        Wir haben dir noch eine E-Mail geschickt, mit der du deine Antrag final bestätigen musst.
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; <?php echo date ("Y "); echo VEREINSNAME; ?> </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="<?php echo DATENSCHUTZ_IMPRESSUM_URL; ?>">Impressum und Datenschutz</a></li>
    </ul>
  </footer>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="jquery.slim.min.js"><\/script>')</script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="form-validation.js"></script></body>
</body>
</html>
