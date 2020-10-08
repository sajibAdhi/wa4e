<?php require_once "Model/editModel.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <title>Sajib Adhikary - UPDATE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <br>
        <br>
        <span><?= empty($msg) ? '' : $msg ?></span>
        <!-- Form -->
        <form method="POST">
            <input type="hidden" name="id" value="<?= $data['profile_id'] ?>">
            <!-- First Name -->
            <div class="form-group row">
                <label for="first_name" class="col-md-3 col-form-label">First Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['first_name']) ?>" name="first_name" id="first_name">
                </div>
            </div>
            <!-- Last Name -->
            <div class="form-group row">
                <label for="last_name" class="col-md-3 col-form-label">Last Name:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['last_name']) ?>" name="last_name" id="last_name">
                </div>
            </div>
            <!-- email -->
            <div class="form-group row">
                <label for="email" class="col-md-3 col-form-label">Email:</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['email']) ?>" name="email" id="email">
                </div>
            </div>
            <!-- HEADLINE -->
            <div class="form-group row">
                <label for="hline" class="col-md-3 col-form-label">Headline</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['headline']) ?>" name="headline" id="headline">
                </div>
            </div>
            <!-- Summary -->
            <div class="form-group row">
                <label for="summary" class="col-md-3 col-form-label">Summary</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= htmlentities($data['summary']) ?>" name="summary" id="summary">
                </div>
            </div>
            <!-- New  Positions -->
            <div id="positionFields">
                <?php
                // var_dump($positions);
                if ($positions  != FALSE) : ?>
                    <?php for ($i = 0; $i < count($positions); $i++) : ?>
                        <div id="position<?= $i ?>">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Year</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="year<?= $i ?>" value="<?= $positions[$i]['year']?>">
                                </div>
                                <button type="button" onclick="$('#position<?= $i ?>').remove();return false;" class="btn btn-warning">-</button>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Position</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="position<?= $i ?>" value="<?= $positions[$i]['description'] ?>" >
                                </div>
                            </div>
                        </div>
                    <?php endfor ?>
                <?php endif ?>
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
                <div class="col-sm-10">
                    <input class="btn btn-primary" type="submit" value="Save">
                </div>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Custom Js -->
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
                                <input type="text" class="form-control" name="year' + countPos + '"> \
                            </div> \
                            <button type="button" onclick="$(\'#position' + countPos + '\').remove();return false;" \
                            class="btn btn-warning">-</button> \
                        </div> \
                        <div class="form-group row"> \
                            <label class="col-md-3 col-form-label">Position</label> \
                            <div class="col-md-9"> \
                                <input type="text" class="form-control" name="position' + countPos + '"> \
                            </div> \
                        </div> \
                    </div>'
                );
            });
        });

        function doValidate() {

            console.log('Validating...');

            fn = document.getElementById('first_name').value;
            ln = document.getElementById('last_name').value;
            em = document.getElementById('email').value;
            hl = document.getElementById('headline').value;
            su = document.getElementById('summary').value;

            console.log("Validating pw=" + fn);

            if (fn == null || fn == "" ||
                ln == null || ln == "" ||
                em == null || em == "" ||
                hl == null || hl == "" ||
                su == null || su == ""
            ) {

                alert("All fields are required");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>