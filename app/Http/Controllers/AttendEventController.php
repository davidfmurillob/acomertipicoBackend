<?php

namespace App\Http\Controllers;

use App\Models\EventAndUser;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class AttendEventController extends Controller
{
    public function AsistirEvento(Request $request){

        $record = new EventAndUser();
        $record->asistencia = $request ->asistencia;
        $record->users_id = $request ->users_id;
        $record->events_id = $request ->events_id;

        $record->save();

        return response()->json([
            'status' => 200,
            'info' => 'Te has salvado',
            'message' =>'Asistencia Confirmada!!',
            'data' => $record
        ]);
    }

    public function ListarAsistencia(Request $request, $id){

        $event = Event::find($id);
        $user= User::all();

        $attend = EventAndUser::select('asistencia','users_id')
            ->join('users', 'users.id','=','users.users_id')
            ->join('events', 'events.id','=','events.events_id')
            ->where('events.id',$event->id)->get();

        return response()->json([
            'status' => 200,
            'asistencia' => $attend,
            'event' => $event
        ]);
    }
}
