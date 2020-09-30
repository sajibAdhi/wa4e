<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        /**
         * @class className
         *
         * @property int x
         * @method mixed methodName()
         */
        function className() {
            this.x = 0;
            this.methodName = function (){
                this.x = this.x + 1;
                console.log("So Far X = "+this.x);
            }
        }

        obj = new className();

        console.log("Value of x : " +obj.x);

        obj.methodName();
        obj.methodName();
        obj.methodName();


    </script>
</body>
</html>