<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProductController extends Controller
{
    public function index()
    {
        // Create a new Guzzle HTTP client instance
        $client = new Client();

        // Make an HTTP request to the JSON API
        $response = $client->get('https://dummyjson.com/products');

        // Check if the request was successful (status code 200)
        if ($response->getStatusCode() == 200) {
            // Decode the JSON response
            $products = json_decode($response->getBody(), true);

            // return $products;
            // Pass the data to the view
            return view('pages.products.index', ['products' => $products]);
        } else {
            // Handle the error
            return response()->json(['error' => 'Unable to fetch products'], $response->getStatusCode());
        }
    }
}
