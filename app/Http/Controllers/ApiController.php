<?php

namespace App\Http\Controllers;

use App\Civil;
use App\Nrb;
use App\Ntsa;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function nrbsearch(Request $request)
    {
        $q = $request->query('q');

        $results = Nrb::where('id_no', $q)->get();

        return response()->json(["success" => true, 'query' => $q, 'message' => 'Nrb Records retrieved successfully', 'results' => $results]);
    }

    public function civilsearch(Request $request)
    {
        $q = $request->query('q');

        $results = Civil::where('phone',  $q)->get();

        return response()->json(["success" => true, 'query' => $q, 'message' => 'Civil Records retrieved successfully', 'results' => $results]);
    }

    public function ntsasearch(Request $request)
    {
        $q = $request->query('q');

        $results = Ntsa::where('id_no', $q)->get();

        return response()->json(["success" => true, 'query' => $q, 'message' => 'Ntsa Records retrieved successfully', 'results' => $results]);
    }
}
