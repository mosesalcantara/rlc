<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');

body{
    font-family: 'Open Sans', sans-serif;
    
}
.search{
  
  top:6px;
  left:10px;
}

.form-control{
    
    border:none;
    padding-left:32px;
}

.form-control:focus{
    
    border:none;
    box-shadow:none;
}

.green{
    
    color:green;
}
</style>
</head>
<body>
  <div class="container mt-5 px-2">
    
    <div class="mb-2 d-flex justify-content-between align-items-center">
        
        <div class="position-relative">
            <span class="position-absolute search"><i class="fa fa-search"></i></span>
            <input class="form-control w-100" placeholder="Search by order#, name...">
        </div>
        
        <div class="px-2">
            
            <span>Filters <i class="fa fa-angle-down"></i></span>
            <i class="fa fa-ellipsis-h ms-3"></i>
        </div>
        
    </div>
    <div class="table-responsive">
    <table class="table table-responsive table-borderless">
        
      <thead>
        <tr class="bg-light">
          <th><input class="form-check-input" type="checkbox"></th>
          <th>#</th>
          <th>Date</th>
          <th>Status</th>
          <th>Customer</th>
          <th>Purchased</th>
          <th><span>Revenue</span></th>
        </tr>
      </thead>
  <tbody>
    <tr>
      <th scope="row"><input class="form-check-input" type="checkbox"></th>
      <td>12</td>
      <td>1 Oct, 21</td>
      <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Paid</span></td>
      <td><img src="https://i.imgur.com/VKOeFyS.png" width="25"> Althan Travis</td>
      <td>Wirecard for figma</td>
      <td class="text-end"><span class="fw-bolder">$0.99</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
    </tr>
    
    <tr>
      <th scope="row"><input class="form-check-input" type="checkbox"></th>
      <td>14</td>
      <td>12 Oct, 21</td>
      <td><i class="fa fa-dot-circle-o text-danger"></i><span class="ms-1">Failed</span></td>
      <td><img src="https://i.imgur.com/nmnmfGv.png" width="25"> Tomo arvis</td>
      <td>Altroz furry</td>
      <td class="text-end"><span class="fw-bolder">$0.19</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
    </tr>
    
    
    <tr>
      <th scope="row"><input class="form-check-input" type="checkbox"></th>
      <td>17</td>
      <td>1 Nov, 21</td>
      <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Paid</span></td>
      <td><img src="https://i.imgur.com/VKOeFyS.png" width="25"> Althan Travis</td>
      <td>Apple Macbook air</td>
      <td class="text-end"><span class="fw-bolder">$1.99</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
    </tr>
    
    
    <tr>
      <th scope="row"><input class="form-check-input" type="checkbox"></th>
      <td>90</td>
      <td>19 Oct, 21</td>
      <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Paid</span></td>
      <td><img src="https://i.imgur.com/VKOeFyS.png" width="25"> Travis head</td>
      <td>Apple Macbook Pro</td>
      <td class="text-end"><span class="fw-bolder">$9.99</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
    </tr>
    
    
    <tr>
      <th scope="row"><input class="form-check-input" type="checkbox"></th>
      <td>12</td>
      <td>1 Oct, 21</td>
      <td><i class="fa fa-check-circle-o green"></i><span class="ms-1">Paid</span></td>
      <td><img src="https://i.imgur.com/nmnmfGv.png" width="25"> Althan Travis</td>
      <td>Wirecard for figma</td>
      <td class="text-end"><span class="fw-bolder">$0.99</span> <i class="fa fa-ellipsis-h  ms-2"></i></td>
    </tr>
  </tbody>
</table>
  
  </div>
    
</div>   
</body>
</html>