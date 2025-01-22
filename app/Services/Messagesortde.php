<?php

namespace App\Services;

use App\Models\Message;
use App\Models\Doctor;
use App\Models\Data_user;
use Illuminate\Support\Facades\Auth;

class Messagesortde
{
    public function sortMessages()
    {
        $allmessages = Message::where('id_to', Auth::id())->orWhere('id_from', Auth::id())->orderBy('date', 'desc')->get(['id_to', 'id_from']);
        $allIds = array_merge(array_column($allmessages->toArray(), 'id_to'), array_column($allmessages->toArray(), 'id_from'));
        $allIds = array_values(array_diff(array_unique($allIds), [Auth::id()]));
        $finalGroup_read = [];
        $finalGroup_unread = [];
        foreach ($allIds as $id) {
            $trmps = [];
            $lastMessage = Message::where('id_to', Auth::id())->where('id_from', $id)->orWhere('id_to', $id)->where('id_from', Auth::id())->orderBy('date', 'asc')->get();
            foreach ($lastMessage as $msg) {
                $trmps[] = [
                    'created_by' => $msg->id_from == Auth::id() ? 'me' : 'other',
                    'message' => $msg->message,
                    'status' => $msg->status,
                    'date' => $msg->date,
                ];
            }
            if ($lastMessage->last()->status == "unread" && $lastMessage->last()->id_to == Auth::id()) { $finalGroup_unread[] = $trmps; }
            else { $finalGroup_read[] = $trmps; }
        }
        return json_encode(['read' => $finalGroup_read, 'unread' => $finalGroup_unread]);
    }

    public function sortMessageslasetes()
    {
        $allmessages = Message::where('id_to', Auth::id())->orWhere('id_from', Auth::id())->orderBy('date', 'desc')->get(['id_to', 'id_from']);
        $allIds = array_merge(array_column($allmessages->toArray(), 'id_to'), array_column($allmessages->toArray(), 'id_from'));
        $allIds = array_values(array_diff(array_unique($allIds), [Auth::id()]));
        $finalGroup_read = [];
        $finalGroup_unread = [];
        foreach ($allIds as $id) {
            $trmps = [];
            if (Auth::user()->role == 'user') {
              $imageProfile = Doctor::where('user_id', $id)->get('image')->first()->image ?? '';
              $nameProfile = Doctor::where('user_id', $id)->get('name')->first()->name ?? '';
            } else {
              $imageProfile = Data_user::where('user_id', $id)->get('image')->first()->image ?? '';
              $nameProfile = Data_user::where('user_id', $id)->get('name')->first()->name ?? '';
            }
            $lastMessage = Message::where('id_to', Auth::id())->where('id_from', $id)->orWhere('id_to', $id)->where('id_from', Auth::id())->orderBy('date', 'asc')->get();
            foreach ($lastMessage as $msg) {
                $trmps[] = [
                    'created_by' => $msg->id_from == Auth::id() ? 'me' : 'other',
                    'id' => $id,
                    'name' => $nameProfile,
                    'image' => $imageProfile,
                    'message' => $msg->message,
                    'status' => $msg->status == "unread" && $msg->id_to == Auth::id() ? 'unread' : 'read',
                    'date' => $msg->date,
                    'coundtmessages' => Message::where('id_to', Auth::id())->where('id_from', $msg->id_from)->where('status', 'unread')->count(),
                ];
            }
            if ($lastMessage->last()->status == "unread" && $lastMessage->last()->id_to == Auth::id()) { $finalGroup_unread[] = end($trmps); }
            else { $finalGroup_read[] = end($trmps); }
        }
        return json_encode(['read' => $finalGroup_read, 'unread' => $finalGroup_unread]);
    }

    public function get_all_messages_doctor($id)
    {
        Message::where('id_to', Auth::id())->where('id_from', $id)->where('status', 'unread')->update(['status' => 'read']);
        $allmessages = Message::where('id_to', Auth::id())->where('id_from', $id)->orWhere('id_to', $id)->where('id_from', Auth::id())->orderBy('date', 'asc')->get();
        $trmps = [];
        foreach ($allmessages as $msg) {
            $trmps[] = [
                'text' => $msg->message,
                'type' => $msg->id_from == Auth::id() ? 'sent' : 'received',
                'time' => $msg->date,
            ];
        }
        return json_encode(['messages' => $trmps, 'id_user' => Auth::id(), 'id_doctor' => $id]);
    }

    public function get_all_messages_user($id)
    {
        Message::where('id_to', Auth::id())->where('id_from', $id)->where('status', 'unread')->update(['status' => 'read']);
        $allmessages = Message::where('id_to', Auth::id())->where('id_from', $id)->orWhere('id_to', $id)->where('id_from', Auth::id())->orderBy('date', 'asc')->get();
        $trmps = [];
        foreach ($allmessages as $msg) {
            $trmps[] = [
                'text' => $msg->message,
                'type' => $msg->id_from == Auth::id() ? 'sent' : 'received',
                'time' => $msg->date,
            ];
        }
        return json_encode(['messages' => $trmps, 'id_user' => Auth::id(), 'id_doctor' => $id]);
    }
}
