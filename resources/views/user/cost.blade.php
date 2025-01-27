<x-app-layout>
    <div class="flex" style="height: 100vh;">
        <!-- Sidebar -->
        <nav class="bg-[#2e7d32] dark:bg-[#1b5e20]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Cost</h3>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka-Opt') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-home me-2"></i>  <!-- Updated icon for Cost -->
                        {{ __('Cost') }}
                    </a>
                </li>
                <!-- New Appliance Link -->
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
            </ul>
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Main Content -->
        <div class="flex-grow p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
        <div class="container bg-white rounded shadow-lg p-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-[#2e7d32]">Cost Dashboard</h1>
                    <p class="text-[#757575]">January, 20th 2025</p>
                </div>

                <div id="yaka-calculator" class="p-4 rounded-lg bg-gray-100 shadow-lg relative">
                    <!-- Title -->
                    <h2 class="text-xl font-bold mb-4">Yaka Units Calculator</h2>

                    <!-- Calculator Layout -->
                    <div class="flex items-center gap-4">
                        <!-- Amount Input -->
                        <div class="flex-1">
                        <label for="amount" class="block text-gray-700 mb-2">Enter Amount (UGX):</label>
                        <input
                            type="number"
                            id="amount"
                            class="w-full p-2 border rounded"
                            placeholder="Enter amount of money"
                        />
                        </div>

                        <!-- Yaka Units Display -->
                        <div class="flex-1 text-center">
                        <label class="block text-gray-700 mb-2">Yaka Units:</label>
                        <p id="result" class="p-2 bg-white border rounded text-green-600 font-bold">
                            Yaka Units
                        </p>
                        </div>
                    </div>

                    <!-- Refresh Icon in top-right corner -->
                    <button
                        onclick="resetCalculator()"
                        class="absolute top-2 right-2 text-gray-600 hover:text-blue-500">
                        🔄
                    </button>

                    <!-- Calculate Button -->
                    <div class="mt-4">
                        <button
                        onclick="calculateYakaUnits()"
                        class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600"
                        >
                        Calculate Units
                        </button>
                    </div>
                    </div>

                    <script>
                    function calculateYakaUnits() {
                        const amount = parseFloat(document.getElementById("amount").value);
                        const lifelineRate = 606.2; // Subsidized rate for first 15 units
                        const tierOneRate = 803.0; // Rate for 16th to 80th unit
                        const tierTwoRate = 412.0; // Rate for units above 80

                        let remainingAmount = amount;
                        let units = 0;

                        if (remainingAmount <= 0 || isNaN(amount)) {
                        document.getElementById("result").innerText = "Invalid amount.";
                        return;
                        }

                        // Lifeline tier (first 15 units)
                        const lifelineCost = 15 * lifelineRate;
                        if (remainingAmount <= lifelineCost) {
                        units = remainingAmount / lifelineRate;
                        document.getElementById("result").innerText = `${units.toFixed(2)} units`;
                        return;
                        }
                        units += 15;
                        remainingAmount -= lifelineCost;

                        // Tier 1 (16th to 80th unit)
                        const tierOneUnits = 80 - 15; // 65 units in tier 1
                        const tierOneCost = tierOneUnits * tierOneRate;
                        if (remainingAmount <= tierOneCost) {
                        units += remainingAmount / tierOneRate;
                        document.getElementById("result").innerText = `${units.toFixed(2)} units`;
                        return;
                        }
                        units += tierOneUnits;
                        remainingAmount -= tierOneCost;

                        // Tier 2 (above 80 units)
                        units += remainingAmount / tierTwoRate;
                        document.getElementById("result").innerText = `${units.toFixed(2)} units`;
                    }

                    function resetCalculator() {
                        document.getElementById("amount").value = "";
                        document.getElementById("result").innerText = "Enter an amount";
                    }
                    </script>


                    <h2 class="text-lg font-semibold text-[#aed581] text-center">Graph</h2>


                    <div class="flex justify-center mt-2">
                        <button id="todayBtn" class="px-4 py-2 bg-[#388e3c] rounded text-sm text-white hover:bg-[#66bb6a] mx-2" onclick="updateGraph('today')">Today</button>
                        <button id="monthBtn" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('month')">Month</button>
                        <button id="yearBtn" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('year')">Year</button>
                    </div>

                    <div class="flex justify-between border-b border-[#81c784] pb-4 md:flex hidden">


    <div class="text-sm">
        <p class="text-[#a5d6a7]">JAN 19TH 2025</p>
        <p class="text-2xl font-bold text-[#e8f5e9]">$7.1</p>
    </div>
    <div class="text-sm">
        <p class="text-[#a5d6a7]">SO FAR TODAY</p>
        <p class="text-2xl font-bold text-[#e8f5e9]">$0.8</p>
    </div>
    <div class="text-sm">
        <p class="text-[#a5d6a7]">PREDICTED TODAY</p>
        <p class="text-2xl font-bold text-[#e8f5e9]">$6.2</p>
    </div>
    <div class="text-sm">
        <p class="text-[#a5d6a7]">ESTIMATED SAVINGS</p>
        <p class="text-2xl font-bold text-[#e8f5e9]">$0.9</p>
    </div>
