<x-app-layout>
    <div class="flex" style="height: 100vh;">
        <!-- Sidebar -->
        <nav class="bg-[#2e7d32] dark:bg-[#1b5e20]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">User Menu</h3>
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

                <div class="bg-[#2e7d32] text-[#030f04] rounded-lg mt-4 p-4">
                    <h2 class="text-lg font-semibold text-[#aed581] text-center">COST</h2>

                    <div class="flex justify-center mt-2">
                        <button id="todayBtn" class="px-4 py-2 bg-[#388e3c] rounded text-sm text-white hover:bg-[#66bb6a] mx-2" onclick="updateGraph('today')">Today</button>
                        <button id="monthBtn" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('month')">Month</button>
                        <button id="yearBtn" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('year')">Year</button>
                    </div>

                    <div class="flex justify-between border-b border-[#81c784] pb-4">
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


