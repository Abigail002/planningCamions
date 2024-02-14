<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background-image: url(/logoMedlog.png);
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            padding: 10px;
        }

        .content {
            width: 100%;
            background-color: rgb(255, 255, 156);
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            max-width: 700px;
        }

        table{
            margin-left: auto;
            margin-right: auto;
        }

        hr {
            height: 2px;
            background-color: rgb(182, 119, 2);
            border-color: rgb(182, 119, 2);
        }

        h1,
        h2 {
            font-family: Impact, serif;
        }

        .established {
            font-style: italic;
        }

        .libelle {
            text-align: left;
            width: 25%;
        }

        .value {
            text-align: right;
            width: 25%;
        }

        .item p {
            display: inline-block;
            margin-top: 5px;
            margin-bottom: 5px;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="content">
        <div align="center">
            <h1><u> Fiche de chargement</u></h1>
            <p class="established">MEDLOG TOGO</p>
            <hr>
            <h2>A propos de la marchandise</h2>
            <article class="item">
                <p class="libelle"><u>Client :</u></p><p class="value">{{ $customer->name }}</p>
            </article>
            <article class="item">
                <p class="libelle"><u>TC1 :</u></p><p class="value">{{ $container->number }}</p>
            </article>
            <article class="item">
                <p class="libelle"><u>TC2 :</u></p><p class="value">{{ $anotherContainer !== null && $anotherContainer->number !== null ? $anotherContainer->number : 'null' }}</p>            </article>
            <hr>
            <h2>A propos du chauffeur</h2>
            <article class="item">
                <p class="libelle"><u>Nom :</u></p><p class="value">{{ $driver->name }}</p>
            </article>
            <article class="item">
                <p class="libelle"><u>Contact :</u></p><p class="value">{{ $driver->contact }}</p>
            </article>
            <hr>
            <h2>Détails sur la livraison</h2>
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
    </div>
</body>

</html>
