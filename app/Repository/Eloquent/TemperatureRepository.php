<?php

namespace App\Repository\Eloquent;

use App\Models\Temperature;
use App\Repository\TemperatureRepositoryInterface;
use Illuminate\Support\Collection;
use Auth;

class TemperatureRepository extends BaseRepository implements TemperatureRepositoryInterface
{

   /**
    * TemperatureRepository constructor.
    *
    * @param Temperature $model
    */
   public function __construct(Temperature $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   public function getTemperatureByUser() 
   {
        return Temperature::where('user_id', "=", Auth::id())->get();
   }

   public function getSortedTemperatureByUser() 
   {
        return Temperature::where('user_id', "=", Auth::id())
        ->orderBy('celcius', 'DESC')
        ->get();
   }
}