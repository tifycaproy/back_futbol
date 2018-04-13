<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body{
    margin: 0px;
    padding: 10px;

  }
  .imagen{
    text-align: center;


  }
  img{
    width: 100%;
    height: auto;

  }
  p{

    text-align: justify;
    line-height: 1.2;
    font-size: 1em;
    list-style-type: disc;
  }
  texto{
    text-align: justify;
    line-height: 1.2;
    font-size: 1em;
    list-style-type: disc;

  }
  @media screen and (max-width: 700px){
    body{
      font-size:12px;
    }
  }
  /* Por debajo de 400px */(
    @media screen and (max-width: 400px){
      body{
        font-size:10px;
      }
    }
</style>

</head>
<body>
    <div id="texto"><p>{!!html_entity_decode($terminos->txt1)!!}</p></div>
</body>
</html>












