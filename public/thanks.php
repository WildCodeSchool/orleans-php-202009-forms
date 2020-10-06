<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Thanks</h1>
<p>
    <?php
        foreach ($_POST as $name=>$input) {
            $data[$name] = trim($input);
        }

       if(empty($data['firstname'])) {
            $errors[] = 'error firstname empty';
        }
        $maxFirstnameLength = 80;
        if(strlen($data['firstname']) > $maxFirstnameLength) {
            $errors[] = 'La longueur du prénom doit faire moins de '.$maxFirstnameLength. ' caractères';
        }
        if(empty($data['lastname'])) {
            $errors[] = 'error lastname empty';
        }
        if(empty($data['email'])) {
            $errors[] = 'error email empty';
        }
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'format email invalide';
        }

        if(!empty($errors)) : ?>
            <ul>
                <?php foreach($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else :
            echo 'Bonjour ' . htmlentities($data['firstname']) . ' ' . htmlentities($data['lastname']);
            echo 'Message :' . htmlentities($data['message']);
        endif; ?>
</p>
<a href="form.php">Back</a>
</body>
</html>
