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

        $attend = EventAndUser::select('asistencia','users_id','users.email')
            ->join('users', 'users.id','=','event_and_users.users_id')
            ->join('events', 'events.id','=','event_and_users.events_id')
            ->where('events.id',$event->id)->get();

        return response()->json([
            'status' => 200,
            'asistencia' => $attend,
            'event' => $event
        ]);
    }

    public function destroy($id){

        $event = EventAndUser::findOrfail($id);
        $event->delete();

         return response()->json([
            'status' => 200,
            'info' => "Eliminado correctamente"

        ]);

    }
}
