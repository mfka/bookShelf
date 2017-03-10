<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src='js/app.js'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <nav class='navbar navbar-default'>
            <div class="center-block">
                <h1 class='page-header text-center'>Your Books</h1>
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
                        <h3 class='text-center'>New position</h3>
                    </div>
                    <div class='panel-body'>
                        <div class='panel'>
                            <form class='form-horizontal' id="addBook" action="" method="POST">
                                <div class='form-group'>
                                    <br>
                                    <label>Title:</label>
                                    <br>
                                    <input class='form-control' id="bookTitle" type="text" name="title"
                                           placeholder="e.g. Harry Potter">
                                    <br>
                                    <label>Author:</label>
                                    <br>
                                    <input class='form-control' id="bookAuthor" type="text" name="author"
                                           placeholder="Full Name">
                                    <br>
                                    <label>Description:</label>
                                    <br>
                                    <textarea class='form-control' id="bookDesc" name='desc'></textarea>
                                    <br>
                                    <input class='btn btn-primary' type="submit" value="Send">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
