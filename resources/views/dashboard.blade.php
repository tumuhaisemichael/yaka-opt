<x-app-layout>
    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: calc(100vh - 4rem);">
        <!-- Sidebar -->
        <nav class="bg-[#004d40] dark:bg-[#00332c]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Op Energy</h3>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-home me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka-Opt') }}
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
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-link me-2"></i>
                        Connect Devices
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-link me-2"></i>
                        Yaka Usage
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-[#004d40] border-2 border-[#00796b] inline-block p-2 bg-[#a5d6a7]">Op ENERGY DASHBOARD</h2>
            </div>
            <div
                class="grid grid-cols-2 lg:grid-cols-3 gap-6 p-4"
                style="max-height: calc(100vh - 10rem); overflow-y: auto;"
            >
                <!-- Cost Predicted -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Cost Predicted</h3>
                    <canvas id="costPredictedChart" style="width: 100%; height: 250px;"></canvas>
                    <p class="text-sm text-white mb-4">This graph shows the predicted energy cost for the current month, broken down by lighting, heating, and appliances.</p>

                </div>
                <!-- Change in Cost -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Change in Cost</h3>
                    <canvas id="changeInCostChart" style="width: 100%; height: 250px;"></canvas>
                    <p class="text-sm text-white mb-4">This graph shows the change in energy cost over the past four months, helping you identify trends and areas for improvement.</p>

                </div>
                <!-- Usage Estimate -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Usage Estimate</h3>
                    <canvas id="usageEstimateChart" style="width: 100%; height: 250px;"></canvas>
                    <p class="text-sm text-white mb-4">This graph provides an estimate of your energy usage over the past three weeks, helping you understand your consumption patterns.</p>

                </div>
                <!-- Active Appliances -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Active Appliances</h3>
                    <canvas id="activeAppliancesChart" style="width: 100%; height: 250px;"></canvas>
                    <p class="text-sm text-white mb-4">This graph shows the number of active appliances in your home, helping you identify opportunities to reduce energy consumption.</p>

                </div>
                <!-- Energy Intensity -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Energy Intensity</h3>
                    <canvas id="energyIntensityChart" style="width: 100%; height: 250px;"></canvas>
                    <p class="text-sm text-white mb-4">This graph shows the energy intensity of your home, measured in watts per square meter, helping you understand how efficiently you're using energy.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <!-- Mobile Header -->
        <div class="bg-[#004d40] p-4">
            <button id="menuToggle" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-[#004d40] p-4">
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-home me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.update') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        Yaka-Opt
                    </a>
                </li>
                <li>
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
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2">
                        <i class="fas fa-link me-2"></i>
                        Connect Devices
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-[#004d40] border-2 border-[#00796b] inline-block p-2 bg-[#a5d6a7]">ENERGY DASHBOARD</h2>
            </div>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4"
                style="max-height: calc(100vh - 10rem); overflow-y: auto;"
            >
                <!-- Cost Predicted -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Cost Predicted</h3>
                    <canvas id="costPredictedChartMobile" style="width: 100%; height: 200px;"></canvas>
                </div>
                <!-- Change in Cost -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Change in Cost</h3>
                    <canvas id="changeInCostChartMobile" style="width: 100%; height: 200px;"></canvas>
                </div>
                <!-- Usage Estimate -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Usage Estimate</h3>
                    <canvas id="usageEstimateChartMobile" style="width: 100%; height: 200px;"></canvas>
                </div>
                <!-- Active Appliances -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Active Appliances</h3>
                    <canvas id="activeAppliancesChartMobile" style="width: 100%; height: 200px;"></canvas>
                </div>
                <!-- Energy Intensity -->
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Energy Intensity</h3>
                    <canvas id="energyIntensityChartMobile" style="width: 100%; height: 200px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Initialize Charts for Desktop and Mobile
        function initializeCharts(chartId, type, labels, data, backgroundColors, borderColor) {
            const ctx = document.getElementById(chartId).getContext('2d');
            new Chart(ctx, {
                type: type,
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: backgroundColors,
                        borderColor: borderColor,
                        fill: true,
                    }],
                },
                options: { responsive: true, aspectRatio: 1.5 },
            });
        }

        const chartData = {
            labels: ['Lighting', 'Heating', 'Appliances'],
            data: [30, 45, 25],
            colors: ['#43a047', '#1b5e20', '#80cbc4']
        };

        // Desktop Charts
        initializeCharts('costPredictedChart', 'pie', chartData.labels, chartData.data, chartData.colors);
        initializeCharts('changeInCostChart', 'bar', ['Jan', 'Feb', 'Mar', 'Apr'], [200, 180, 220, 240], ['#004d40']);
        initializeCharts('usageEstimateChart', 'line', ['Week 1', 'Week 2', 'Week 3'], [120, 150, 170], ['#1b5e20']);
        initializeCharts('activeAppliancesChart', 'bar', ['Fridge', 'AC'], [6, 3], ['#43a047']);
        initializeCharts('energyIntensityChart', 'radar', ['Daytime', 'Night'], [70, 30], ['rgba(67, 160, 71, 0.2)']);

        // Mobile Charts
        initializeCharts('costPredictedChartMobile', 'pie', chartData.labels, chartData.data, chartData.colors);
        initializeCharts('changeInCostChartMobile', 'bar', ['Jan', 'Feb', 'Mar', 'Apr'], [200, 180, 220, 240], ['#004d40']);
        initializeCharts('usageEstimateChartMobile', 'line', ['Week 1', 'Week 2', 'Week 3'], [120, 150, 170], ['#1b5e20']);
        initializeCharts('activeAppliancesChartMobile', 'bar', ['Fridge', 'AC'], [6, 3], ['#43a047']);
        initializeCharts('energyIntensityChartMobile', 'radar', ['Daytime', 'Night'], [70, 30], ['rgba(67, 160, 71, 0.2)']);

        document.addEventListener("DOMContentLoaded", function () {
        const menuToggle = document.getElementById("menuToggle");
        const mobileMenu = document.getElementById("mobileMenu");

        menuToggle.addEventListener("click", function () {
            // Toggle the "hidden" class to show/hide the menu
            mobileMenu.classList.toggle("hidden");
        });
    });
    </script>
</x-app-layout>
