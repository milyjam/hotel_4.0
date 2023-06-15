<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
    
    /**
     * Get images via api for populate tables
     *
     * Undocumented function long description
     *
     * @param string $query info of pic
     * @param string $qtd quantitity of pics
     * @return array
     * @author Dário Gabriel - dariogabriel2334@gmail.com
     **/
    public static function getImage(string $query = '', int $qtd = 0)
    {
        try {
            $apiUrl = 'https://api.unsplash.com/photos/random'; 
            $accessKey = env('UNSPLASH_ACCESS_KEY', ''); 

            $searchParams = [
                'query' => $query,
                'orientation' => 'landscape',
                'count' => $qtd
            ];

            $apiUrl .= '?' . http_build_query($searchParams);

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Authorization: Client-ID ' . $accessKey,
            ]);

            $response = curl_exec($curl);

            if ($response === false) {
                $error = curl_error($curl);
            } else {
                $data = json_decode($response, true);
            }

            curl_close($curl);

            return $data;
        } catch (\Throwable $th) {
            return array();
        }
        
    }
}
