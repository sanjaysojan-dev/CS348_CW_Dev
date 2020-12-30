<div id="message" x-data="{ showMessage: false, message: '' }" class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:p-6 sm:justify-end sm:p-20 ">
    <div  x-show="showMessage" class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
        <div class="rounded-lg shadow-xs overflow-hidden">
            <div x-show="showMessage">
                <div class="flex items-center px-2 py-3">
                    <svg class="h-6 w-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="mx-3">
                        <p class="text-gray-600" x-text="message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
