<!DOCTYPE html>
<html lang="en">
<head>
@include('includes.head')
</head>
<body>
@include('includes.header')

@yield('content')
@include('includes.footer')
@yield('myjs') 
@yield('hidden')  

</body>
</html>
