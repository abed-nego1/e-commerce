<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full inline-flex justify-center items-center px-4 py-3 bg-neutral-900 hover:bg-neutral-800 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg active:scale-[0.98] transition-all duration-150 ease-in-out focus:outline-none focus:ring-4 focus:ring-neutral-200']) }}>
    {{ $slot }}
</button>
