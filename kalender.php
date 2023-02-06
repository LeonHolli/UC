<style>
<?php include 'css/kalender.css'; ?>
</style>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <title>Termin Kalender</title>
</head>
<body>
    <?php 
        session_start();
        ob_start();
        $verbindung = mysqli_connect("localhost", "root", "", "kalender");

        if (!$verbindung)
	    {
		    die('keine Verbindung möglich: ' . mysqli_error());
	    }
    ?>
    <div class="topnav">
        <ul>
            <div class="left-topnav">

            </div>
            <div class="middle-topnav">
                <li><h1>Termin Kalender</h1></li>
            </div>
            <div class="right-topnav">
                <li><a href="#openNewTermin">Neuer Termin</a></li>
            </div>
        </ul>
    </div>
    <div class="grid-container">
        <table>
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Uhrzeit</th>
                    <th>Kennzeichen</th>
                    <th>Arbeit</th>
                    <th>Beschreibung</th>
                    <th>Anhänge</th>
                    <th>Status</th>
                </tr>
            </thead>
            
            <?php 
                $sql = "SELECT * FROM termine";
                $result = mysqli_query($verbindung, $sql);
				$resultcheck = mysqli_num_rows($result);
                if($resultcheck > 0){
					while($row = mysqli_fetch_assoc($result))
					{
						echo "<tr>";
                        echo    "<td> {$row['Datum']} </td>";
                        echo    "<td> {$row['Uhrzeit']} </td>";
                        echo    "<td> {$row['Kennzeichen']} </td>";
                        echo    "<td> {$row['Arbeit']} </td>";
                        echo    "<td> {$row['Beschreibung']} </td>";
                        echo    "<td> {$row['Anhänge']} </td>";
                        echo    "<td> {$row['Auftrag']} </td>";
                        echo "</tr>";
					}
				}
                else{
                    echo "Keine Termine Vorhanden";
                }
            ?>
        </table>
    </div>
    
    <div id="openNewTermin" class="window">
        <div><a href="#close" title="Close" class="close">X</a>
        <h2>Neuer Termin</h2>
        <table class="newTable">
            <tr>
                <th>Datum</th>
                <th>Uhrzeit</th>
                <th>Kennzeichen</th>
                <th>Arbeit</th>
                <th>Beschreibung</th>
                <th>Anhänge</th>
                <th>Status</th>
            </tr>
        <form action="kalender.php" method="get">
            <tr>
                <th><input type="date" name="Datum"></th>
                <th><input type="time" name="Uhrzeit"></th>
                <th><input type="text" name="Kennzeichen"></th>
                <th>
                    <select name="Arbeit" name="Arbeit">
                        <option value="Service">Service</option>
                        <option value="TÜV">TÜV</option>
                        <option value="Reparatur">Reparatur</option>
                    </select>
                </th>
                <th><input type="text" name="Beschreibung"></th>
                <th><input type="text" name="Anhänge"></th>
                <th>
                    <select name="Status">
                        <option value="Offen">Offen</option>
                        <option value="In Arbeit">In Arbeit</option>
                        <option value="Erledigt">Erledigt</option>
                    </select>
                </th>
            </tr>
        </table>
        <input type="submit" name="submit" value="Erstellen" style="width: 10%">
        </form>
        <?php
            if(!empty($_GET["submit"]) && !empty($_GET["Datum"]) && !empty($_GET["Uhrzeit"]) && !empty($_GET["Kennzeichen"])){
                $datum = $_GET["Datum"];
                $uhrzeit = $_GET["Uhrzeit"];
                $kennzeichen = $_GET["Kennzeichen"];
                $arbeit = $_GET["Arbeit"];
                $beschreibung = $_GET["Beschreibung"];
                $anhänge = $_GET["Anhänge"];
                $status = $_GET["Status"];

                $sql = "INSERT INTO termine (Datum, Uhrzeit, Kennzeichen, Arbeit, Beschreibung, 
                    Anhänge, Auftrag) VALUES ('$datum', '$uhrzeit', '$kennzeichen', '$arbeit', '$beschreibung', '$anhänge', '$status');";
                $result = mysqli_query($verbindung, $sql);
                if($result == 1){
                    echo "Eingetragen";
                    header("Location: kalender.php");
                    ob_end_flush();
                }
            }
            else{
                echo "Falsche Eingabe";
            }
        ?>
        </div>
    </div>
</body>
</html>