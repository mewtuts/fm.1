<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
    {{-- <img src="data:{{ $fileMimeType }};base64,{{ base64_encode($fileContents) }}" /> --}}
    {{-- <embed src="data:application/pdf;base64,{{ base64_encode($path) }}" type="application/pdf" /> --}}
    <iframe src="{{ $path }}" class="w-full  h-screen"></iframe>
    {{-- {{!! $html !!}} --}}
</body>
</html>
