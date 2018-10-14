<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - À propos</title>
    <link rel="shortcut icon" href="favicon.png" />
    <link rel='stylesheet' href='css/style.css' />
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">

        <section>
            <div class="row">
                <div class="col">
                    <h1>À propos de MBDesk</h1>
                </div>
            </div>
        </section>

        <section>
            <div class="row" style="align-items:center;">
                <div class="col">
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fermentum interdum nunc sed semper. Nulla pharetra, sem vitae aliquet pellentesque, nunc lectus sagittis massa, id bibendum enim mauris vel quam. Curabitur sed libero eu arcu feugiat aliquet nec non metus. Suspendisse lorem diam, sodales sed eros ut, volutpat condimentum leo. Curabitur quis interdum erat. Nullam ornare ex nec dui egestas dignissim. Nunc sodales a purus vitae commodo. Nunc neque risus, maximus id gravida vel, auctor eu ligula. Nam quis elementum elit. Nunc at augue tempus, laoreet sem a, placerat enim. Praesent at rutrum elit, in luctus ex.
                    </p>
                    <p>
                    Suspendisse ac nulla aliquam mauris malesuada sollicitudin. Donec at consequat ex. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam lobortis porta nibh vitae volutpat. Nulla facilisi. Sed luctus magna sit amet efficitur gravida. Morbi in tristique lectus. Fusce imperdiet a nisl nec efficitur. Phasellus commodo tincidunt eros nec molestie. Aliquam congue at velit vitae consequat. Sed at quam nulla. Suspendisse aliquam elit eget odio consequat, eu cursus sem lacinia. Nam nec neque lacus.
                    </p>
                </div>
            </div>
        </section>

        <?php include("components/footer.php") ?>

    </div>

    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/aos/aos.js"></script>

</body>

</html>
