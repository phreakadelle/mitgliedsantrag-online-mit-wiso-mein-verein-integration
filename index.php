<?php
include_once 'config.inc.php';
?>

<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Stephan Watermeyer">
    <title><?php echo VEREINSNAME; ?> - Antrag auf Mitgliedschaft</title>

    <link rel="canonical" href="https://mitgliedsantrag.ssv-wehrden.de">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Favicons -->
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
    <h2>SSV Germania Wehrden e.V. - Antrag auf Mitgliedschaft</h2>
    <p class="lead">Durch das Ausfüllen dieses Formulars stellst Du den Antrag auf Mitgliedschaft im Sportverein Wehrden.</p>
    <p class="lead">
	Seit 2019 wird die Mitgliedschaft im Verein nur noch online entgegen genommen. Du erhälst eine schriftliche Bestätigung deiner Anmeldung.
	</p>
	<p class="lead">
	Falls du bereits Mitglied bist und sich z.B. deine Kontaktdaten oder Bankdaten geändert haben, kannst du das Formular einfach erneut ausfüllen.
	</p>
	<p class="lead">
	Hinweis: Beiträge werden im Verein immer rückwirkend für das ganze Jahr fällig. Es gibt keine anteiligen Mitgliedsbeiträge bei späterem Eintritt oder Kündigung. Der Beitragseinzug findet in der Regel im Dezember statt.
	</p>
  </div>
  <?php  if(isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <h2>Fehler</h2>
                Du hast leider nicht alle Pflichtfelder ausgefüllt.
            </div>
  <? }?>
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Deine Daten</h4>
      <form class="needs-validation" action="vielendank.php" method="post" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="vorname">Vorname</label>
            <input type="text" class="form-control" name="vorname" id="vorname" placeholder="" value="" required>
            <div class="invalid-feedback">
              Der Angabe des Vornamens ist erforderlich.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="nachname">Nachname</label>
            <input type="text" class="form-control" name="nachname" id="nachname" placeholder="" value="" required>
            <div class="invalid-feedback">
              Der Angabe des Nachnamens ist erforderlich.
            </div>
          </div>
        </div>
		
		<div class="row">
          <div class="col-md-6 mb-3">
            <label for="strasse">Strasse und Hausnummer</label>
            <input type="text" class="form-control" name="strasse" id="strasse" placeholder="" value="" required>
            <div class="invalid-feedback">
              Der Angabe der Strasse ist erforderlich.
            </div>
          </div>
        </div>
		
		<div class="row">
          <div class="col-md-6 mb-3">
            <label for="strasse">PLZ</label>
            <input type="number" class="form-control" name="plz" id="plz" placeholder="37688" value="" required>
            <div class="invalid-feedback">
              Der Angabe der PLZ ist erforderlich.
            </div>
          </div>
		  <div class="col-md-6 mb-3">
            <label for="ort">Ort</label>
            <input type="text" class="form-control" name="ort" id="ort" placeholder="" value="" required>
            <div class="invalid-feedback">
              Der Angabe des Orts ist erforderlich.
            </div>
          </div>
        </div>
		
		<div class="row">
		<div class="col-md-6 mb-3">
            <label for="geburt">Geburtsdatum</label>
            <input type="date" class="form-control" name="geburtsdatum" id="geburtsdatum" placeholder="" value="" required>
            <div class="invalid-feedback">
              Der Angabe des Geburtsdatums ist erforderlich.
            </div>
          </div>
		  <div class="col-md-6 mb-3">
            <div class="custom-control custom-radio">
            <input id="geschlecht-m" name="geschlecht" value="maennlich" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="geschlecht-m">Männlich</label>
          </div>
		  <div class="custom-control custom-radio">
            <input id="geschlecht-w" name="geschlecht" value="weiblich" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="geschlecht-w">Weiblich</label>
          </div>
		  <div class="custom-control custom-radio">
            <input id="geschlecht-d" name="geschlecht" value="divers" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="geschlecht-d">Diverse</label>
          </div>
          </div>
		</div>
		<h4 class="mb-3">Deine Kontaktdaten</h4>

        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="max@mustermann.de">
          <div class="invalid-feedback">
            Bitte gib eine gültige E-Mailadresse an.
          </div>
		  <span class="text-muted">Wir verwenden deine E-Mail zur Kontaktaufnahme und f&uuml;r die Zusendung vereinsrelevanter Nachrichten, wie Sportangebote und Versammelungen</span>
        </div>
		
		<div class="row">
          <div class="col-md-6 mb-3">
            <label for="telefon">Telefon</label>
			<input class="form-control" type="tel" name="telefon" placeholder="05273/"  id="telefon" required>
            <div class="invalid-feedback">
              Der Angabe der Telefon-Nummer ist erforderlich.
            </div>
          </div>
		  <div class="col-md-6 mb-3">
            <label for="mobile">Mobil</label>
			<input class="form-control" type="tel" name="mobil" placeholder="0173/"  id="mobile" required>
            <div class="invalid-feedback">
              Der Angabe der Mobil-Nummer ist erforderlich.
            </div>
			<span class="text-muted">Wir verwenden deine Mobil-Nummer zur Kontaktaufnahme und f&uuml;r die Zusendung vereinsrelevanter Nachrichten, wie z.B. Sportangebote</span>
          </div>
        </div>
		
		<h4 class="mb-3">Deine Kontodaten</h4>
        <div class="row">

          <div class="col-md-6 mb-3">
            <label for="strasse">IBAN (22-stellig)</label>
			<input type="text"   class="form-control" name="iban" id="iban" pattern="^DE\d{2}[ ]\d{4}[ ]\d{4}[ ]\d{4}[ ]\d{4}[ ]\d{2}|DE\d{20}$" placeholder="IBAN" title="Eine deutsche IBAN hat 22 Stellen und beginnt mit DE" required>

            <div class="invalid-feedback">
              Der Angabe der IBAN ist erforderlich.
            </div>
          </div>
		  <div class="col-md-6 mb-3">
            <label for="bic">BIC</label>
            <input type="text" class="form-control" name="bic" id="bic" placeholder="" value="">
            <div class="invalid-feedback">
              Der Angabe der BIC ist erforderlich.
            </div>
          </div>
        </div>
		<div class="row">
          <div class="col-md-6 mb-3">
            <label for="kontoinhaber">Kontoinhaber <span class="text-muted">(falls abweichend)</span></label>
            <input type="text" class="form-control" name="kontoinhaber" id="kontoinhaber" placeholder="" value="">
            <div class="invalid-feedback">
              Der Angabe des Kontoinhabers ist erforderlich.
            </div>
          </div>
        </div>
		<div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" name="lastschrift-akzeptiert" id="lastschrift-akzeptiert">
          <label class="custom-control-label" for="lastschrift-akzeptiert">Ich ermächtige den SSV Wehrden (Gläubiger Identifikationsnummer: DE 38 ZZZ 00000 939 700), wiederkehrende Zahlungen von meinem Konto mittels SEPA-Basislastschrift einzuziehen. Zugleich weise ich mein Kreditinstitut an, die vom SSV Wehrden auf mein Konto gezogenen Lastschriften einzulösen.
