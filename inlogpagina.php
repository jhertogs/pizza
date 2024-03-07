<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Fredericka+the+Great&display=swap" rel="stylesheet">
</head>
<body>
    <nav><h2>Pizzaria di preprocessore 🍕</h2> </nav>
    <h1>Please fill in your name and password</h1>
    <div class="formdiv">
        <form  method="POST">
            <label for="name">Name:</label>
            <input  type="text" minlength="0" maxlength="20" id="name" class="inlog-input" required>
            <label for="Pass">Password:</label>
            <input type="text"  minlength="0" maxlength="20"  id="Pass" class="inlog-input" required>
            <input  class="inlog-input" type="submit">
        </form>
    </div>
    </body>
</html>