</div>


                    <div class="mt-6">
                        <div id="graphContainer">
                            <!-- Graph content will be dynamically updated -->
                            <canvas id="costChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const graphData = {
            today: {
                labels: ["10:00", "12:00", "14:00", "16:00", "18:00"],
                data: [60, 50, 40, 30, 20],
                type: 'line', // Line chart for today
            },
            month: {
                labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
                data: [70, 60, 50, 40],
                type: 'bar', // Bar chart for month
            },
            year: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                data: [90, 80, 70, 60, 50],
                type: 'pie', // Pie chart for year
            }
        };

        let chart;  // This will hold the Chart.js instance

        // Initialize the Chart.js graph
        function initializeChart() {
            const ctx = document.getElementById('costChart').getContext('2d');
            chart = new Chart(ctx, {
                type: graphData.today.type, // Default to "Today" type
                data: {
                    labels: graphData.today.labels,  // Default to "Today"
                    datasets: [{
                        label: 'Cost Over Time',
                        data: graphData.today.data,
                        borderColor: '#388e3c',
                        backgroundColor: 'rgba(56, 142, 60, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Update the graph based on the selected range
        function updateGraph(range) {
            // Reset all button styles
            document.getElementById('todayBtn').classList.remove('bg-[#388e3c]', 'text-white');
            document.getElementById('monthBtn').classList.remove('bg-[#388e3c]', 'text-white');
            document.getElementById('yearBtn').classList.remove('bg-[#388e3c]', 'text-white');

            // Add green color to the clicked button
            if (range === 'today') {
                document.getElementById('todayBtn').classList.add('bg-[#388e3c]', 'text-white');
            } else if (range === 'month') {
                document.getElementById('monthBtn').classList.add('bg-[#388e3c]', 'text-white');
            } else if (range === 'year') {
                document.getElementById('yearBtn').classList.add('bg-[#388e3c]', 'text-white');
            }

            // Update the chart type, labels, and data
            chart.config.type = graphData[range].type; // Update chart type
            chart.data.labels = graphData[range].labels;
            chart.data.datasets[0].data = graphData[range].data;

            // If it's a pie chart, we need to modify the dataset for it
            if (graphData[range].type === 'pie') {
                chart.data.datasets[0].backgroundColor = [
                    '#388e3c', '#81c784', '#c8e6c9', '#66bb6a', '#2e7d32'
                ];
            } else {
                chart.data.datasets[0].backgroundColor = 'rgba(56, 142, 60, 0.2)';
            }

            // Update the chart
            chart.update();
        }

        // Initialize with "Today" graph
        initializeChart();
    </script>
</x-app-layout>


