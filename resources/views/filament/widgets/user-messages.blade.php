<x-filament-widgets::widget>
    <div class="space-y-4">

        @foreach ($messages as $message)

            @php
                $type = match ($message->type) {
                    'success' => [
                        'container' => 'border-success-300 bg-success-50 dark:border-success-700 dark:bg-success-950',
                        'icon' => 'text-success-600 dark:text-success-400',
                        'title' => 'text-success-800 dark:text-success-200',
                        'body' => 'text-success-700 dark:text-success-300',
                        'button' => 'bg-success-600 hover:bg-success-700 focus:ring-success-500',
                    ],

                    'warning' => [
                        'container' => 'border-warning-300 bg-warning-50 dark:border-warning-700 dark:bg-warning-950',
                        'icon' => 'text-warning-600 dark:text-warning-400',
                        'title' => 'text-warning-800 dark:text-warning-200',
                        'body' => 'text-warning-700 dark:text-warning-300',
                        'button' => 'bg-warning-600 hover:bg-warning-700 focus:ring-warning-500',
                    ],

                    'danger' => [
                        'container' => 'border-danger-300 bg-danger-50 dark:border-danger-700 dark:bg-danger-950',
                        'icon' => 'text-danger-600 dark:text-danger-400',
                        'title' => 'text-danger-800 dark:text-danger-200',
                        'body' => 'text-danger-700 dark:text-danger-300',
                        'button' => 'bg-danger-600 hover:bg-danger-700 focus:ring-danger-500',
                    ],

                    default => [
                        'container' => 'border-primary-300 bg-primary-50 dark:border-primary-700 dark:bg-primary-950',
                        'icon' => 'text-primary-600 dark:text-primary-400',
                        'title' => 'text-primary-800 dark:text-primary-200',
                        'body' => 'text-primary-700 dark:text-primary-300',
                        'button' => 'bg-primary-600 hover:bg-primary-700 focus:ring-primary-500',
                    ],
                };
            @endphp

            <div
                wire:key="message-{{ $message->id }}"
                class="rounded-xl border p-4 shadow-sm {{ $type['container'] }}"
            >
                <div class="flex items-start gap-4">

                    {{-- Icon --}}
                    <div class="mt-0.5 shrink-0 {{ $type['icon'] }}">
                        @if ($message->type === 'success')
                            <x-heroicon-o-check-circle class="h-6 w-6" />
                        @elseif ($message->type === 'warning')
                            <x-heroicon-o-exclamation-triangle class="h-6 w-6" />
                        @elseif ($message->type === 'danger')
                            <x-heroicon-o-x-circle class="h-6 w-6" />
                        @else
                            <x-heroicon-o-information-circle class="h-6 w-6" />
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="min-w-0 flex-1">

                        <h3
                            class="text-sm font-semibold {{ $type['title'] }}"
                        >
                            {{ $message->title }}
                        </h3>

                        <div
                            class="fi-prose mt-1 text-sm leading-6 {{ $type['body'] }}"
                        >
                            {!! $message->body !!}
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button
                                type="button"
                                wire:click="markAsRead({{ $message->id }})"
                                wire:loading.attr="disabled"
                                wire:target="markAsRead({{ $message->id }})"
                                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium text-white shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 {{ $type['button'] }}"
                            >
                                <span
                                    wire:loading.remove
                                    wire:target="markAsRead({{ $message->id }})"
                                >
                                    خواندم
                                </span>

                                <span
                                    wire:loading
                                    wire:target="markAsRead({{ $message->id }})"
                                    class="flex items-center gap-2"
                                >
                                    <svg
                                        class="h-4 w-4 animate-spin"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            class="opacity-25"
                                            cx="12"
                                            cy="12"
                                            r="10"
                                            stroke="currentColor"
                                            stroke-width="4"
                                        />

                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                        />
                                    </svg>

                                    در حال ثبت...
                                </span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
</x-filament-widgets::widget>