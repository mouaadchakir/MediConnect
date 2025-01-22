<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Carbon\Carbon;

class MessagesroomController extends Controller
{
    public function getallmessages_from_to($id_from, $id_to)
    {
        $allmessages_from = Message::where('id_to', $id_from)->where('id_from', $id_to)->orderBy('date', 'asc')->get();
        $allmessages_to = Message::where('id_to', $id_to)->where('id_from', $id_from)->orderBy('date', 'asc')->get();
        $trmps = [];
        foreach ($allmessages_from as $msg) {
            $trmps[] = [
                'text' => $msg->message,
                'type' => 'received',
                'time' => $msg->date,
            ];
        }
        foreach ($allmessages_to as $msg) {
            $trmps[] = [
                'text' => $msg->message,
                'type' => 'sent',
                'time' => $msg->date,
            ];
        }
        // sort by date
        usort($trmps, function($a, $b) {
            return $a['time'] <=> $b['time'];
        });
        return json_encode(['messages' => $trmps, 'id_user' => $id_from, 'id_doctor' => $id_to]);
    }

    public function sendmessage(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->id_from;
        $message->id_from = $request->id_from;
        $message->id_to = $request->id_to;
        $message->message = $request->message;
        $message->status = 'unread';
        $message->date = Carbon::now()->format('Y-m-d H:i:s.v');
        $message->save();
        return json_encode(['status' => 'success']);
    }
}
