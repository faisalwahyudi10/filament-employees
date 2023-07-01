<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;

use App\Models\Country;
use App\Models\Employee;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Facades\DB;

class EmployeeChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $country = Country::all();

        $months = collect(range(1, 12))->map(function ($month) {
            return ['month' => $month];
        });
        $results = [];
        foreach ($country as $value) {
            $employeeCounts = DB::table('employees')
                ->select(DB::raw('MONTH(date_hired) AS month'), DB::raw('COUNT(*) AS employee_count'))
                ->where('country_id', $value->id)
                ->whereYear('date_hired', date('Y'))
                ->groupBy(DB::raw('MONTH(date_hired)'))
                ->get()
                ->keyBy('month');

            $results = $months->map(function ($month) use ($employeeCounts) {
                $month['employee_count'] = $employeeCounts->get($month['month'], 0);
                return $month;
            });

        }

        dd($results);

        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
                [
                    'label' => 'Blog posts created',
                    'data' => [10, 40, 5, 22, 21, 12, 5, 64, 25, 45, 77, 19],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
