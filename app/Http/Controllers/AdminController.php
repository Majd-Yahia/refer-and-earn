<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    const PER_PAGE = 15;

    public function admin()
    {
        $paginator = User::withCount(['referrers', 'points' => function($query) {
            return $query->select(DB::raw("SUM(points) as points"));
        }])->paginate(self::PER_PAGE);

        return view('pages.admin', ['paginator' => $paginator]);
    }
}
