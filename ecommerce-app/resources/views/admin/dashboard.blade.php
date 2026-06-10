@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('admin.partials.page-header', ['title' => 'Dashboard', 'breadcrumb' => 'Dashboard v3'])

{{-- Stat boxes --}}
<div class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
  @foreach ([
    ['label' => 'Total Products', 'value' => $stats['products'], 'icon' => 'box', 'color' => 'bg-admin-primary', 'change' => '+4'],
    ['label' => 'Orders', 'value' => $stats['orders'], 'icon' => 'clipboard', 'color' => 'bg-admin-success', 'change' => '+12%'],
    ['label' => 'Customers', 'value' => $stats['customers'], 'icon' => 'users', 'color' => 'bg-admin-warning', 'change' => '+8%'],
    ['label' => 'Revenue', 'value' => '$'.number_format($stats['revenue'], 0), 'icon' => 'dollar', 'color' => 'bg-admin-danger', 'change' => '+33%'],
  ] as $stat)
    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
      <div class="flex items-center p-4">
        <div class="flex h-12 w-12 items-center justify-center rounded {{ $stat['color'] }} text-white">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
        </div>
        <div class="ml-4">
          <p class="text-xs uppercase text-slate-500">{{ $stat['label'] }}</p>
          <p class="text-xl font-bold text-slate-800">{{ $stat['value'] }}</p>
        </div>
      </div>
      <div class="border-t border-slate-100 bg-slate-50 px-4 py-2 text-xs text-slate-500">
        <span class="text-admin-success font-semibold">{{ $stat['change'] }}</span> since last month
      </div>
    </div>
  @endforeach
</div>

<div class="grid gap-6 lg:grid-cols-2">
  {{-- Visitors chart --}}
  <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
      <h3 class="font-semibold text-slate-800">Online Store Visitors</h3>
      <a href="#" class="text-sm text-admin-primary hover:underline">View Report</a>
    </div>
    <div class="p-4">
      <div class="mb-4 flex items-end justify-between">
        <div>
          <p class="text-3xl font-bold text-slate-800">{{ number_format($stats['visitors']) }}</p>
          <p class="text-sm text-slate-500">Visitors Over Time</p>
        </div>
        <div class="text-right">
          <p class="text-sm font-semibold text-admin-success">↑ 12.5%</p>
          <p class="text-xs text-slate-400">Since last week</p>
        </div>
      </div>
      <canvas id="visitorsChart" height="120"></canvas>
    </div>
  </div>

  {{-- Sales chart --}}
  <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
      <h3 class="font-semibold text-slate-800">Sales</h3>
      <a href="#" class="text-sm text-admin-primary hover:underline">View Report</a>
    </div>
    <div class="p-4">
      <div class="mb-4 flex items-end justify-between">
        <div>
          <p class="text-3xl font-bold text-slate-800">${{ number_format($stats['revenue'], 2) }}</p>
          <p class="text-sm text-slate-500">Sales Over Time</p>
        </div>
        <div class="text-right">
          <p class="text-sm font-semibold text-admin-success">↑ 33.1%</p>
          <p class="text-xs text-slate-400">Since last month</p>
        </div>
      </div>
      <canvas id="salesChart" height="120"></canvas>
    </div>
  </div>
</div>

