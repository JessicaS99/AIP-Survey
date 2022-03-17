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

        <div id="AdminLogin">
            <form method="POST">
                <h2><strong>Admin Login</strong> </h2>
                <fieldset>

                    <div class="container">



                        <input type="text" class="form-control p-2" name="admin" placeholder="Name" required="true">

                        <div class="space"><input type="Password" class="form-control p-2" name="password" placeholder="Password" required="true" pattern=".{1,}"></div>


                        <button class=" form-control btn btn-outline-secondary" type="submit" value="submit" name="button">Login</button>
                    </div>
                </fieldset>
            </form>
        </div>


        <?php
        $con = mysqli_connect("localhost", "root", "", "survey") or die(mysqli_error($con));
        if (isset($_POST['button'])) {
        ?>
            <style type="text/css">
                #AdminLogin {
                    display: none;
                }

                .wrapper {
                    width: 100%;
                }
            </style>
            <?php
            $admin = mysqli_real_escape_string($con, $_POST['admin']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $pass = md5($password);
            $query = "select admin, password from admin where admin = '$admin' and password = '$pass' ";
            $result = mysqli_query($con, $query);
            $user_check = mysqli_fetch_row($result);

            if ($user_check[0] == $admin && $user_check[1] == $pass) {

                $query = "select user, datum, q1, q2, q3, q4, q5 from seite1";
                $result = mysqli_query($con, $query);

                $query2 = "select user, datum, q6, q7, q8, q9, q10 from seite2";
                $result2 = mysqli_query($con, $query2);
            ?>

                <form method="post" action="export.php">
                    <input type="submit" name="export" value="Export" />
                </form>



        <?php




                //SEITE 1
                echo ('<h2>Seite 1</h2>');
                echo ('<table id="Table1">');
                echo ('<thead> <tr>');
                echo ('<th>User</th>');
                echo ('<th>Datum</th>');
                echo ('<th>Q1</th>');
                echo ('<th>Q2</th>');
                echo ('<th>Q3</th>');
                echo ('<th>Q4</th>');
                echo ('<th>Q5</th>');
                echo ('</tr></thead>');
                echo ('<tbody>');
                while($row = mysqli_fetch_array($result)) {
                    echo ('<tr>');
                    echo ('<td label="User:">' .$row['user'] . '</td>');
                    echo ('<td label="Datum:">' .$row['datum'] . '</td>');
                    echo ('<td label="Q1:">' .$row['q1'] . '</td>');
                    echo ('<td label="Q2:">' . $row['q2'] . '</td>');
                    echo ('<td label="Q3:">' . $row['q3'] . '</td>');
                    echo ('<td label="Q4:">' .$row['q4'] . '</td>');
                    echo ('<td label="Q5:">' .$row['q5']. '</td>');

                    echo ('</tr> ');
                }
                echo ('</tbody></table>');

                //SEITE 2
                echo ('<h2>Seite 2</h2>');
                echo ('<table class="table2">');
                echo ('<thead> <tr>');
                echo ('<th>User</th>');
                echo ('<th>Datum</th>');
                echo ('<th>Q6</th>');
                echo ('<th>Q7</th>');
                echo ('<th>Q8</th>');
                echo ('<th>Q9</th>');
                echo ('<th>Q10</th>');
                echo ('</tr></thead>');
                echo ('<tbody>');

                while($row2 = mysqli_fetch_array($result2)) {
                    echo ('<tr> ');
                    echo ('<td label="User:">' .$row2['user'] . '</td>');
                    echo ('<td label="Datum:">' . $row2['datum'] . '</td>');
                    echo ('<td label="Q6:">' . $row2['q6'] . '</td>');
                    echo ('<td label="Q7:">' . $row2['q7'] . '</td>');
                    echo ('<td label="Q8:">' . $row2['q8'] . '</td>');
                    echo ('<td label="Q9:">' . $row2['q9'] . '</td>');
                    echo ('<td label="Q10:">' .$row2['q10'] . '</td>');

                    echo ('</tr>');
                }
                echo ('</tbody></table>');
            } else {

                header("location:admin.php");
            }

        }
       
        ?>

    </main>
    <footer class="main-footer">
        <div class="cols">
            <div class="col">
                <h3>Rechlicher Hinweis</h3>
                <p>
                    Diese Umfrage ist freiwillig und kann auch annonym absolviert werden. Wir fagen monatlich wiederkehrend, um euch die möglichkeit zu geben unkompliziert Feedback an uns zu senden. So können wir besser herausfinden, wie es euch bei uns h^ghet und was wir ggf. ändern müssen.
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


