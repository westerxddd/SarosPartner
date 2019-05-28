<?php

namespace App\Imports;

use App\Client;
use App\Import;
use App\Point;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToCollection,WithHeadingRow
{

    public function collection(Collection $rows)
    {
        $import = new Import;
        $import->save();

        foreach ($rows as $key => $row){
            if ($key==0){
                continue;
            }

            if (strpos(strtolower($row['kontrahent']),'paragon')){
                continue;
            }

            if(strpos(strtolower($row['kontrahent']),'ogólna suma')){
                continue;
            }

            if (count(Client::where('name','=',$row['kontrahent'])->get())>0){
                continue;
            }

            $client = new Client;
            $client->name = $row['kontrahent'];
            $client->nip = str_replace('-', '', $row['nip']);
            $client->import_id = $import->id;
            $client->save();

            $points = new Point;
            $points->client_id = $client->id;
            $points->amount = 0;
            $points->save();

        }
    }
}
