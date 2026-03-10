<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>QR {{ $tenant->name }}</title>

<style>

body{
font-family: Arial, sans-serif;
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
margin:0;
}

.poster{

width:300px;
text-align:center;
padding:25px;
border:2px solid black;

}

.business{
font-size:22px;
font-weight:bold;
margin-bottom:10px;
}

.scan{
font-size:18px;
margin-bottom:15px;
}

.qr{

display:flex;
justify-content:center;

}

.qr svg{

width:200px;
height:200px;

}

.url{

margin-top:15px;
font-size:14px;
word-break:break-all;

}

.print-btn{
margin-top:25px;
padding:10px 20px;
font-size:16px;
cursor:pointer;
}

@media print{

body{
display:block;
}

.poster{

margin:auto;
page-break-inside:avoid;

}

.print-btn{
display:none;
}

}

</style>

</head>

<body>

<div>

<div class="poster">

<div class="business">
{{ $tenant->name }}
</div>

<div class="scan">
Escanea el QR para ver el menú
</div>

<div class="qr">
{!! $qrCode !!}
</div>

<div class="url">
{{ $url }}
</div>

</div>

<button onclick="window.print()" class="print-btn">
Imprimir
</button>

</div>

</body>
</html>