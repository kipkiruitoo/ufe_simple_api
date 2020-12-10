<?php

namespace App\Http\Controllers;

use App\Centre;
use App\Civil;
use App\County;
use App\Http\Resources\Service;
use App\MDA;
use App\Nrb;
use App\Ntsa;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function nrbsearch(Request $request)
    {
        $q = $request->query('q');

        $url = "http://10.65.70.64:5623/api/search/nrb?q=";

        $client = new \GuzzleHttp\Client();

        // echo $url . $q;
        $res = $client->get($url . $q);
        // echo $res->getStatusCode(); // 200
        dd($res->getBody());
    }

    public function civilsearch(Request $request)
    {
        $q = $request->query('q');

        $url = "https://10.65.70.64:5623/api/civil";

        $results = Civil::where('phone',  $q)->get();

        return response()->json(["success" => true, 'query' => $q, 'message' => 'Civil Records retrieved successfully', 'results' => $results]);
    }

    public function ntsasearch(Request $request)
    {
        $q = $request->query('q');

        $url = "https://10.65.70.64:5623/api/ntsa";

        $results = Ntsa::where('id_no', $q)->get();

        return response()->json(["success" => true, 'query' => $q, 'message' => 'Ntsa Records retrieved successfully', 'results' => $results]);
    }

    public function getCenters()
    {
        $results =  Centre::all();
        return response()->json(["success" => true, 'query' => 'all centers', 'message' => 'Huduma Centres  retrieved successfully', 'results' => $results]);
    }

    public function getCounties()
    {
        $results =  County::all();
        return response()->json(["success" => true, 'query' => 'all counties', 'message' => 'Counties  retrieved successfully', 'results' => $results]);
    }


    public function getMdas()
    {
        $results =  MDA::all();
        return response()->json(["success" => true, 'query' => 'all mdas', 'message' => 'MDas  retrieved successfully', 'results' => $results]);
    }

    public function getMdaService($mda)
    {

        $mda =  MDA::find($mda);
        $services = $mda->services;
        return response()->json(["success" => true, 'query' => $mda->name, 'message' => 'Services for ' . $mda->name . '  retrieved successfully', 'results' => Service::collection($services)]);
    }

    public function getCenterServices($center)
    {
        $center = Centre::find($center);

        $services = $center->services;
        return response()->json(["success" => true, 'query' => $center->name, 'message' => 'Services for ' . $center->name . '  retrieved successfully', 'results' => Service::collection($services)]);
    }

    public function getTrendingServices()
    {
        $services =  \App\Service::inRandomOrder()->limit(6)->get();

        return response()->json(["success" => true, 'query' => 'trending services', 'message' => 'Trending services retrieved successfully', 'results' => Service::collection($services)]);
    }




    // search routes

    public function searchCentre(Request $request)
    {
        $q = $request->query('q');



        $results = Centre::where('name', '%' . $q . '%')->get();

        return response()->json(["success" => true, 'query' => $q,  'message' => 'Huduma Centers retrieved successfully', 'results' => $results]);
    }

    public function searchService(Request $request)
    {
        $q = $request->query('q');

        $results = \App\Service::where('servicename', '%' . $q . '%')->orWhere('details', 'LIKE', '%' . $q . '%')->get();

        return response()->json(["success" => true, 'query' => $q,  'message' => 'Huduma Centers retrieved successfully', 'results' => Service::collection($results)]);
    }


    public function searchMda(Request $request)
    {
        $q = $request->query('q');

        $results = MDA::where('name', 'LIKE',  '%' . $q . '%')->orWhere('code', 'LIKE', '%' . $q . '%')->get();

        return response()->json(["success" => true, 'query' => $q,  'message' => 'Huduma Centers retrieved successfully', 'results' => $results]);
    }
}
