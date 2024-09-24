<!DOCTYPE html>
<html>

<head>
    <title>REPACAR</title>
</head>

<body>
    <h1>{{ $details['message'] ?? '' }}</h1>
    <p>{{ $details['cellphone'] ?? '' }}</p>
    @if ($details['url'])
        <a href="{{ $details['url'] }}">Clique aqui para atualizar sua senha</a>
    @endif

    <p>A Repacar agradece o seu contato!</p>
</body>

</html>
