<div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
                <p class="text-sm text-gray-400">Manage Your Community</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="search" placeholder="Search" class="w-64 rounded-md bg-gray-900 px-4 py-2 pl-10 text-sm text-white placeholder-gray-500">
                    <div class="absolute left-3 top-2.5 h-4 w-4 text-gray-500">
                        <div class="h-3 w-3 rounded-full border-2 border-current"></div>
                        <div class="absolute right-0 top-2 h-2 w-2 rotate-45 border-r-2 border-current"></div>
                    </div>
                </div>
                <div class="h-8 w-8 rounded-full bg-gray-800"></div>
                <div class="h-8 w-8 rounded-full bg-gray-700"></div>
            </div>
        </div>

        <div class="mb-8 grid grid-cols-4 gap-4">
            <div class="rounded-lg bg-gray-900 p-4">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm text-gray-400">Total Users</span>
                    <div class="h-1 w-1 rounded-full bg-gray-700"></div>
                </div>
                <div class="text-2xl font-bold">10,483</div>
            </div>
            <div class="rounded-lg bg-gray-900 p-4">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm text-gray-400">Daily Entries</span>
                    <div class="h-1 w-1 rounded-full bg-gray-700"></div>
                </div>
                <div class="text-2xl font-bold text-green-500">1,234</div>
            </div>
            <div class="rounded-lg bg-gray-900 p-4">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm text-gray-400">Badges Awarded</span>
                    <div class="h-1 w-1 rounded-full bg-gray-700"></div>
                </div>
                <div class="text-2xl font-bold text-yellow-500">89</div>
            </div>
            <div class="rounded-lg bg-gray-900 p-4">
                <div class="mb-2 flex items-center justify-between">
                    <span class="text-sm text-gray-400">Top Voted Entry</span>
                    <div class="h-1 w-1 rounded-full bg-gray-700"></div>
                </div>
                <div class="text-2xl font-bold text-purple-500">2,345</div>
            </div>
        </div>

        <div class="mb-8 rounded-lg bg-gray-900 p-4">
            <h2 class="mb-4 text-lg font-bold">Create Prompt / Word of the Day</h2>
            <div class="flex gap-4">
                <input type="text" placeholder="Enter prompt or word" class="flex-1 rounded-md bg-gray-800 px-4 py-2 text-white">
                <button class="rounded-md bg-indigo-600 px-4 py-2 text-white">Create</button>
            </div>
        </div>

        <div class="mb-8 rounded-lg bg-gray-900 p-4">
            <h2 class="mb-4 text-lg font-bold">User Entries</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                    <div>
                        <div class="font-medium">John Doe</div>
                        <div class="text-sm text-gray-400">Today's prompt inspired me to reflect on gratitude...</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-400">Votes: 245</span>
                        <button class="rounded bg-yellow-600 px-2 py-1 text-xs">Award Badge</button>
                    </div>
                </div>
                <div class="flex items-center justify-between border-b border-gray-800 pb-2">
                    <div>
                        <div class="font-medium">Jane Smith</div>
                        <div class="text-sm text-gray-400">The word 'serendipity' reminds me of a time when...</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-400">Votes: 189</span>
                        <button class="rounded bg-yellow-600 px-2 py-1 text-xs">Award Badge</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-gray-900 p-4">
            <h2 class="mb-4 text-lg font-bold">Community Activity</h2>
            <canvas id="activityChart" width="400" height="200"></canvas>
        </div>