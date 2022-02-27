<?php
namespace App\Repository;

use App\Model\Temperature;
use Illuminate\Support\Collection;

interface TemperatureRepositoryInterface
{
   public function all(): Collection;
}