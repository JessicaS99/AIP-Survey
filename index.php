<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <header class="main-head">
        <div class="col">
            <img class="logo" src="images/AIPplus.png">
        </div>
        <div class="col">
            <img class="logo" src="images/jsw_logo_rgb.png">
        </div>
    </header>
    <main id="Content" class="wrapper">

        <div id="indexpage">
            <form method="POST" id="indexform">
                <h1>Zufriedenheitsumfrage</h1>
                <div id="form">
                    <fieldset>
                        <header>Deine Meinung interessiert uns. Wir freuen uns über Dein Feedback, egal ob namentlich oder anonym!</header>
                        <div class="container">
                            <input class="space" type="text" name="user" placeholder="Vor / Nachname">
                            <div class="space">
                                <input type=checkbox name="user" id="anonymus" value=anonymus /> <label for="anonymus">Annonym</label>
                                <hr>
                                <div>
                                    <button class="button space" type="submit" value="submit" name="button">Bestätigen</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
        <?php

        #Überprüfung ob der Name schon in der Datenbank ist/ annonym 
        session_start();
        $con = mysqli_connect("localhost", "root", "", "survey") or die(mysqli_error($con));
        if (isset($_POST['button'])) {

            $user = mysqli_real_escape_string($con, $_POST['user']);

            $query = "select user from seite1 where user = '$user'";
            $result = mysqli_query($con, $query);

            $user_check = mysqli_num_rows($result);

            if ($user_check > 0  && $user != 'anonymus') {
                /*Name schon in Datenbank und nicht Annonym*/
                echo ('<p class="warning">Du hast bereits an der Umfrage teilgenommen</p>');
            }
            if ($user == null && $user != 'anonymus') {
                /*Kein Name angegeben und nicht Annonym*/
                echo ('<p class="warning">Kein Name angegeben</p>');
            }
            if ($user_check == 0 && $user != null || $user == 'anonymus') {
                /* Name noch nicht in datenbank oder Annonym, Session wird gestartet und User darin gespeichert */

                $_SESSION['user'] = $user;
                $_SESSION['check'] = $check = true;


                if ($check == true) {


        ?>
                    <style type="text/css">
                        #form {
                            display: none;
                        }

                        #indexform p {
                            display: none;
                        }
                    </style>
                    <div>
                        <form class="survey" method="POST">


                            <div class="form-group">
                                <header>Fragen zum Kauf des Autos</header>
                                <div class="container">

                                    <p for="q1">In welchem Jahr wurde das Auto gekauft?</p>
                                    <select name="q1" size=1 required>
                                        <option value="">- wählen -</option>
                                        <option value='2004'>2004</option>
                                        <option value='2005'>2005</option>
                                        <option value='2006'>2006</option>
                                    </select>

                                    <p for="q2">Wurde für den Kauf ein Kredit aufgenommen ?</p>
                                    <div class="radio">
                                        <div><input type=radio name="q2" value=yes id=yes required><label for="yes"> JA</label></div>
                                        <div><input type=radio name="q2" value=no id=no required><label for="no"> NEIN</label></div>
                                    </div>
                                    <p for="q3">Wie lange hat es geschätzt bis zur Kaufentscheidung gedauert?</p>
                                    <select name="q3" size=1 required>
                                        <option value="">- wählen -</option>
                                        <option value='1 week'>1 Woche</option>
                                        <option value='1 month'>1 Monat</option>
                                        <option value='1 year'>1 Jahr</option>
                                        <option value='longer'>mehr als 1 Jahr</option>
                                    </select>

                                    <p for="q4">Welches Auto fuhren Sie vor dem Neukauf ?</p>
                                    <input type=text name="q4" required>

                                    <p for="q5">Warum haben Sie sich für diese Marke entschieden ?</p>
                                    <textarea name="q5" cols=auto rows=5 required></textarea>

                                    <div>
                                        <button class="button space" name="button1" type=submit>Zur Seite 2</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                <?php
                }
            }
        }
        if (isset($_POST['button1']) && $_SESSION['check'] == 1) {
            $user = $_SESSION['user'];
            $q1 = $_POST['q1'];
            $q2 = $_POST['q2'];
            $q3 = $_POST['q3'];
            $q4 = $_POST['q4'];
            $q5 = $_POST['q5'];
            $date = date('Y-m-d');

            $query = "insert into seite1 (user,datum,q1,q2,q3,q4,q5) values('$user','$date','$q1','$q2','$q3','$q4','$q5')";
            $result = mysqli_query($con, $query) or die(mysqli_error($con));

            if (!$result) {
                echo "Eintrag in die Datenbank nicht möglich";
            } else {
                /* 1. Umfrage wurde in der Datenbank gespeichert */
                ?>
                <style type="text/css">
                    #form {
                        display: none;
                    }

                    #indexform p {
                        display: none;
                    }
                </style>
                <div>
                    <form class="survey" method="POST">


                        <div class="form-group">
                            <header>Fragen zum Kauf des Autos</header>
                            <div class="container">

                                <p for="q6">In welchem Jahr wurde das Auto gekauft?</p>
                                <select name="q6" size=1 required>

                                    <option value="">- wählen -</option>
                                    <option value='2004'>2004</option>
                                    <option value='2005'>2005</option>
                                    <option value='2006'>2006</option>
                                </select>

                                <p for="q7">Wurde für den Kauf ein Kredit aufgenommen ?</p>
                                <div class="radio">
                                    <div><input type=radio name="q7" value=yes id=yes><label for="yes" required> JA</label></div>
                                    <div><input type=radio name="q7" value=no id=no><label for="no"> NEIN</label></div>
                                </div>

                                <p for="q8">Wie lange hat es geschätzt bis zur Kaufentscheidung gedauert?</p>
                                <select name="q8" size=1 required>
                                    <option value="">- wählen -</option>
                                    <option value='1 week'>1 Woche</option>
                                    <option value='1 month'>1 Monat</option>
                                    <option value='1 year'>1 Jahr</option>
                                    <option value='longer'>mehr als 1 Jahr</option>
                                </select>

                                <p for="q9">Welches Auto fuhren Sie vor dem Neukauf ?</p>
                                <input type=text name="q9"required>

                                <p for="q10">Warum haben Sie sich für diese Marke entschieden ?</p>
                                <textarea name="q10" cols=auto rows=5 required></textarea>

                                <div>
                                    <button class="button space" name="button2" type=submit>Zur Seite 2</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

            <?php }
        }
        if (isset($_POST['button2']) && $_SESSION['check'] == 1) {
            $user = $_SESSION['user'];
            $q6 = $_POST['q6'];
            $q7 = $_POST['q7'];
            $q8 = $_POST['q8'];
            $q9 = $_POST['q9'];
            $q10 = $_POST['q10'];
            $date = date('Y-m-d H:i:s');

            $query1 = "insert into seite2 (user,datum,q6,q7,q8,q9,q10) values('$user','$date','$q6','$q7','$q8','$q9','$q10')";
            $result1 = mysqli_query($con, $query1) or die(mysqli_error($con));
            if (!$result1) {
                echo "Eintrag in die Datenbank nicht möglich";
            } else {
                /* 2. Umfrage wurde in der Datenbank gespeichert und Session wird beendet*/
                session_destroy();
            ?>
                <style type="text/css">
                    #form {
                        display: none;
                    }

                    #indexform p {
                        display: none;
                    }
                </style>
                <div id="page3">
                    <h1>Danke für deine Teilnahme</h1>
                </div>
        <?php
            }
        }
        ?>
    </main>
    <footer class="main-footer">
        <div class="cols">
            <div class="col">
                <h3>Rechlicher Hinweis</h3>
                <p>
                    Diese Umfrage ist freiwillig und kann auch annonym absolviert werden. Wir fagen monatlich wiederkehrend, um euch die möglichkeit zu geben unkompliziert Feedback an uns zu senden. So können wir besser herausfinden, wie es euch bei uns ergeht und was wir ggf. ändern müssen.
                <p>Die Ergebnisse werden ausschliesslich zur Verbesserung des Angebotes ausgewertet. Persönliche Angaben sind freiwilligt und unterliegen den AIP Datenschutzrichtlinien.</p>
                </p>
            </div>

            <div class="col">
                <h3>Fagen zur Umfrage?</h3>
                <p>Wenn Du fragen zur Umfrage hast, einfach die Teamleiter ansprechen, oder eine Email an: <a mailto="digital.business@jsw.swiss">digital.business@jsw.swiss</a> schreiben.</p>
            </div>

            <div class="col">
                <h3>Links</h3>
                <ul>

                    <li><a href="https://www.jsw.swiss/impressum" target="_blank">Impressum</a></li>
                    <li><a href="https://www.jsw.swiss/impressum" target="_blank">Datenschutz</a></li>

                </ul>

            </div>
        </div>
        <div class="footer-line">&copy; 2022 Jugendsozialwerk Blaues Kreuz BL, Rheinstrasse 20, 4410 Liestal</div>
    </footer>

</body>

</html>