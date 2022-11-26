<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function userCreate(Request $request)
    {
        try {
            $labels = [];
            $data = [];
            $from = $request->from??null;
            $to = $request->to??null;
            $userCreated = $this->userModel->getUserCreate($from, $to);

            foreach ($userCreated as $value) {
                $labels[] = $value->created_at;
                $data[] = $value->total;
            }
            return response()->json([
                'labels' => $labels,
                'data'  => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => "error!!!"], 400);
        }
    }
}
