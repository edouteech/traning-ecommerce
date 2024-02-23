<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <section><h1>Login</h1></section>
    // On affiche des variables avec blade.
    <p>Page de Login de (blade): {{$name}}</p>
    
    <?php
    if($name=='John') {
        ?> Message l'orsque le nom est John <?php>
    }else{?><p> Message quand ce n'est pas John</p><?php>}
    
    ?>


    //
</body>
</html>