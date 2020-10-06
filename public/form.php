<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h1>Contact</h1>

    <?php
    if(!empty($_GET['message']) && $_GET['message'] === 'success') {
        echo 'message envoyé';
    }
    $subjects = [
            'sujet1' => 'Mon sujet 1',
            'sujet2' => 'Mon sujet 2',
            'sujet3' => 'Mon sujet 3',
            'sujet4' => 'Mon sujet 4',
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST') :
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

        if(!key_exists($data['subject'], $subjects)) {
            $errors[] = 'Valeur incorrecte';
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
            header('Location: form.php?message=success');
        endif;
    endif;
    ?>

<main>

    <form method="POST" action="" novalidate>
        <div>
            <label for="firstname">Firstname</label>
            <input
                type="text"
                id="firstname"
                name="firstname"
                placeholder="Bilbo"
                required
                value="<?= $data['firstname'] ?? '' ?>"
            >
        </div>
        <div>
            <label for="lastname">Lastname</label>
            <input
                type="text"
                id="lastname"
                name="lastname"
                placeholder="Baggins"
                required
                value="<?= $data['lastname'] ?? '' ?>"
            >
        </div>
        <div>
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="bilbobaggins@middleearth.me"
                required
                value="<?= $data['email'] ?? '' ?>"
            >
        </div>
        <div>
            <label for="subject">Subject</label>

            <select name="subject" id="subject">
                <?php foreach($subjects as $optionValue=>$subject) : ?>
                    <option
                          <?php if(!empty($data['subject']) && $optionValue === $data['subject']) : ?>
                            selected
                          <?php endif; ?>
                            value="<?= $optionValue ?>">
                        <?= $subject ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="message">Message</label>
            <textarea
                name="message"
                id="message"
                placeholder="Bonjour, j'ai une question..."
            ><?= $data['message'] ?? '' ?></textarea>
        </div>

        <div>
            <button>Submit</button>
        </div>
    </form>

</main>
</body>
</html>

