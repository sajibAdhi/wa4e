<?php require_once"Model/addModel.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sajib Adhikary - CREATE</title>

    <?php require_once "link.php"; ?>
</head>

<body>
    <div class="container">
        <h1>Add Resume From Sajib</h1>
        <br>
        <br>
        <form method="POST">
            <!-- First Name -->
            <div class="form-group row">
                <label for="first_name" class="col-md-3 col-form-label">First Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="first_name" id="first_name">
                </div>
            </div>
            <!-- Last Name -->
            <div class="form-group row">
                <label for="last_name" class="col-md-3 col-form-label">Last Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="last_name" id="last_name">
                </div>
            </div>
            <!-- email -->
            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label">Email:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="email" id="email">
                </div>
            </div>
            <!-- HEADLINE -->
            <div class="form-group row">
                <label for="hline" class="col-md-3 col-form-label">Headline</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="headline" id="headline">
                </div>
            </div>
            <!-- Summary -->
            <div class="form-group row">
                <label for="summary" class="col-md-3 col-form-label">Summary</label>
                <div class="col-md-9">
                    <textarea class="form-control" name="summary" id="summary" rows="3"></textarea>
                </div>
            </div>
            <!-- New  Positions -->
            <div id="positionFields">
                
            </div>
            <!-- position -->
            <div class="form-group row">
                <label for="addPos" class="col-md-3 col-form-label">Position</label>
                <div class="col-md-9">
                    <button type="button" id="addPos" class="btn btn-warning">+</button>
                </div>
            </div>
            <!-- Add Button -->
            <div class="form-group row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
        <a name="" id="" class="btn btn-secondary" href="index.php" role="button">Cancle</a>
    </div>
    <br>
    <br>
    <?php require_once "script.php"; ?>

    <!-- Custom Script -->
    <script>
        countPos = 0;

        $(document).ready(function() {
            window.console && console.log('Document ready called');
            $('#addPos').click(function(event) {

                event.preventDefault();
                if (countPos >= 9) {
                    alert("Maximum of nine position entries exceeded");
                    return;
                }
                countPos++;
                window.console && console.log("Adding position " + countPos);
                $('#positionFields').append(
                    '<div id="position' + countPos + '"> \
                        <div class="form-group row"> \
                            <label class="col-md-3 col-form-label">Year</label> \
                            <div class="col-md-6"> \
                                <input type="text" class="form-control" name="year'+ countPos +'"> \
                            </div> \
                            <button type="button" onclick="$(\'#position' + countPos + '\').remove();return false;" \
                            class="btn btn-warning">-</button> \
                        </div> \
                        <div class="form-group row"> \
                            <label class="col-md-3 col-form-label">Position</label> \
                            <div class="col-md-9"> \
                                <input type="text" class="form-control" name="position'+countPos+'"> \
                            </div> \
                        </div> \
                    </div>'
                );
            });
        });
    </script>
</body>

</html>