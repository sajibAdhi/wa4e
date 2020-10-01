<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="target">
        <input type="text" name="one" style="vertical-align: middle;">
        <br>
        <img id="spinner" src="preview.gif" alt="Spinner" width="25%" style="
                vertical-align: middle;
                display: none;
            ">
    </form>
    <br>
    <br>
    <div id="result"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $('#target').change(function() {

            window.console && console.log('Get the Target');
            $('#spinner').show();

            var form = $('#target');
            var txt = form.find('input[name="one"]').val();

            window.console && console.log('Sending Post');
            /// jQuery.post( url [, data ] [, success ] [, dataType ] )
            $.post( 'autoecho.php', { 'val' : txt},
                function(data){
                    window.console && console.log(data);
                    $('#result').empty().append(data);
                    $('#spinner').hide();
                }
            ).error( function(){
                $('#target').css('background-color', 'red');
                alert('Danger!');
            });
        });
    </script>
</body>

</html>