<div class="mt-6 grid gap-6 lg:grid-cols-2">
  {{-- Contact Messages --}}
  <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
      <h3 class="font-semibold text-slate-800">Contact Messages</h3>
      <a href="{{ route('admin.messages.index') }}" class="text-sm text-admin-primary hover:underline">View All</a>
    </div>
    <div class="p-4">
      @if ($unreadMessages > 0)
        <p class="mb-3 rounded-lg bg-amber-50 px-3 py-2 text-sm text-amber-800">{{ $unreadMessages }} unread message(s)</p>
      @endif
      <ul class="divide-y divide-slate-100">
        @forelse ($recentMessages as $msg)
          <li class="flex items-center justify-between py-3">
            <div class="min-w-0 flex-1">
              <p class="truncate text-sm font-medium text-slate-800">{{ $msg->name }}</p>
              <p class="truncate text-xs text-slate-500">{{ Str::limit($msg->message, 50) }}</p>
            </div>
            <div class="ml-3 flex shrink-0 items-center gap-2">
              <span class="rounded-full px-2 py-0.5 text-[10px] font-semibold {{ $msg->status === 'unread' ? 'bg-amber-100 text-amber-700' : 'bg-green-100 text-green-700' }}">{{ $msg->status }}</span>
              <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-xs text-admin-primary hover:underline">Show</a>
            </div>
          </li>
        @empty
          <li class="py-6 text-center text-sm text-slate-500">No messages yet.</li>
        @endforelse
      </ul>
    </div>
  </div>

  {{-- Products table --}}
  <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
      <h3 class="font-semibold text-slate-800">Products</h3>
      <div class="flex gap-1">
        <button type="button" class="rounded p-1 text-slate-400 hover:bg-slate-100"><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg></button>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="border-b border-slate-100 bg-slate-50 text-left text-xs uppercase text-slate-500">
          <tr>
            <th class="px-4 py-3">Product</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Sales</th>
            <th class="px-4 py-3"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @foreach ($topProducts as $product)
            <tr class="hover:bg-slate-50">
              <td class="px-4 py-3">
                <div class="flex items-center gap-3">
                  <img src="{{ $product->image }}" alt="" class="h-8 w-8 rounded-full object-cover">
                  <span class="font-medium text-slate-800">{{ $product->name }}</span>
                  @if ($product->is_new)
                    <span class="rounded bg-admin-danger px-1.5 py-0.5 text-[10px] font-bold text-white">NEW</span>
                  @endif
                </div>
              </td>
              <td class="px-4 py-3 text-slate-600">{{ $product->formattedPrice() }}</td>
              <td class="px-4 py-3">
                <span class="text-admin-success">↑</span>
                <span class="text-slate-600">{{ rand(50, 500) }} Sold</span>
              </td>
              <td class="px-4 py-3">
                <button type="button" class="text-slate-400 hover:text-admin-primary">
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- Store overview --}}
  <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
    <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3">
      <h3 class="font-semibold text-slate-800">Online Store Overview</h3>
    </div>
    <div class="divide-y divide-slate-100">
      @foreach ([
        ['icon' => 'refresh', 'color' => 'text-admin-success bg-green-100', 'text' => '↑ 12% CONVERSION RATE'],
        ['icon' => 'cart', 'color' => 'text-yellow-700 bg-yellow-100', 'text' => '↑ 0.8% SALES RATE'],
        ['icon' => 'users', 'color' => 'text-admin-danger bg-red-100', 'text' => '↓ 1% REGISTRATION RATE'],
      ] as $item)
        <div class="flex items-center gap-4 px-4 py-4">
          <div class="flex h-10 w-10 items-center justify-center rounded-full {{ $item['color'] }}">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          </div>
          <span class="text-sm font-medium text-slate-700">{{ $item['text'] }}</span>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
  const chartDefaults = { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } } };

  new Chart(document.getElementById('visitorsChart'), {
    type: 'line',
    data: {
      labels: ['18th','20th','22nd','24th','26th','28th','30th'],
      datasets: [
        { label: 'This Week', data: [65,78,90,81,95,88,102], borderColor: '#007bff', backgroundColor: 'rgba(0,123,255,0.1)', fill: true, tension: 0.4 },
        { label: 'Last Week', data: [45,55,60,58,62,70,75], borderColor: '#ced4da', borderDash: [5,5], fill: false, tension: 0.4 }
      ]
    },
    options: { ...chartDefaults, scales: { y: { display: false }, x: { grid: { display: false } } } }
  });

  new Chart(document.getElementById('salesChart'), {
    type: 'bar',
    data: {
      labels: ['JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
      datasets: [
        { label: 'This year', data: [12000,15000,11000,18000,14000,16000,18230], backgroundColor: '#007bff' },
        { label: 'Last year', data: [9000,11000,10000,13000,12000,14000,15000], backgroundColor: '#dee2e6' }
      ]
    },
    options: { ...chartDefaults, scales: { y: { display: false }, x: { grid: { display: false } } } }
  });
</script>
@endpush
