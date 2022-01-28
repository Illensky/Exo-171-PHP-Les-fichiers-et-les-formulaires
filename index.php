<?php

/**
 * 1. Créez un formulaire classique contenant un champs input de type file
 * 2. Faites pointer l'action sur la page fichier.php ( que vous créerez )
 * 3. Gérez l'upload du fichier, le fichier doit être stocké dans le répertoire upload de votre site
 * 4. Gérez tous les cas de figure:
 *    - Le fichier doit être une image
 *    - On ne peut pas uploader de fichier image de plus de 3Mo
 *    - Les fichiers doivent être renommés
 *    - Affichez les erreurs sur la page index.php s'il y en a ( fichier non présent, erreur d'upload, etc... )
 * ( BONUS )
 * 5. Une fois l'upload terminé, enregistrez le nom du fichier uploadé dans le fichier file.json ( que vous créerez s'il n'existe pas )
 *    Attention, trouvez une solution pour que le fichier contienne du JSON valide !
 * 6. Affichez sur la page index les fichiers ayant déjà été uploadés.
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['f'])) {
    $feedback = 'feedback-success';
    if ((int)$_GET['f']) {
        $feedback = 'feedback-error';
    }

    $errorCode = [
        "Votre fichier as bien etait envoyé.",
        "Une erreur s'est produite en uplodant votre fichier.",
        "Vous avez fournit un mauvais type de fichier (image JPEG et PNG uniquement).",
        "Votre fichier doit peser moins de 3Mo."
    ];
    ?>
    <div class="feedback <?= $feedback ?>">
        <?= $errorCode[(int)$_GET['f']] ?>
    </div>
    <?php
}
?>

<form action="fichier.php" method="post" enctype="multipart/form-data"><
    <label for="id-file">Choisissez un fichier texte ou image. ('.txt', '.png' ou '.jpg')</label>
    <input type="file" name="userFile" id="id-file">
    <input type="submit" value="fileSubmit">
</form>

<script src="script.js"></script>
</body>
</html>