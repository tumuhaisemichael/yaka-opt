<x-app-layout>
    <!-- Shared Styles -->
    <style>
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .calculator-container {
            position: relative;
            padding: 16px;
            border-radius: 8px;
            background-color: #f5f5f5;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .reset-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            color: #757575;
        }
        .reset-btn:hover {
            color: #3b82f6;
        }
        @media (max-width: 767px) {
            .calculator-container {
                padding: 12px;
            }
        }
    </style>

    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: 100vh;">
        <nav class="bg-[#2e7d32] dark:bg-[#1b5e20]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Cost</h3>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-home me-2"></i>{{ __('Cost') }}</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-plug me-2"></i>{{ __('Appliance') }}</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-link me-2"></i>{{ __('Connected Devices') }}</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka') }}</a></li>
            </ul>
        </nav>

        <div class="flex-grow p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-[#2e7d32]">Cost</h1>
                    <p id="currentDateTimeDesktop" class="text-[#757575]"></p>
                </div>

                <div id="yaka-calculator-desktop" class="calculator-container mt-4">
                    <h2 class="text-xl font-bold mb-4">Yaka Units Calculator</h2>
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <label for="amountDesktop" class="block text-gray-700 mb-2">Enter Amount (UGX):</label>
                            <input type="number" id="amountDesktop" class="w-full p-2 border rounded" placeholder="Enter amount of money" />
                        </div>
                        <div class="flex-1 text-center">
                            <label class="block text-gray-700 mb-2">Yaka Units:</label>
                            <p id="resultDesktop" class="p-2 bg-white border rounded text-green-600 font-bold">Enter an amount</p>
                        </div>
                    </div>
                    <button class="reset-btn text-2xl" onclick="resetCalculator('Desktop')">🔄</button>
                    <div class="mt-4">
                        <button onclick="calculateYakaUnits('Desktop')" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Calculate Units</button>
                    </div>
                </div>

                <h2 class="text-lg font-semibold text-[#aed581] text-center mt-6">Graph</h2>
                <div class="flex justify-center mt-2">
                    <button id="todayBtnDesktop" class="px-4 py-2 bg-[#388e3c] rounded text-sm text-white hover:bg-[#66bb6a] mx-2" onclick="updateGraph('today', 'Desktop')">Today</button>
                    <button id="monthBtnDesktop" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('month', 'Desktop')">Month</button>
                    <button id="yearBtnDesktop" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('year', 'Desktop')">Year</button>
                </div>

                <div class="mt-6">
                    <div id="graphContainerDesktop">
                        <canvas id="costChartDesktop" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <div class="bg-[#2e7d32] p-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Cost</h3>
            <button id="menuToggleMobile" class="text-white"><i class="fas fa-bars"></i> Menu</button>
        </div>

        <div id="mobileMenuMobile" class="hidden bg-[#2e7d32] p-4">
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-home me-2"></i>{{ __('Cost') }}</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-plug me-2"></i>{{ __('Appliance') }}</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-link me-2"></i>{{ __('Connected Devices') }}</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka') }}</a></li>
            </ul>
        </div>

        <div class="p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-[#2e7d32]">Cost</h1>
                    <p id="currentDateTimeMobile" class="text-[#757575]"></p>
                </div>

                <div id="yaka-calculator-mobile" class="calculator-container mt-4">
                    <h2 class="text-xl font-bold mb-4">Yaka Units Calculator</h2>
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <label for="amountMobile" class="block text-gray-700 mb-2">Enter Amount (UGX):</label>
                            <input type="number" id="amountMobile" class="w-full p-2 border rounded" placeholder="Enter amount of money" />
                        </div>
                        <div class="flex-1 text-center">
                            <label class="block text-gray-700 mb-2">Yaka Units:</label>
                            <p id="resultMobile" class="p-2 bg-white border rounded text-green-600 font-bold">Enter an amount</p>
                        </div>
                    </div>
                    <button class="reset-btn text-2xl" onclick="resetCalculator('Mobile')">🔄</button>
                    <div class="mt-4">
                        <button onclick="calculateYakaUnits('Mobile')" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Calculate Units</button>
                    </div>
                </div>

                <h2 class="text-lg font-semibold text-[#aed581] text-center mt-6">Graph</h2>
                <div class="flex justify-center mt-2">
                    <button id="todayBtnMobile" class="px-4 py-2 bg-[#388e3c] rounded text-sm text-white hover:bg-[#66bb6a] mx-2" onclick="updateGraph('today', 'Mobile')">Today</button>
                    <button id="monthBtnMobile" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('month', 'Mobile')">Month</button>
                    <button id="yearBtnMobile" class="px-4 py-2 bg-[#2e7d32] text-[#a5d6a7] rounded text-sm hover:bg-[#66bb6a] mx-2" onclick="updateGraph('year', 'Mobile')">Year</button>
                </div>

                <div class="mt-6">
                    <div id="graphContainerMobile">
                        <canvas id="costChartMobile" width="300" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shared JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Shared State
        let state = {
            amount: JSON.parse(localStorage.getItem("amount")) || "",
            yakaUnits: JSON.parse(localStorage.getItem("yakaUnits")) || "Enter an amount",
            graphRange: localStorage.getItem("graphRange") || "today"
        };

        const graphData = {
            today: {
                labels: ["10:00", "12:00", "14:00", "16:00", "18:00"],
                data: [60, 50, 40, 30, 20],
                type: "line"
            },
            month: {
                labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
                data: [70, 60, 50, 40],
                type: "bar"
            },
            year: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                data: [90, 80, 70, 60, 50],
                type: "pie"
            }
        };

        let chartDesktop, chartMobile;

        // Update State and LocalStorage
        function updateState(key, value) {
            state[key] = value;
            localStorage.setItem(key, JSON.stringify(value));
            syncLayouts();
        }

        // Initialize UI
        function initializeUI(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const amountInput = document.getElementById(`amount${suffix}`);
            const resultElement = document.getElementById(`result${suffix}`);
            if (amountInput) amountInput.value = state.amount;
            if (resultElement) resultElement.innerText = state.yakaUnits;
            updateDateTime(suffix);
            initializeChart(suffix);
            updateGraph(state.graphRange, suffix, false); // Initialize graph without updating state
        }

        // Sync Layouts on Resize
        function syncLayouts() {
            const isDesktop = window.innerWidth >= 768;
            console.log(`Syncing layout: ${isDesktop ? "Desktop" : "Mobile"}`);
            initializeUI(isDesktop ? "Desktop" : "Mobile");
        }

        // Update Date and Time
        function updateDateTime(suffix) {
            let now = new Date();
            let options = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
            let formattedDate = now.toLocaleDateString("en-US", options);
            let formattedTime = now.toLocaleTimeString("en-US", { hour: "2-digit", minute: "2-digit", second: "2-digit" });
            document.getElementById(`currentDateTime${suffix}`).innerText = `${formattedDate}, ${formattedTime}`;
        }

        // Calculate Yaka Units
        function calculateYakaUnits(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const amount = parseFloat(document.getElementById(`amount${suffix}`).value);
            const lifelineRate = 606.2;
            const tierOneRate = 803.0;
            const tierTwoRate = 412.0;

            if (isNaN(amount) || amount <= 0) {
                updateState("yakaUnits", "Invalid amount.");
                document.getElementById(`result${suffix}`).innerText = "Invalid amount.";
                return;
            }

            let remainingAmount = amount;
            let units = 0;

            const lifelineCost = 15 * lifelineRate;
            if (remainingAmount <= lifelineCost) {
                units = remainingAmount / lifelineRate;
            } else {
                units += 15;
                remainingAmount -= lifelineCost;

                const tierOneUnits = 65;
                const tierOneCost = tierOneUnits * tierOneRate;
                if (remainingAmount <= tierOneCost) {
                    units += remainingAmount / tierOneRate;
                } else {
                    units += tierOneUnits;
                    remainingAmount -= tierOneCost;
                    units += remainingAmount / tierTwoRate;
                }
            }

            const result = `${units.toFixed(2)} units`;
            updateState("amount", amount);
            updateState("yakaUnits", result);
            document.getElementById(`result${suffix}`).innerText = result;
        }

        // Reset Calculator
        function resetCalculator(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            console.log(`Resetting calculator for ${suffix}`); // Debug log

            // Clear input
            const amountInput = document.getElementById(`amount${suffix}`);
            if (amountInput) {
                amountInput.value = "";
            } else {
                console.error(`Amount input for ${suffix} not found`);
            }

            // Reset result
            const resultElement = document.getElementById(`result${suffix}`);
            if (resultElement) {
                resultElement.innerText = "Enter an amount";
            } else {
                console.error(`Result element for ${suffix} not found`);
            }

            // Update state
            updateState("amount", "");
            updateState("yakaUnits", "Enter an amount");

            // Force UI sync
            syncLayouts();
        }

        // Initialize Chart
        function initializeChart(suffix) {
            const ctx = document.getElementById(`costChart${suffix}`).getContext("2d");
            const chartInstance = suffix === "Desktop" ? chartDesktop : chartMobile;
            if (chartInstance) chartInstance.destroy();

            const config = {
                type: graphData[state.graphRange].type,
                data: {
                    labels: graphData[state.graphRange].labels,
                    datasets: [{
                        label: "Cost Over Time",
                        data: graphData[state.graphRange].data,
                        borderColor: "#388e3c",
                        backgroundColor: graphData[state.graphRange].type === "pie" ? ["#388e3c", "#81c784", "#c8e6c9", "#66bb6a", "#2e7d32"] : "rgba(56, 142, 60, 0.2)",
                        fill: graphData[state.graphRange].type !== "pie"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: graphData[state.graphRange].type === "pie" ? {} : {
                        x: { beginAtZero: true },
                        y: { beginAtZero: true }
                    }
                }
            };

            if (suffix === "Desktop") {
                chartDesktop = new Chart(ctx, config);
            } else {
                chartMobile = new Chart(ctx, config);
            }
        }

        // Update Graph
        function updateGraph(range, layout, updateStateFlag = true) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            if (updateStateFlag) {
                updateState("graphRange", range);
            }

            const buttons = ["todayBtn", "monthBtn", "yearBtn"];
            buttons.forEach(btn => {
                const element = document.getElementById(`${btn}${suffix}`);
                element.classList.remove("bg-[#388e3c]", "text-white");
                element.classList.add("bg-[#2e7d32]", "text-[#a5d6a7]");
            });

            const activeBtn = document.getElementById(`${range}Btn${suffix}`);
            activeBtn.classList.remove("bg-[#2e7d32]", "text-[#a5d6a7]");
            activeBtn.classList.add("bg-[#388e3c]", "text-white");

            const chart = suffix === "Desktop" ? chartDesktop : chartMobile;
            chart.config.type = graphData[range].type;
            chart.data.labels = graphData[range].labels;
            chart.data.datasets[0].data = graphData[range].data;
            chart.data.datasets[0].backgroundColor = graphData[range].type === "pie" ? ["#388e3c", "#81c784", "#c8e6c9", "#66bb6a", "#2e7d32"] : "rgba(56, 142, 60, 0.2)";
            chart.data.datasets[0].fill = graphData[range].type !== "pie";
            chart.options.scales = graphData[range].type === "pie" ? {} : {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            };
            chart.update();
        }

        // Mobile Menu Toggle
        document.getElementById("menuToggleMobile").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenuMobile");
            mobileMenu.classList.toggle("hidden");
        });

        // Real-Time Date/Time Updates
        setInterval(() => {
            updateDateTime("Desktop");
            updateDateTime("Mobile");
        }, 1000);

        // Sync on Resize
        window.addEventListener("resize", () => {
            syncLayouts();
        });

        // Initialize Both Layouts
        document.addEventListener("DOMContentLoaded", () => {
            initializeUI("Desktop");
            initializeUI("Mobile");
            syncLayouts();
        });
    </script>
</x-app-layout>
