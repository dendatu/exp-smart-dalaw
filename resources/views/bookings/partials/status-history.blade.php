@if($booking->statusHistory->isNotEmpty())
    <section class="mt-5 rounded-lg border border-slate-200 bg-white p-5" aria-labelledby="status-history-heading">
        <h2 id="status-history-heading" class="text-sm font-semibold text-slate-900">Status history</h2>
        <ol class="mt-4 space-y-4">
            @foreach($booking->statusHistory as $history)
                <li class="border-l-2 border-slate-200 pl-4">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-3 gap-y-1">
                        <p class="text-sm font-semibold text-slate-900">
                            @if($history->from_status)
                                {{ $history->from_status }} <span aria-hidden="true">&rarr;</span>
                            @elseif($history->reason === 'Booking request submitted.')
                                Booking submitted <span aria-hidden="true">&rarr;</span>
                            @else
                                Status recorded <span aria-hidden="true">&rarr;</span>
                            @endif
                            {{ $history->to_status }}
                        </p>
                        <time class="text-xs text-slate-500" datetime="{{ $history->created_at->toIso8601String() }}">{{ $history->created_at->format('M d, Y g:i A') }}</time>
                    </div>
                    <p class="mt-1 text-sm leading-6 text-slate-600">{{ $history->reason }}</p>
                    @if($history->changedBy)
                        <p class="mt-1 text-xs text-slate-500">Updated by {{ $history->changedBy->name }}</p>
                    @endif
                </li>
            @endforeach
        </ol>
    </section>
@elseif($booking->admin_remarks)
    <aside class="mt-5 rounded-lg border border-slate-200 bg-white p-5">
        <h2 class="text-sm font-semibold text-slate-900">Facility remarks</h2>
        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $booking->admin_remarks }}</p>
    </aside>
@endif