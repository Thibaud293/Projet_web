<html>
    <?php
        session_start();
        $bdd = new PDO('mysql:host=localhost;dbname=site;charset=utf8','root','');

        $pseudoSession =$_SESSION['userPseudo'] ;
        $req = $bdd->prepare(
        'SELECT annonces.id_annonces as id_a, annonces.titre_annonce as titreR, annonces.departement as departement,
        users.pseudo as pseudo
        FROM annonces INNER JOIN users
        ON annonces.id_users = users.id
        WHERE users.pseudo = :pseudoSession
        ORDER BY id_a ASC '
        );

        $req->execute(array(
            'pseudoSession' => $pseudoSession, 
        ));

    ?>

        <head>
                <title> Liste Randos </title>
                <link rel="stylesheet" href="listerandos.css" /> <!-- Lien vers la page css -->

        </head>

        <body>
            <div id="bloc_body">

                <header>
                    <h2> Bonjour <?php echo $_SESSION['userPseudo'] ?> et voici les expériences que vous avez partagées <h2>
                </header>

                <div class="commun">
                    <table>
                        <tr>
                            <td> <a href="ajoutrando.php"> Partager votre expérience </td>
                            <td> <a href="deco_accueil.php"> Se déconnecter et retourner à l'accueil </td>
                        <tr>

                    </table>
                </div>

                <div class="commun">
                    <table>
                        <tr>
                            <td> <a href="listerandos.php"> Voir la totalité des randonnées </td>
                            <td> <a href="listerandosperso.php"> Voir vos randonnées partagées</td>
                            <td> <a href="listerandosdep.php"> Trier par département </td>
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
                            <h4>Département : <?php echo $row['departement'] ?> </h4>
                            <p>
                                <a href="listerandosperso.php"> Supprimer cette annonce </a>
                                <?php
                                    
                                    $sup = $bdd->prepare(
                                        'DELETE FROM annonces
                                        WHERE titreR = :titreSup'
                                    );

                                    $sup->execute(array(
                                        'titreSup' => $row['titreR'],
                                    )); 
                                    
                                ?>
                                
                            <p>
                        <p>
                    <?php
                        }
                    $req->closeCursor();
                    ?>
                </div>

                
            </div>
        </body>


</html>