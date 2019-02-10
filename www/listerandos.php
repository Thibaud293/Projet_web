<html>
    <?php
        session_start();
        $bdd = new PDO('mysql:host=localhost;dbname=site;charset=utf8','root','');
        $req = $bdd->query(
        'SELECT annonces.id_annonces as id_a, annonces.titre_annonce as titreR, annonces.departement as departement,
        users.pseudo as pseudo
        FROM annonces INNER JOIN users
        ON annonces.id_users = users.id
        ORDER BY id_a ASC
        LIMIT 0, 15'
        );
    ?>

        <head>
                <title> Liste Randos </title>

               <!-- <link rel="stylesheet" href="listerandos.css" /> -->

        </head>

        <body>
            <div id="bloc_body">
                <header>
                    <h2> Bonjour <?php echo $_SESSION['userPseudo'] ?> et bienvenue sur cette platforme de partage <h2>

                </header>

                <div class="commun">
                    <table>
                        <tr>
                            <td> <a href="ajoutrando.php"> Partager votre expérience </td>
                            <td> <a href="listerandosperso"> Voir vos randonnées </td>
                            <td> <a href="accueil.php"> Retourner à l'accueil </td>
                        <tr>

                    </table>
                </div>

                <div class="commun">
                    <table>
                        <tr>
                            <td> <h3> Trier les randonnées </h3> </td>
                            <td> <a href="listerandos.php"> Voir la totalité </td>
                            <td> <a href="listerandosdep.php"> Par département </td>
                        </tr>
                    </table>
                </div>

                <div id="LRandos">
                    <?php
                    foreach($req as $row)
                        {
                    ?>
                        <p>
                            <h3>Titre : <?php echo $row['titreR'] ?> </h3>
                            <h5>Proposée par : <?php echo $row['pseudo'] ?> </h5>
                            <h4>Département : <?php echo $row['departement'] ?> </h4>
                        <p>
                    <?php
                        }
                    $req->closeCursor();
                    ?>
                </div>

                
            </div>
        </body>


</html>