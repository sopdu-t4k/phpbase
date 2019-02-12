<!DOCTYPE html>
<html>
    <head>
        <title><?=$title;?></title>
        <base href="/" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    </head>
    <body class="min-vh-100">
        <div class="min-vh-100 d-flex flex-column">
            <main class="container">
                <?=$content;?>
            </main>
            <footer class="bg-secondary text-white text-center p-2 mt-auto">
                <small>&copy;<?=$year;?></small>
            </footer>
        </div>
    </body>
</html>