<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
  
<x-app-layout>
    
</x-app-layout>

<!DOCTYPE html>
<html lang="en">
  <head>

  @include("admin.admincss")

  </head>
  <body>
    <div class="container-scroller">

    @include("admin.navbar")

   <div style="position: relative; top: 60px; right: -150px">

       <table bgcolor="grey" border="3px">

          <tr>
            <th style="padding: 30px">Name</th>
            <th style="padding: 30px">Email</th>
            <th style="padding: 30px">Action</th>
          </tr>


          @foreach($date as $key)
          <tr align="center">
            <td>{{$key->name}}</td>
            <td>{{$key->email}}</td>

            @if($key->usertype == "0")
            <td><a href="{{url('/deleteuser',$key->id)}}">Delete</a></td>
            @else
            <td><a>Not Allowed</a></td>
            @endif


          </tr>

          @endforeach





       </table>

   </div>

</div> 

  @include("admin.adminscript")

  </body>
</html>

</body>
</html>
