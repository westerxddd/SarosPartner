<?php

namespace App\Imports;

use App\Client;
use App\ClientArticles;
use App\Point;
use App\Import;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticlesForClientsImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $import = new Import;
        $import->save();

        foreach ($rows as $key => $row){
            if(strpos(strtolower($row['kontrahent']),'ogólna suma')){
                continue;
            }

            if (strpos(strtolower($row['kontrahent']),'paragon')){
                continue;
            }

            $client = Client::where('name','=',$row['kontrahent'])->first();

            if (!isset($client)){
                $client = new Client;
                $client->name = $row['kontrahent'];
                $client->import_id = $import->id;
                $client->save();

                $points = new Point;
                $points->client_id = $client->id;
                $points->amount = 0;
                $points->save();
            }

            $article = new ClientArticles;
            $article->client_id = $client->id;
//            $article->fix = $row['fiks'];
            $article->prefix = $row['prefiks'];
            $article->netto = doubleval(str_replace(',','.',$row['wartosc_netto']));
//            $article->index = $row['indeks'];
//            $article->name = $row['nazwa'];
            $article->import_id = $import->id;
            $article->save();

            $article->client->addPoints($article->netto);

        }
    }
}
