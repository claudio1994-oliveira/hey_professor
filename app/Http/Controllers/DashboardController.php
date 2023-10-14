<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {

        return view('dashboard', [
            'questions' => Question::withSum('votes', 'like')
                ->when(request('search'), function (Builder $query) {
                    $query->where('question', 'like', '%' . request('search') . '%');
                })
                ->withSum('votes', 'unlike')
                ->orderByRaw('
                    case when votes_sum_like is null then 0 else votes_sum_like end desc,
                    case when votes_sum_unlike is null then 0 else votes_sum_unlike end')
                ->paginate(5),
        ]);
    }
}
