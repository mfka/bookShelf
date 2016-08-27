<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src='js/app.js'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav class='navbar navbar-default'>
            <div class="center-block">

                <h1 class='page-header text-center'>Twoje Książki</h1>

            </div>
        </div>        
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 ">
                <div class=''>
                    <div class="bookShelf list-group">

                    </div>
                </div>
            </div>


            <div class="col-xs-12 col-sm-6">
                <div class='page-header'>
                    <h3 class='text-center'>Dodaj nową pozycję</h3>
                </div>

                <div class='panel-body'>
                    <div class='panel'>
                        <form class='form-horizontal' id="addBook" action="" method="POST">
                            <div class='form-group'>
                                <br>
                                <label>Podaj tytuł książki:</label>
                                <br>
                                <input class='form-control' id="bookTitle" type="text" name="name" placeholder="podaj tytuł książki">
                                <br>
                                <label>Podaj autora książki:</label>
                                <br>
                                <input class='form-control' id="bookAuthor" type="text" name="author" placeholder="podaj imię i nazwisko autora">
                                <br>
                                <label>Dodaj tytuł książki:</label>
                                <br>
                                <textarea class='form-control' id="bookDesc" name ='description'></textarea>
                                <br>
                                <input class='btn btn-primary' type="submit" value="Dodaj">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>
</html>
