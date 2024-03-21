<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <style>
    .container {
  position: relative;
  text-align: center;
  color: white;
}
    .centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
  </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('/img/pages/for_lease/residential.png') }}" alt="">

        <div class="centered">
            Residential
        </div>
    </div>
</body>
</html>