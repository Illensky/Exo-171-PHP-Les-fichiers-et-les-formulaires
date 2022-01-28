<?php

function getRandomName(string $regularName)
{
    $infos = pathinfo($regularName);
    try {
        $bytes = random_bytes(15);
    } catch (Exception $e) {
        $bytes = openssl_random_pseudo_bytes(15);
    }
    return bin2hex($bytes) . '.' . $infos['extension'];
}

// redirection code erreur 1 si l'input n'est pas set ou qu'il y as une ereur sur l'envoit du fichier
if (!isset($_FILES['userFile']) && $_FILES['userFile']['error']) {
    header('location: /index.php?f=1');
    exit();
}

// Redirection code erreur 2 si le type de fichier envoyer ne correspont pas au types présent dans $allowedMimeTypes
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
if (!in_array($_FILES['userFile']['type'], $allowedMimeTypes)) {
    header('location: /index.php?f=2');
    exit();
}

// Redirection code erreur 3 si le fichier pese plus de 2Mo ou moins de 1o
if ((int)$_FILES['size'] > 3 *1024 *1024) {
    header('location: /index.php?f=3');
    exit();
}

// Obtention du nom de fichier temporaire
$tmp_name = $_FILES['userFile']['tmp_name'];

// Obtention d'un nom de fichier aléatoire a partir du nom donner par l'utilisateur via la fonction getRandomName
$name = getRandomName($_FILES['userFile']['name']);

// Vérification de l'existence du dossier uploads , creation de se dernier le cas échéant
if (!is_dir('uploads')) {
    mkdir('uploads', '0755');
}

// déplacement et renomage du fichier
move_uploaded_file($tmp_name, 'uploads/' . $name);

// Redirection avec code d'erreur 0 (tout s'est bien dérouler)
header('location: /index.php?f=0');
exit();