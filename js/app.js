$(function() {

    //layout and fields of Book to display
    function displayBook(variable) {
        var newLi = $('<a href="#" class="list-group-item">');
        var newTitle = $('<h4 class="list-group-item-heading bookTitle" data-id="' + variable.id + '">' + variable.book_name + '</h4>');
        var newAuthor = $('<div class="bookAuthor"></div>');
        var newDescription = $('<div class="bookDescription"></div>');
        var newButtons = $('<div class="buttons"></div>').hide();
        newLi.append(newTitle, newAuthor, newDescription, newButtons);
        $('div.bookShelf').append(newLi);
        $('.list-group-item').on('click', function(e) {
            e.preventDefault();
        });
    }

    //Show Books from DataBase
    function showBooks(id) {
        $.ajax({
            url: 'api/books.php',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(result) {
                // load a new book
                if (typeof(id) !== 'undefined') {
                    displayBook(result);
                    // load all books
                } else {
                    $.each(result, function(index, val) {
                        displayBook(val);
                    });
                }
            },
            //Error information
            error: function(xhr, status, errorThrown) {
                console.log(xhr);
                console.log(status);
                console.log(errorThrown);
            }
        });
    }


    // Show details
    $('div.bookShelf').on('click', '.bookTitle', function(e) {
        e.preventDefault();
        var descDiv = $(this).parent().find('div.bookDescription');
        var authorDiv = $(this).parent().find('div.bookAuthor');
        var clickedId = $(this).attr('data-id');

        //check if there is Author and Description loaded
        if (descDiv.html() !== '') {
            descDiv.parent().find('.bookTitle').nextAll().toggle('slow');
            // if not is taking from DB
        } else {
            $.ajax({
                url: 'api/books.php',
                type: 'GET',
                data: {
                    id: clickedId
                },
                dataType: 'json',
                success: function(result) {
                    //Display book description
                    descDiv.hide();
                    descDiv.html(result.book_desc);

                    //display Author of the book
                    authorDiv.hide();
                    authorDiv.html(result.book_author);
                    //add action buttons
                    authorDiv.parent().find('div.buttons').append('<a class="btn btn-xs btn-primary" id="hideDesc" href="#"> <span class="glyphicon glyphicon glyphicon-chevron-up" aria-hidden="true"></span>Hide</a> ');
                    authorDiv.parent().find('div.buttons').append('<a class="btn btn-xs btn-danger" id="del" href="#">Usuń Pozycję</a> ');
                    authorDiv.parent().find('div.buttons').append('<a class="btn btn-xs btn-warning" id="edit" href="#">Edytuj</a>');
                    descDiv.parent().children().show('slow');

                    //Toggle Info
                    $('a#hideDesc').on('click', function(e) {
                        descDiv.parent().find('.bookTitle').nextAll().hide('slow');
                    });

                    // Delete and Edit Button
                    $('a#del').on('click', function(e) {
                        e.preventDefault();

                        //declare element form .bookList to remove
                        var listElRemove = ($(this).parent().parent());

                        $.ajax({
                            url: 'api/books.php',
                            type: 'DELETE',
                            data: {
                                id: $(this).parent().parent().find('h4.bookTitle').attr('data-id')
                            },
                            success: function() {
                                listElRemove.remove();
                                alert('Book was deleted');

                            },
                            //Error Info
                            error: function(xhr, status, errorThrown) {
                                console.log(xhr);
                                console.log(status);
                                console.log(errorThrown);
                            }
                        });
                    });

                    var editClicked = 0;

                    $('a#edit').on('click', function(e) {
                        e.preventDefault();
                        if (editClicked == 1) {
                            e.stopPropagation()
                        } else {
                            editClicked = 1;

                            //book Title to edit
                            var toEditTitle = $(this).parent().parent().find('.bookTitle').html();
                            $('<div id="titleToEdit"><label>Tytuł: </label><br><input class="form-control" id="editedTitle" type="text" value="' + toEditTitle + '"/></div>').insertBefore($(this).parent().parent().find('.bookAuthor'));

                            ///book Author
                            var toEditAuthor = $(this).parent().parent().find('.bookAuthor').html();
                            var editedAuthor = $('<label>Autor: </label><br><input class="form-control" id="editedAuthor" type="text" value="' + toEditAuthor + '"/>');
                            $(this).parent().parent().find('.bookAuthor').html(editedAuthor);

                            //book Desc
                            var toEditDesc = $(this).parent().parent().find('.bookDescription').html();
                            var editedDesc = $('<label>Opis: </label><br><textarea class="form-control" id="editedDesc">' + toEditDesc + '</textarea>');
                            $(this).parent().parent().find('.bookDescription').html(editedDesc);

                            var parentDesc = $(this).parent().parent().find('.bookDescription');
                            //add cancel Edit button
                            $('<button class="btn btn-xs btn-primary" id="cancelEdit"  type="submit">Anuluj</button>').insertAfter(parentDesc);

                            // add conifrm Edit button
                            $('<button class="btn btn-primary btn-xs" id="confirmEdit" type="submit">Zapisz zmiany</button></').insertAfter(parentDesc);


                            //Get previous look!
                            function backToNormal(clickedButton) {
                                ///Remove title field
                                clickedButton.parent().find('#titleToEdit').remove();
                                //author prev value
                                clickedButton.parent().find('.bookAuthor').html(toEditAuthor);
                                //description prev value
                                clickedButton.parent().find('.bookDescription').html(toEditDesc);
                                //remove confirm button
                                clickedButton.parent().find('#confirmEdit').remove();
                                //remove cancel button
                                clickedButton.parent().find('#cancelEdit').remove();
                                editClicked = 0;
                            }

                            //when user is hiding the element is changing back the look
                            $(this).parent().parent().find('.bookTitle').one('click', function() {
                                backToNormal($(this));
                                //hide all element
                            });


                            //when user click "cancel" it getting prev look
                            $(this).parent().parent().find('button#cancelEdit').on('click', function() {
                                backToNormal($(this));

                            });

                            //when user click "save"
                            $(this).parent().parent().find('button#confirmEdit').one('click', function(e) {
                                e.preventDefault();
                                var toRemove = $(this).parent();


                                $.ajax({
                                    url: 'api/books.php',
                                    type: 'PUT',
                                    dataType: 'json',
                                    data: {
                                        id: $(this).parent().find('h4.bookTitle').attr('data-id'),
                                        name: $(this).parent().find('input#editedTitle').val(),
                                        author: $(this).parent().find('input#editedAuthor').val(),
                                        descrpition: $(this).parent().find('textarea#editedDesc').val()
                                    },
                                    success: function(result) {
                                        toRemove.remove();
                                        displayBook(result);
                                        alert('Zmiany zostały wprowadzone!');

                                    },
                                    //Informacje o błędzie
                                    error: function(xhr, status, errorThrown) {
                                        console.log(xhr);
                                        console.log(status);
                                        console.log(errorThrown);
                                    }
                                });
                            });
                        }
                        editClicked = 1;
                    });
                },
                //Informacje o błędzie
                error: function(xhr, status, errorThrown) {
                    console.log(xhr);
                    console.log(status);
                    console.log(errorThrown);
                }
            });
        }
    });

    //addBook to database and show at the end of List
    $('form#addBook').on('submit', function(e) {
        e.preventDefault();
        var name = $(this).find('#bookTitle');
        var author = $(this).find('#bookAuthor');
        var desc = $(this).find('#bookDesc');

        if ((name.length <= 0) || (author.length <= 0) || (desc.length <= 0)) {
            alert('Please fill up all fields');
        } else {
            $.ajax({
                url: 'api/books.php',
                type: 'POST',
                data: $('form#addBook').serialize(),
                dataType: 'json',
                success: function(result) {
                    displayBook(result);
                    alert('Dodano nową książkę');
                    name.val('');
                    author.val('');
                    desc.val('');
                },
                //Error info
                error: function(xhr, status, errorThrown) {
                    console.log(xhr);
                    console.log(status);
                    console.log(errorThrown);
                }
            });
        }

    });
    showBooks();
});
