<x-app-layout>
    <!-- Shared Styles -->
    <style>
        .chart-container {
            position: relative;
            width: 100%;
            height: 250px;
        }
        @media (max-width: 767px) {
            .chart-container {
                height: 200px;
            }
        }
    </style>

    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: calc(100vh - 4rem);">
        <!-- Sidebar -->
        <nav class="bg-[#004d40] dark:bg-[#00332c]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Op Energy</h3>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-home me-2"></i>Dashboard</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-home me-2"></i>Cost</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-plug me-2"></i>Appliances</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-link me-2"></i>Connect Devices</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-link me-2"></i>Yaka Usage</a></li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-[#004d40] border-2 border-[#00796b] inline-block p-2 bg-[#a5d6a7]">Op ENERGY DASHBOARD</h2>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6 p-4" style="max-height: calc(100vh - 10rem); overflow-y: auto;">
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Cost Predicted</h3>
                    <div class="chart-container"><canvas id="costPredictedChartDesktop"></canvas></div>
                    <p class="text-sm text-white mt-2">Predicted energy cost for the current month.</p>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Change in Cost</h3>
                    <div class="chart-container"><canvas id="changeInCostChartDesktop"></canvas></div>
                    <p class="text-sm text-white mt-2">Change in energy cost over the past four months.</p>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Usage Estimate</h3>
                    <div class="chart-container"><canvas id="usageEstimateChartDesktop"></canvas></div>
                    <p class="text-sm text-white mt-2">Energy usage estimate over the past three weeks.</p>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Active Appliances</h3>
                    <div class="chart-container"><canvas id="activeAppliancesChartDesktop"></canvas></div>
                    <p class="text-sm text-white mt-2">Number of active appliances in your home.</p>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Energy Intensity</h3>
                    <div class="chart-container"><canvas id="energyIntensityChartDesktop"></canvas></div>
                    <p class="text-sm text-white mt-2">Energy intensity in watts per square meter.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <!-- Mobile Header -->
        <div class="bg-[#004d40] p-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Op Energy</h3>
            <button id="menuToggle" class="text-white focus:outline-none"><i class="fas fa-bars"></i> Menu</button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-[#004d40] p-4">
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-home me-2"></i>Dashboard</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-user-edit me-2"></i>Yaka-Opt</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-home me-2"></i>Cost</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-plug me-2"></i>Appliances</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-link me-2"></i>Connect Devices</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-white hover:text-[#80cbc4] py-2"><i class="fas fa-link me-2"></i>Yaka Usage</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="text-center mb-4">
                <h2 class="text-2xl font-bold text-[#004d40] border-2 border-[#00796b] inline-block p-2 bg-[#a5d6a7]">ENERGY DASHBOARD</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-4" style="max-height: calc(100vh - 10rem); overflow-y: auto;">
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Cost Predicted</h3>
                    <div class="chart-container"><canvas id="costPredictedChartMobile"></canvas></div>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Change in Cost</h3>
                    <div class="chart-container"><canvas id="changeInCostChartMobile"></canvas></div>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Usage Estimate</h3>
                    <div class="chart-container"><canvas id="usageEstimateChartMobile"></canvas></div>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Active Appliances</h3>
                    <div class="chart-container"><canvas id="activeAppliancesChartMobile"></canvas></div>
                </div>
                <div class="bg-[#00796b] p-4 rounded shadow">
                    <h3 class="text-white text-sm font-bold mb-2">Energy Intensity</h3>
                    <div class="chart-container"><canvas id="energyIntensityChartMobile"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Shared State
        const state = {
            charts: JSON.parse(localStorage.getItem('dashboardCharts')) || {
                costPredicted: { type: 'pie', labels: ['Lighting', 'Heating', 'Appliances'], data: [30, 45, 25], colors: ['#43a047', '#1b5e20', '#80cbc4'] },
                changeInCost: { type: 'bar', labels: ['Jan', 'Feb', 'Mar', 'Apr'], data: [200, 180, 220, 240], colors: ['#004d40'] },
                usageEstimate: { type: 'line', labels: ['Week 1', 'Week 2', 'Week 3'], data: [120, 150, 170], colors: ['#1b5e20'] },
                activeAppliances: { type: 'bar', labels: ['Fridge', 'AC'], data: [6, 3], colors: ['#43a047'] },
                energyIntensity: { type: 'radar', labels: ['Daytime', 'Night'], data: [70, 30], colors: ['rgba(67, 160, 71, 0.2)'], borderColor: '#43a047' }
            }
        };

        // Chart Instances
        let charts = {
            desktop: {},
            mobile: {}
        };

        // Save State to LocalStorage
        function saveState() {
            localStorage.setItem('dashboardCharts', JSON.stringify(state.charts));
        }

        // Initialize or Update Chart
        function initializeChart(chartId, chartData) {
            const ctx = document.getElementById(chartId)?.getContext('2d');
            if (!ctx) return; // Skip if element not found

            const existingChart = charts[chartId.includes('Desktop') ? 'desktop' : 'mobile'][chartId];
            if (existingChart) existingChart.destroy();

            const config = {
                type: chartData.type,
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        data: chartData.data,
                        backgroundColor: chartData.colors,
                        borderColor: chartData.borderColor || chartData.colors[0],
                        fill: chartData.type === 'line' || chartData.type === 'radar',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: chartData.type === 'pie' || chartData.type === 'radar' ? {} : {
                        y: { beginAtZero: true }
                    }
                }
            };

            const newChart = new Chart(ctx, config);
            charts[chartId.includes('Desktop') ? 'desktop' : 'mobile'][chartId] = newChart;
        }

        // Sync Layouts
        function syncLayouts() {
            const isDesktop = window.innerWidth >= 768;
            const layout = isDesktop ? 'Desktop' : 'Mobile';
            console.log(`Syncing layout: ${layout}`);

            // Initialize charts for the active layout
            initializeChart(`costPredictedChart${layout}`, state.charts.costPredicted);
            initializeChart(`changeInCostChart${layout}`, state.charts.changeInCost);
            initializeChart(`usageEstimateChart${layout}`, state.charts.usageEstimate);
            initializeChart(`activeAppliancesChart${layout}`, state.charts.activeAppliances);
            initializeChart(`energyIntensityChart${layout}`, state.charts.energyIntensity);
        }

        // Update Chart Data (Example function for future interactivity)
        function updateChartData(chartKey, newData) {
            state.charts[chartKey].data = newData;
            saveState();
            syncLayouts();
        }

        // Mobile Menu Toggle
        document.getElementById('menuToggle').addEventListener('click', () => {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        });

        // Initialize on Load
        document.addEventListener('DOMContentLoaded', () => {
            syncLayouts();
        });

        // Sync on Resize
        window.addEventListener('resize', () => {
            syncLayouts();
        });
    </script>
</x-app-layout>
