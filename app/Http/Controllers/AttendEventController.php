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

        /***
         * Consulta en SQL
         * SELECT * FROM event_and_users 
         * INNER JOIN events ON events_id = events.id 
         * INNER JOIN users ON users_id = users.id 
         * WHERE events_id = 4
         */

        $event = Event::find($id);
        $user= User::all();

        $attend = EventAndUser::select('users_id','users.email', 'users.name', 'users.email','events.nombre','event_and_users.created_at','event_and_users.updated_at')
            ->join('users', 'users.id','=','event_and_users.users_id')
            ->join('events', 'events.id','=','event_and_users.events_id')
            ->where('events_id',$event->id)->get();

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
