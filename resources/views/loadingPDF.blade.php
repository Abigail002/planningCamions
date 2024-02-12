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
        <h2><u> Fiche de chargement</u></h2>
        <h3><u>Client :</u>  {{ $customer->name }}</h3>
        <h3><u>TC1 :</u>  {{ $container->number }}</h3>
        <h3><u>TC2 :</u> {{ $anotherContainer->number !== null ? $anotherContainer->number : 'null' }}</h3>
        <h3><u>Nom du chauffeur :</u> {{$driver->name}}</h3>
        <h3><u>Numéro de téléphone du chauffeur :</u> {{$driver->contact}}</h3>
        <table border="2" width="50%">
            <tr>
                <th>Libelle</th>
                <th>Heure</th>
            </tr>
            <tr>
                <th>depart CFS</th>
                <td>{{ $file->departCFS !== null ? $file->departCFS : 'null' }}</td>
            </tr>
            <tr>
                <th>entree Gate 3</th>
                <td>{{ $file->entreeGate3 !== null ? $file->entreeGate3 : 'null' }}</td>
            </tr>
            <tr>
                <th>arrivee Gate 10</th>
                <td>{{ $file->arriveeGate10 !== null ? $file->arriveeGate10 : 'null' }}</td>
            </tr>
            <tr>
                <th>passage Gate 10</th>
                <td>{{ $file->passageGate10 !== null ? $file->passageGate10 : 'null' }}</td>
            </tr>
            <tr>
                <th>chargement TC1</th>
                <td>{{ $file->chargementTC1 !== null ? $file->chargementTC1 : 'null' }}</td>
            </tr>
            <tr>
                <th>chargement TC2</th>
                <td>{{ $file->chargementTC2 !== null ? $file->chargementTC2 : 'null' }}</td>
            </tr>
            <tr>
                <th>passage Scanner</th>
                <td>{{ $file->passageScanner !== null ? $file->passageScanner : 'null' }}</td>
            </tr>
            <tr>
                <th>resultat Scanner</th>
                <td>{{ $file->resultatScanner !== null ? $file->resultatScanner : 'null' }}</td>
            </tr>
            <tr>
                <th>sortie Douane</th>
                <td>{{ $file->sortieDouane !== null ? $file->sortieDouane : 'null' }}</td>
            </tr>
            <tr>
                <th>sortie Gate 3</th>
                <td>{{ $file->sortieGate3 !== null ? $file->sortieGate3 : 'null' }}</td>
            </tr>
            <tr>
                <th>arrivee Client</th>
                <td>{{ $file->arriveeClient !== null ? $file->arriveeClient : 'null' }}</td>
            </tr>
            <tr>
                <th>debut Déchargement</th>
                <td>{{ $file->debutDehargement !== null ? $file->debutDehargement : 'null' }}</td>
            </tr>
            <tr>
                <th>fin Déchargement</th>
                <td>{{ $file->finDechargement !== null ? $file->finDechargement : 'null' }}</td>
            <tr>
                <th>depart Client</th>
                <td>{{ $file->departClient !== null ? $file->departClient : 'null' }}</td>
            </tr>
            <tr>
                <th>arrivee Gate 3</th>
                <td>{{ $file->arriveeGate3 !== null ? $file->arriveeGate3 : 'null' }}</td>
            </tr>
            <tr>
                <th>arrivee CFS</th>
                <td>{{ $file->arriveeCFS !== null ? $file->arriveeCFS : 'null' }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
