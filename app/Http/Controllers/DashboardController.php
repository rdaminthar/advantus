<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TemperatureRepositoryInterface;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private $temperature_repository;
    
    public function __construct(TemperatureRepositoryInterface $temperature_repository) {
        $this->middleware('auth');
        $this->temperature_repository = $temperature_repository;
    }

    public function dashboardView() {
        $temperature_details = $this->temperature_repository->getTemperatureByUser();
        
        return Inertia::render('Dashboard', ['temperatures'=>$temperature_details]);
    }

    public function temperatureSorted() {
        $sorted_temperature_details = $this->temperature_repository->getSortedTemperatureByUser();

        return response()->json(['temperatures'=>$sorted_temperature_details]);
    }
}
