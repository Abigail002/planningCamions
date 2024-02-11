<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <h1><em>MEDLOG</em></h1>
    </div>
    <div align="center">
        <h2>Fiche de chargement</h2>
        <h3>TC1 : MEDU6789065</h3>
        <h3>TC2 : MEDU6789065</h3>
        <table border="2">
            <tr>
                <th>Libelle</th>
                <th>Heure</th>
            </tr>
            <tr>
                <th>depart CFS</th>
                <td>{{ $file->departCFS }}</td>
            </tr>
            <tr>
                <th>entree Gate 3</th>
                <td>{{ $file->entreeGate3 }}</td>
            </tr>
            <tr>
                <th>arrivee Gate 10</th>
                <td>{{ $file->arriveeGate10 }}</td>
            </tr>
            <tr>
                <th>passage Gate 10</th>
                <td>{{ $file->passageGate10 }}</td>
            </tr>
            <tr>
                <th>chargement TC1</th>
                <td>{{ $file->chargementTC1 }}</td>
            </tr>
            <tr>
                <th>chargement TC2</th>
                <td>{{ $file->chargementTC2 }}</td>
            </tr>
            <tr>
                <th>passage Scanner</th>
                <td>{{ $file->passageScanner }}</td>
            </tr>
            <tr>
                <th>resultat Scanner</th>
                <td>{{ $file->resultatScanner }}</td>
            </tr>
            <tr>
                <th>sortie Douane</th>
                <td>{{ $file->sortieDouane }}</td>
            </tr>
            <tr>
                <th>sortie Gate 3</th>
                <td>{{ $file->sortieGate3 }}</td>
            </tr>
            <tr>
                <th>arrivee Client</th>
                <td>{{ $file->arriveeClient }}</td>
            </tr>
            <tr>
                <th>debut Déchargement</th>
                <td>{{ $file->debutDehargement }}</td>
            </tr>
            <tr>
                <th>fin Déchargement</th>
                <td>{{ $file->finDechargement }}</td>
            <tr>
                <th>depart Client</th>
                <td>{{ $file->departClient }}</td>
            </tr>
            <tr>
                <th>arrivee Gate 3</th>
                <td>{{ $file->arriveeGate3 }}</td>
            </tr>
            <tr>
                <th>arrivee CFS</th>
                <td>{{ $file->arriveeCFS }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
