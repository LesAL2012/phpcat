<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error | Dev</title>
</head>
<body>
    <h1>An error has occurred</h1>
    <p><b>Error code: </b><?= $errno?></p>
    <p><b>Error text: </b><?= $errstr?></p>
    <p><b>The file in which the error occurred: </b><?= $errfile?></p>
    <p><b>The line where the error occurred: </b><?= $errline?></p>
</body>
</html>