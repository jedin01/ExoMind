<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receita Médica</title>
    <style>
        body { font-family: sans-serif; font-size: 12pt; }
        .titulo { text-align: center; font-size: 16pt; font-weight: bold; margin-bottom: 20px; }
        .info-paciente { margin-bottom: 10px; }
        .medicamentos { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        .assinatura-medico { margin-top: 40px; text-align: right; font-style: italic; }
    </style>
</head>
<body>
    <div class="titulo">Receita Médica</div>
    <div class="info-paciente">
        <strong>Nº de Processo:</strong> {{ $paciente->id ?? 'N/A' }}<br>
        <strong>Paciente:</strong> {{ $paciente->nome ?? 'N/A' }}<br>
        <strong>Idade:</strong> {{ $idade['idade'] ?? 'N/A' }} {{ $idade['unidade'] ?? '' }}<br>
        <strong>Peso:</strong> {{ $triagem->peso ?? 'N/A' }} kg<br>
    </div>

    <div class="medicamentos">
        <h4>Medicamentos Prescritos:</h4>
        <table>
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>Dosagem</th>
                    <th>Frequência Ataque</th>
                    <th>Frequência Manutenção</th>
                    <th>Duração</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medicamentos as $item)
                <tr>
                    <td>{{ $item->fk_medicamento->nome }}</td>
                    <td>{{ $item->dosagem }}</td>
                    <td>{{ $item->frequencia_ataque }}</td>
                    <td>{{ $item->frequencia_manutencao }}</td>
                    <td>{{ $item->duracao }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="assinatura-medico">
        <p>Luanda, {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <p style="margin-bottom: 60px;">&nbsp;</p> <!-- Espaço para a assinatura -->
        <div style="border-bottom: 1px solid #000; width: 250px; margin-left: auto;"></div>
        <p style="text-align: right;"><strong>Médico Responsável:</strong> {{ $medico->name ?? 'Dr. (Nome não disponível)' }}</p>
    </div>

</body>
</html>
