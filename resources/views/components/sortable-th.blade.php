<th scope="col" class="pb-3 font-medium">
    @php
        $isSorted = request('sort') === $field;
        $nextDirection = $isSorted && request('direction') === 'asc' ? 'desc' : 'asc';
        $query = array_merge(request()->query(), ['sort' => $field, 'direction' => $nextDirection]);
    @endphp
    <a href="{{ route($route, $query) }}" class="inline-flex items-center gap-1 hover:text-gray-700 dark:hover:text-gray-200 transition-colors">
        {{ $label }}
        @if($isSorted)
            <svg class="w-3 h-3 {{ request('direction') === 'asc' ? '' : 'rotate-180' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
            </svg>
        @endif
    </a>
</th>
