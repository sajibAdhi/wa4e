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
         * @param mixed nam
         * @property int x
         * @method mixed methodName()
         */
        function className(nam) {
            console.log("Start of Constructor");

            this.x = 0;
            this.name = nam;

            console.log("Constructor");
            
            this.methodName = function (){
                this.x = this.x + 1;
                console.log(this.name+" = "+this.x);
            }
            
            console.log("End of Constructor");
        }

        console.log("aobj Startes Here");
        aobj = new className("ajob");
        aobj.methodName();
        console.log(aobj.name+"Value of x : " +aobj.x);

        console.log("bobj Startes Here");
        bobj = new className("bjob");
        bobj.methodName();
        console.log(bobj.name+"Value of x : " +bobj.x);
        bobj.methodName();
        bobj.methodName();


    </script>
</body>
</html>