<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    /**
     * Display a listing of agents.
     */
    public function index(Request $request)
    {
        $query = Agent::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agents = $query->latest()->paginate(15)->withQueryString();

        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new agent.
     */
    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created agent.
     */
    public function store(StoreAgentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('agents', 'public');
        }

        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['is_online'] = $request->boolean('is_online');

        Agent::create($data);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent created successfully.');
    }

    /**
     * Show the form for editing the specified agent.
     */
    public function edit(Agent $agent)
    {
        return view('admin.agents.edit', compact('agent'));
    }

    /**
     * Update the specified agent.
     */
    public function update(UpdateAgentRequest $request, Agent $agent)
    {
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($agent->avatar) {
                Storage::disk('public')->delete($agent->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('agents', 'public');
        }

        $data['is_online'] = $request->boolean('is_online');
        if (! empty($data['name'])) {
            $data['slug'] = $this->uniqueSlug($data['name'], $agent->id);
        }

        $agent->update($data);

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent updated successfully.');
    }

    /**
     * Remove the specified agent.
     */
    public function destroy(Agent $agent)
    {
        if ($agent->avatar) {
            Storage::disk('public')->delete($agent->avatar);
        }

        $agent->delete();

        return redirect()->route('admin.agents.index')
            ->with('success', 'Agent deleted successfully.');
    }

    /**
     * Build a unique slug from an agent name.
     */
    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'agent';
        $slug = $base;
        $i = 1;

        while (
            Agent::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}
