<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\User;
use Auth;
use App\TicketReply;
use App\Mail\SupportMailManager;
use Mail;
use App\Models\Xztcart;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(9);
        $orders = Xztcart::where('user_id', Auth::user()->id)->get();
        return view('frontend.user.support_ticket.index', compact('tickets', 'orders'));
    }

    public function admin_index(Request $request)
    {
        $sort_search =null;
        $tickets = Ticket::with("user")->orderBy('created_at', 'desc')->whereHas("user");
        if ($request->has('search')){
            $sort_search = $request->search;
            $tickets = $tickets->where('code', 'like', '%'.$sort_search.'%');
        }
        $tickets = $tickets->paginate(15);
        return view('backend.support.support_tickets.index', compact('tickets', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->has('service_req')){
            $upd = Ticket::where('code', $request->ticket_number)->first();
            $upd->service_date = date("Y-m-d", strtotime($request->d_o_s));
            $upd->service_time = $request->t_o_s;
            $upd->service_desc = $request->service_desc;
            $upd->service_addr = $request->service_addr;
            $upd->save();
            return redirect()->route('support_ticket.index');
        }
        $ticket = new Ticket;
        // $ticket->code = max(100000, (Ticket::latest()->first() != null ? Ticket::latest()->first()->code + 1 : 0)).date('s');
        $ticket->code = Auth::user()->id.'-'.time();
        $ticket->user_id = Auth::user()->id;
        $ticket->subject = $request->subject;
        $ticket->details = $request->details;
        $ticket->order_number = $request->order_number;
        // $ticket->files = $request->attachments;
        
        if($ticket->save()){
            if($request->has('photo_defective')) {
                $file = $request->file('photo_defective');
                $name = $file->getClientOriginalName();
                $name = $ticket->id.'-'.$name;
                $file->move(public_path().'/tickets/images/', $name); 
                $rec = Ticket::where('id', $ticket->id)->first();
                $rec->files = $name;
                $rec->save();
            }
        
            $this->send_support_mail_to_admin($ticket);
            //flash(translate('Ticket has been sent successfully'))->success();
            return redirect()->route('support_ticket.index');
        }
        else{
            //flash(translate('Something went wrong'))->error();
        }
    }

    public function send_support_mail_to_admin($ticket){
        $array['view'] = 'emails.support';
        $array['subject'] = 'Support ticket Code is:- '.$ticket->code;
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Hi. A ticket has been created. Please check the ticket.';
        $array['link'] = route('support_ticket.admin_show', encrypt($ticket->id));
        $array['sender'] = $ticket->user->name;
        $array['details'] = $ticket->details;

        // dd($array);
        // dd(User::where('user_type', 'admin')->first()->email);
        try {
            Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new SupportMailManager($array));
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }
    }

    public function send_support_reply_email_to_user($ticket, $tkt_reply){
        $array['view'] = 'emails.support';
        $array['subject'] = 'Support ticket Code is:- '.$ticket->code;
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Hi. A ticket has been created. Please check the ticket.';
        $array['link'] = route('support_ticket.show', encrypt($ticket->id));
        $array['sender'] = $tkt_reply->user->name;
        $array['details'] = $tkt_reply->reply;

        try {
            Mail::to($ticket->user->email)->queue(new SupportMailManager($array));
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }
    }

    public function admin_store(Request $request)
    {
        // dd($request);
        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = Auth::user()->id;
        $ticket_reply->reply = $request->reply;
        $ticket_reply->files = $request->attachments;
        $ticket_reply->ticket->client_viewed = 0;
        
        $new_status = '';
        if($request->has('openBtn')) {
            $new_status = 'open';
        }else if($request->has('solveBtn')) {
            $new_status = 'solved';
        }else if($request->has('viewBtn')) {
            $new_status = 'pending';
        }
        $ticket_reply->ticket->save();

        $rec = Ticket::find($request->ticket_id);
        $rec->tic_status = $new_status;
        $rec->save();

        if($ticket_reply->save()){
            //flash(translate('Reply has been sent successfully'))->success();
            $this->send_support_reply_email_to_user($ticket_reply->ticket, $ticket_reply);
            return back();
        }
        else{
            //flash(translate('Something went wrong'))->error();
        }
    }

    public function seller_store(Request $request)
    {
        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = $request->user_id;
        $ticket_reply->reply = $request->reply;
        $ticket_reply->files = $request->attachments;
        $ticket_reply->ticket->viewed = 0;
        $ticket_reply->ticket->status = 'pending';
        $ticket_reply->ticket->save();
        if($ticket_reply->save()){
            if($request->has('photo_defective')) {
                $file = $request->file('photo_defective');
                $name = $file->getClientOriginalName();
                $name = $ticket_reply->id.'-'.$name;
                $file->move(public_path().'/uploads/tickets/', $name); 
                $rec = Ticket::where('id', $ticket_reply->id)->first();
                $rec->files = $name;
                $rec->save();
            }

            //flash(translate('Reply has been sent successfully'))->success();
            return back();
        }
        else{
            //flash(translate('Something went wrong'))->error();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail(decrypt($id));
        $ticket->client_viewed = 1;
        $ticket->save();
        $ticket_replies = $ticket->ticketreplies;
        $ticket_info = Ticket::where('id', $ticket->id)->first();
        return view('frontend.user.support_ticket.show', compact('ticket','ticket_replies', 'ticket_info'));
    }

    public function admin_show($id)
    {
        $ticket = Ticket::findOrFail(decrypt($id));
        $ticket->viewed = 1;
        // $ticket->tic_status = 'viewed';
        $ticket->save();
        $ticket_info = Ticket::where('id', $ticket->id)->first();
        return view('backend.support.support_tickets.show', compact('ticket', 'ticket_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function show_files($file_name) {
        $file_path = public_path('/tickets/images/'.$file_name);
        return response()->download($file_path);
    }
}
