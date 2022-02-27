<?php
namespace App\Repository;

use App\Model\City;
use Illuminate\Support\Collection;

interface CityRepositoryInterface
{
   public function all(): Collection;
}