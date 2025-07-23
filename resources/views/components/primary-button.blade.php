<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-gradient-to-r from-indigo-500 via-blue-500 to-pink-500 hover:from-indigo-600 hover:via-blue-600 hover:to-pink-600 text-white py-3 px-4 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center']) }}>
    {{ $slot }}
</button>



{{-- 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150' --}}
