<?php

namespace App\Http\Controllers\Api\V1\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Ticket::class);

        $query = Ticket::query()->with(['project', 'site', 'requester', 'assignee']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($priority = $request->input('priority')) {
            $query->where('priority', $priority);
        }

        if ($type = $request->input('type')) {
            $query->where('type', $type);
        }

        if ($siteId = $request->input('site_id')) {
            $query->where('site_id', $siteId);
        }

        $tickets = $query->paginate($request->integer('per_page', 20));

        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Ticket::class);

        $data = $request->validate([
            'project_id' => ['nullable', 'exists:projects,id'],
            'site_id' => ['nullable', 'exists:sites,id'],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'priority' => ['nullable', 'string', 'max:50'],
            'type' => ['nullable', 'string', 'max:50'],
            'requester_id' => ['nullable', 'exists:users,id'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'channel' => ['nullable', 'string', 'max:50'],
            'is_customer_visible' => ['nullable', 'boolean'],
            'metadata' => ['nullable', 'array'],
        ]);

        $data['number'] = $this->generateTicketNumber();

        /** @var \App\Models\Ticket $ticket */
        $ticket = Ticket::create($data);

        return response()->json([
            'data' => $ticket->fresh(['project', 'site', 'requester', 'assignee']),
        ], 201);
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return response()->json([
            'data' => $ticket->load(['project', 'site', 'requester', 'assignee']),
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $data = $request->validate([
            'project_id' => ['nullable', 'exists:projects,id'],
            'site_id' => ['nullable', 'exists:sites,id'],
            'subject' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
            'priority' => ['nullable', 'string', 'max:50'],
            'type' => ['nullable', 'string', 'max:50'],
            'requester_id' => ['nullable', 'exists:users,id'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'channel' => ['nullable', 'string', 'max:50'],
            'is_customer_visible' => ['nullable', 'boolean'],
            'metadata' => ['nullable', 'array'],
        ]);

        $ticket->update($data);

        return response()->json([
            'data' => $ticket->fresh(['project', 'site', 'requester', 'assignee']),
        ]);
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return response()->json([], 204);
    }

    protected function generateTicketNumber(): string
    {
        do {
            $number = 'T-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5));
        } while (Ticket::where('number', $number)->exists());

        return $number;
    }
}

