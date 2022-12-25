<?php

namespace App\Http\Controllers;

use App\Models\Referal;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    const PER_PAGE = 15;
    public function clients(Request $request)
    {
        $referrers = Auth::user()->referrers;
        $result = $this->flattenReferrers($referrers);
        $paginator = $this->customPaginator($result, 'clients');

        return view('pages.clients', ['paginator' => $paginator]);
    }

    public function dashboard()
    {
        $referals = Referal::where('user_id', Auth::id())->get();
        $chartData = $this->chartData();

        return view('pages.dashboard', [
            'user' => Auth::user(),
            'unique' => $referals->groupBy('ip')->count(),
            'total' => $referals->count(),
            'referals' => [
                'keys' => $chartData['data']->keys()->toArray(),
                'values' => $chartData['data']->values()->toArray(),
                'total' => $chartData['total'],
            ],
        ]);
    }


    private function flattenReferrers($referrers)
    {
        $result = collect([]);
        foreach ($referrers as $referrer) {
            $result->add($referrer);

            $children = $referrer->referrers;

            if ($children->count()) {

                $result = $result->merge($this->flattenReferrers($children));
            }
        }

        return $result;
    }

    private function customPaginator($items, $routeName)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentResults = $items->slice(($currentPage - 1) * self::PER_PAGE, self::PER_PAGE)->all();
        $paginator = new LengthAwarePaginator($currentResults, $items->count(), self::PER_PAGE);
        $paginator->setPath(route($routeName));

        return $paginator;
    }


    private function chartData()
    {
        $chartReferal = UserPoint::where('user_id', Auth::id())->whereBetween('created_at', [Carbon::now()->subWeek(2), Carbon::now()])->get()->groupBy(function ($record) {
            return Carbon::parse($record->created_at)->format('Y-m-d');
        })->map(function ($group) {
            return $group->pluck('points')->sum();
        });

        // $chart = Referal::where('user_id', Auth::id())->whereBetween('created_at', [Carbon::now()->subWeek(2), Carbon::now()])
        //     ->select(DB::raw("(count(*)) as count"), DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as date"))
        //     ->orderBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
        //     ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
        //     ->get();

        // dd($chartReferal, $chart->toArray());

        $now = Carbon::now();
        $twoWeeksBehind = Carbon::now()->subWeeks(2);

        $data = collect(range($twoWeeksBehind->timestamp, $now->timestamp, 86400))
            ->mapWithKeys(function ($timestamp) use ($chartReferal) {
                $date = Carbon::createFromTimestamp($timestamp)->format('Y-m-d');
                return [
                    $date => $chartReferal->has($date) ? $chartReferal->get($date) : 0
                ];
            });

        return [
            'data' => $data,
            'total' => $chartReferal->sum(),
        ];
    }
}
