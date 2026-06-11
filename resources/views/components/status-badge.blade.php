@props(['status', 'type' => 'invoice'])

@php
$colors = match($type) {
    'invoice' => match($status) {
        'draft' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 ring-gray-300 dark:ring-gray-600',
        'pending' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300 ring-yellow-300 dark:ring-yellow-600',
        'paid' => 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-300 ring-green-300 dark:ring-green-600',
        'overdue' => 'bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-300 ring-red-300 dark:ring-red-600',
        'cancelled' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 ring-gray-300 dark:ring-gray-600',
        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 ring-gray-300 dark:ring-gray-600',
    },
    'quote' => match($status) {
        'draft' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 ring-gray-300 dark:ring-gray-600',
        'sent' => 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 ring-blue-300 dark:ring-blue-600',
        'accepted' => 'bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-300 ring-green-300 dark:ring-green-600',
        'rejected' => 'bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-300 ring-red-300 dark:ring-red-600',
        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 ring-gray-300 dark:ring-gray-600',
    },
    default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 ring-gray-300 dark:ring-gray-600',
};

$icons = [
    'draft' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>',
    'pending' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'paid' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'overdue' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>',
    'cancelled' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
    'sent' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>',
    'accepted' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    'rejected' => '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
];
@endphp

<span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $colors }}">
    @if(isset($icons[$status]))
        {!! $icons[$status] !!}
    @endif
    {{ ucfirst($status) }}
</span>
