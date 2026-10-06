@extends('layouts.admin')

@section('title', 'Visit Calendar | SmartDalaw')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase text-[#0A2472]">Visit schedule</p>
            <h1 class="mt-1 text-2xl font-bold text-[#102044]">{{ $monthLabel }}</h1>
            <p class="mt-2 text-sm text-slate-600">{{ $visits->count() }} visits shown in this calendar view. Select a visit to edit its details.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.calendar', ['month' => $previousMonth]) }}" aria-label="Previous month" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-slate-300 bg-white text-slate-700 hover:bg-slate-50">&larr;</a>
            <a href="{{ route('admin.calendar') }}" class="inline-flex h-10 items-center justify-center rounded-md border border-slate-300 bg-white px-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Today</a>
            <a href="{{ route('admin.calendar', ['month' => $nextMonth]) }}" aria-label="Next month" class="inline-flex h-10 w-10 items-center justify-center rounded-md border border-slate-300 bg-white text-slate-700 hover:bg-slate-50">&rarr;</a>
        </div>
    </div>

    <div class="mt-7 overflow-x-auto border border-slate-200 bg-white">
        <div class="min-w-[720px]">
            <div class="grid grid-cols-7 border-b border-slate-200 bg-slate-50">
                @foreach(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $weekday)
                    <div class="px-2 py-3 text-center text-xs font-semibold uppercase text-slate-500">{{ $weekday }}</div>
                @endforeach
            </div>
            <div class="grid grid-cols-7">
                @foreach($calendarDays as $calendarDay)
                    <section class="min-h-32 border-b border-r border-slate-200 p-1.5 sm:min-h-40 sm:p-2 {{ $calendarDay['inMonth'] ? 'bg-white' : 'bg-slate-50/70' }}">
                        <h2 class="mb-1 flex items-center justify-between text-xs font-semibold {{ $calendarDay['inMonth'] ? 'text-slate-800' : 'text-slate-400' }}">
                            <span>{{ $calendarDay['date']->format('j') }}</span>
                            @if($calendarDay['visits']->isNotEmpty())
                                <span class="text-[10px] font-medium text-slate-500">{{ $calendarDay['visits']->count() }}</span>
                            @endif
                        </h2>
                        <div class="grid gap-1">
                            @foreach($calendarDay['visits'] as $visit)
                                <a href="{{ route('admin.bookings.edit', $visit) }}" class="block min-w-0 rounded border px-1.5 py-1 text-[10px] leading-4 hover:ring-1 hover:ring-[#0A2472] sm:px-2 {{ $visit->status === 'Approved' ? 'border-emerald-200 bg-emerald-50 text-emerald-950' : ($visit->status === 'Rejected' ? 'border-red-200 bg-red-50 text-red-950' : 'border-amber-200 bg-amber-50 text-amber-950') }}">
                                    <span class="block truncate font-semibold">{{ $visit->time_slot }}</span>
                                    <span class="block truncate">{{ $visit->reference_code }}</span>
                                    <span class="block truncate">{{ $visit->visitor_full_name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-4 flex flex-wrap gap-4 text-xs text-slate-600" aria-label="Booking status legend">
        <span class="inline-flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>Pending</span>
        <span class="inline-flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-emerald-500"></span>Approved</span>
        <span class="inline-flex items-center gap-2"><span class="h-2.5 w-2.5 rounded-full bg-red-500"></span>Rejected</span>
    </div>
@endsection