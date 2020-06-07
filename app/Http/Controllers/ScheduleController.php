<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Repositories\Schedule\ScheduleRepositoryInterface;
use Faker\Provider\Base;
use Illuminate\Http\Request;

class ScheduleController extends BaseController
{
    protected $schedule_start;
    protected $schedule_end;
    protected $schedule;

    public function __construct(ScheduleRepositoryInterface $schedule)
    {
        parent::__construct();
        $this->schedule_end = [];
        $this->schedule_start = [];
        $this->schedule = $schedule;
    }

    public function index(){

        $schedules = $this->schedule->getByCommerceId($this->user->commerce->id);

        $schedule_start = count($schedules) === 2 ? $schedules[0] : null ;
        $schedule_end = count($schedules) === 2 ? $schedules[1] : null ;

        return view('schedule.index', compact('schedule_start', 'schedule_end'));
    }

    public function store(Request $request){
        //obtenemos los horarios
        $schedules = $this->schedule->getByCommerceId($this->user->commerce->id);

        //procesamos los request
        $requests = $request->all();
        array_walk($requests, array($this, 'processItem'));

        // si ya existen los horarios simplemente los actualizamos de lo contrario los creamos
        count($schedules) ? $this->updateSchedules($schedules) : $this->storeSchedules();

        return redirect()->route('schedule.index')->with('success', __('Se ha guardado correctamente'));
    }

    private function updateSchedules($schedules){
        if (count($schedules) === 2){
            $this->schedule->update($this->schedule_start, $schedules[0]->id);
            $this->schedule->update($this->schedule_end, $schedules[1]->id);
        }
    }

    private function storeSchedules(){

        //complementamos los datos con el commercio id
        $this->schedule_start["commerce_id"] =  $this->user->commerce->id;

        //complementamos los dtos con el commercio id y la variables de is_starting en falso
        $this->schedule_end["commerce_id"] = $this->user->commerce->id ;
        $this->schedule_end['is_starting'] = false;

        //guardamos los datos
        $this->schedule->create($this->schedule_start);
        $this->schedule->create($this->schedule_end);
    }

    private function processItem($value, $column){
        try {

            list($time, $column) = explode('_',  $column);

            if ($time == "start") {
                $this->schedule_start[$column] =  $value ;
            }
            if ($time == "end"){
                $this->schedule_end[$column] =  $value ;
            }
        }catch (\Exception $e){}

    }

}
