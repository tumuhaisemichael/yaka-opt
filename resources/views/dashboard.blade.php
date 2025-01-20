<x-app-layout>
    <div class="py-12 flex" style="height: calc(100vh - 4rem);">
        <!-- Sidebar -->
        <nav class="bg-[#004d40] dark:bg-[#00332c]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Smart Energy</h3>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-home me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                            <a href="{{route('user.update') }}" class="d-flex align-items-center text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 py-2">
                                <i class="fas fa-user-edit me-2"></i>
                                {{('Yaka-Opt') }}
                            </a>
                </li>
                <li>
                    <a href="{{ route('user.cost') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-home me-2"></i>Cost
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-plug me-2"></i>
                        Appliances
                    </a>
                </li>
                <li>
                    <a href="#" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-chart-bar me-2"></i>
                        Usage by Room
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-[#004d40] border-2 border-[#00796b] inline-block p-2 bg-[#a5d6a7]">ENERGY DASHBOARD</h2>
            </div>
            <div
                class="grid grid-cols-2 md:grid-cols-3 gap-2 p-4"
                style="max-height: calc(100vh - 10rem); overflow-y: auto;"
            >
                <!-- Cost Predicted -->
                <div class="bg-[#00796b] p-2 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Cost Predicted</h3>
                    <canvas id="costPredictedChart" width="60" height="60"></canvas>
                </div>
                <!-- Change in Cost -->
                <div class="bg-[#00796b] p-2 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Change in Cost</h3>
                    <canvas id="changeInCostChart" width="60" height="60"></canvas>
                </div>
                <!-- Usage Estimate -->
                <div class="bg-[#00796b] p-2 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Usage Estimate</h3>
                    <canvas id="usageEstimateChart" width="60" height="60"></canvas>
                </div>
                <!-- Active Appliances -->
                <div class="bg-[#00796b] p-2 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Active Appliances</h3>
                    <canvas id="activeAppliancesChart" width="60" height="60"></canvas>
                </div>
                <!-- Energy Intensity -->
                <div class="bg-[#00796b] p-2 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Energy Intensity</h3>
                    <canvas id="energyIntensityChart" width="60" height="60"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Cost Predicted - Pie Chart
        const costPredictedCtx = document.getElementById('costPredictedChart').getContext('2d');
        new Chart(costPredictedCtx, {
            type: 'pie',
            data: {
                labels: ['Lighting', 'Heating', 'Appliances'],
                datasets: [{
                    data: [30, 45, 25],
                    backgroundColor: ['#43a047', '#1b5e20', '#80cbc4']
                }]
            },
            options: {
                aspectRatio: 2
            }
        });

        // Change in Cost - Bar Chart
        const changeInCostCtx = document.getElementById('changeInCostChart').getContext('2d');
        new Chart(changeInCostCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Cost ($)',
                    data: [200, 180, 220, 240],
                    backgroundColor: '#004d40'
                }]
            },
            options: {
                aspectRatio: 2
            }
        });

        // Usage Estimate - Line Chart
        const usageEstimateCtx = document.getElementById('usageEstimateChart').getContext('2d');
        new Chart(usageEstimateCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Usage (kWh)',
                    data: [120, 150, 170, 140],
                    borderColor: '#1b5e20',
                    fill: false
                }]
            },
            options: {
                aspectRatio: 2
            }
        });

        // Active Appliances - Bar Graph
        const activeAppliancesCtx = document.getElementById('activeAppliancesChart').getContext('2d');
        new Chart(activeAppliancesCtx, {
            type: 'bar',
            data: {
                labels: ['Fridge', 'Washing Machine', 'AC', 'Heater'],
                datasets: [{
                    label: 'Usage (Hours)',
                    data: [6, 4, 3, 2],
                    backgroundColor: ['#43a047', '#1b5e20', '#80cbc4', '#4db6ac']
                }]
            },
            options: {
                aspectRatio: 2
            }
        });

        // Energy Intensity - Radar Chart
        const energyIntensityCtx = document.getElementById('energyIntensityChart').getContext('2d');
        new Chart(energyIntensityCtx, {
            type: 'radar',
            data: {
                labels: ['Daytime', 'Evening', 'Night'],
                datasets: [{
                    label: 'Intensity (%)',
                    data: [70, 50, 30],
                    backgroundColor: 'rgba(67, 160, 71, 0.2)',
                    borderColor: 'rgba(67, 160, 71, 1)'
                }]
            },
            options: {
                aspectRatio: 2
            }
        });
    </script>
</x-app-layout>