Hinweis: Ich kann innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrages verlangen. Es gelten dabei die mit meinem Kreditinstitut vereinbarten Bedingungen.
</label>
        </div>

        <h4 class="mb-3">Deine Mitgliedschaft</h4>

		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="satzung-akzeptiert" id="satzung-akzeptiert">
			<label class="custom-control-label" for="satzung-akzeptiert">Ich erkenne die Satzung und Ordnungen des SSV Germania Wehrden e.V. mit all ihren Rechten und Pflichten an.  Weitere Details können der Satzung entnommen werden.
			</label>
		</div>
		
		<div class="custom-control custom-checkbox">
			<input type="checkbox" class="custom-control-input" name="datenschutz-akzeptiert" id="datenschutz-akzeptiert">
			<label class="custom-control-label" for="datenschutz-akzeptiert">Mit der Erhebung, Verarbeitung und Nutzung meiner personenbezogenen Daten erkläre ich mich einverstanden.
			</label>
		</div>
		
        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="beitrag-aktiv" name="beitrag" value="aktiv" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="beitrag-aktiv">Aktive Mitgliedschaft (36 EUR Jahresbeitrag)</label>
          </div>
		  <div class="custom-control custom-radio">
            <input id="beitrag-familie" name="beitrag" value="familie" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="beitrag-familie">Familien-Beitrag (Das zweite Kind unter 18 ist kostenfrei)</label>
          </div>
		  <div class="custom-control custom-radio">
            <input id="beitrag-ermaessigt" name="beitrag" value="ermaessigt" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="beitrag-ermaessigt">Ermäßigter Beitrag für Kinder bis zur Vollendung des 18. Lebensjahres (29 EUR Jahresbeitrag)</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="beitrag-passiv" name="beitrag" value="passiv" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="beitrag-passiv">Passive Mitgliedschaft (13 EUR Jahresbeitrag)</label>
          </div>
        </div>
	

		<div class="row">
          <div class="col-md-6 mb-3">
			<label for="sportgruppe">Sportgruppe</label>
			<select class="form-control" id="sportgruppe" name="sportgruppe" required>
				<option>Aerobic - Irmhild und Sandra</option>
				<option>Aerobic - Bettina und Ulrike</option>
				<option>Alte Herren - Michael</option>
				<option>Basketball - Sebastian</option>
				<option>Badminton - Christian</option>
				<option>Ballsport für Kinder - Antje und Benjamin</option>
				<option>Boule - Mary</option>
				<option>Eltern-Kind-Turnen - Tino</option>
				<option>Männersport - Bettina</option>
				<option>Kindersport - Helga</option>
				<option>Skifreizeit - Michael </option>
				<option>Tabata - Denise</option>
				<option>Wandern - Ulrike</option>
				<option>Zumba - Sarah</option>
				<option>Sonstiges</option>
			</select>
			</div>
		</div>
		
		<div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="ehrenamtliches-engagement" name="ehrenamtliches-engagement">
          <label class="custom-control-label" for="ehrenamtliches-engagement">Ich möchte ehrenamtliche Aufgaben im Verein übernehmen.</label>
        </div>
		
		<div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="ehrenamtliche-hilfe" name="ehrenamtliche-hilfe">
          <label class="custom-control-label" for="ehrenamtliche-hilfe">Ich würde gerne bei Vereinsveranstaltungen mithelfen und/oder z.B. einen Kuchen backen.</label>
        </div>
		
		<div class="custom-control custom-checkbox">
			<div class="g-recaptcha" data-sitekey="<? echo RECAPTCHA_KEY; ?>"></div>
		</div>
	
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Antrag abschicken</button>
      </form>
    </div>
  </div>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; <?php echo date ("Y "); echo VEREINSNAME; ?> </p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="https://www.ssv-wehrden.de/verschiedenes/impressum/">Impressum und Datenschutz</a></li>
    </ul>
  </footer>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="jquery.slim.min.js"><\/script>')</script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="form-validation.js"></script></body>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
