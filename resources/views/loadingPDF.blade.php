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
            width: 80%;
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
        th {
            text-align: left;
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
                    <td class="attribut">depart CFS</td>
                    <td>{{ $file->departCFS !== null ? $file->departCFS : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">entree Gate 3</td>
                    <td>{{ $file->entreeGate3 !== null ? $file->entreeGate3 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">arrivee Gate 10</td>
                    <td>{{ $file->arriveeGate10 !== null ? $file->arriveeGate10 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">passage Gate 10</td>
                    <td>{{ $file->passageGate10 !== null ? $file->passageGate10 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">chargement TC1</td>
                    <td>{{ $file->chargementTC1 !== null ? $file->chargementTC1 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">chargement TC2</td>
                    <td>{{ $file->chargementTC2 !== null ? $file->chargementTC2 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">passage Scanner</td>
                    <td>{{ $file->passageScanner !== null ? $file->passageScanner : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">resultat Scanner</td>
                    <td>{{ $file->resultatScanner !== null ? $file->resultatScanner : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">sortie Douane</td>
                    <td>{{ $file->sortieDouane !== null ? $file->sortieDouane : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">sortie Gate 3</td>
                    <td>{{ $file->sortieGate3 !== null ? $file->sortieGate3 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">arrivee Client</td>
                    <td>{{ $file->arriveeClient !== null ? $file->arriveeClient : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">debut Déchargement</td>
                    <td>{{ $file->debutDehargement !== null ? $file->debutDehargement : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">fin Déchargement</td>
                    <td>{{ $file->finDechargement !== null ? $file->finDechargement : '' }}</td>
                <tr>
                    <td class="attribut">depart Client</td>
                    <td>{{ $file->departClient !== null ? $file->departClient : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">arrivee Gate 3</td>
                    <td>{{ $file->arriveeGate3 !== null ? $file->arriveeGate3 : '' }}</td>
                </tr>
                <tr>
                    <td class="attribut">arrivee CFS</td>
                    <td>{{ $file->arriveeCFS !== null ? $file->arriveeCFS : '' }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
