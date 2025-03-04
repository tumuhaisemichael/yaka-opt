<x-app-layout>
    <!-- Shared Styles -->
    <style>
        .overlay {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            padding: 20px;
            color: #fff;
            display: flex;
            flex-direction: column;
            max-height: 80vh;
            overflow-y: auto;
        }
        .overlay-content {
            background-color: #2c2c2c;
            padding: 20px;
            border-radius: 8px;
            overflow-y: auto;
        }
        .timer-display {
            margin-left: 10px;
            font-weight: bold;
        }
        .history-entry {
            background-color: #444;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        .history-entry h4 {
            color: #f5c518;
        }
        .delete-btn {
            color: #f00;
            cursor: pointer;
            text-decoration: underline;
            margin-top: 5px;
        }
        .btn {
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Desktop Timer Buttons */
        .appliance-row .btn {
            padding: 6px 12px; /* Default size for desktop */
            font-size: 14px;
        }
        /* Mobile Timer Buttons */
        @media (max-width: 767px) {
            .appliance-row .btn {
                padding: 4px 8px; /* Smaller size for mobile */
                font-size: 12px;
            }
        }
    </style>

    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: 100vh;">
        <nav class="bg-[#004d40] dark:bg-[#00332c]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Yaka-Opt</h3>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-home me-2"></i>{{ __('Cost') }}</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-plug me-2"></i>{{ __('Appliance') }}</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-link me-2"></i>{{ __('Connected Devices') }}</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka') }}</a></li>
            </ul>
        </nav>

        <div class="flex-grow p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Usage Op</h1>
                <p class="text-center mb-4">Enter your Yaka units and select appliances to calculate how long your units will last.</p>

                <h2 class="text-lg font-semibold text-[#00796b]">Enter Yaka Units</h2>
                <input type="number" id="yakaUnitsDesktop" placeholder="Enter Yaka Units" class="form-control mb-4" />

                <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
                <select id="applianceDropdownDesktop" class="form-control mb-4" onchange="addAppliance('Desktop')">
                    <option value="">-- Select an Appliance --</option>
                </select>

                <h2 class="text-lg font-semibold text-[#00796b]">Manage Saved Lists</h2>
                <div class="mb-4">
                    <button class="btn bg-purple-500 text-white w-100 mb-2" onclick="saveCurrentList('Desktop')">Save Current List</button>
                    <select id="savedListsDropdownDesktop" class="form-control mb-2" onchange="loadSavedList('Desktop')">
                        <option value="">-- Select a Saved List --</option>
                    </select>
                </div>

                <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
                <div class="mb-4">
                    <input type="text" id="customApplianceNameDesktop" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePowerDesktop" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn w-100 bg-blue-500 text-white" onclick="addCustomAppliance('Desktop')">Add Custom Appliance</button>
                </div>

                <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
                <div id="applianceListDesktop" class="mb-4"></div>
                <button class="btn w-100 bg-green-500 text-white" onclick="calculateUsage('Desktop')">Calculate</button>

                <div id="resultDesktop" class="mt-4" style="display: none;"></div>
                <div id="resultOverlayDesktop" class="overlay" style="display: none;">
                    <div class="overlay-content">
                        <div id="resultOverlayContentDesktop"></div>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-secondary w-100 mb-2" onclick="refreshPage()">Refresh</button>
                    <button class="btn btn-info w-100" onclick="showHistoryOverlay('Desktop')">View History</button>
                </div>

                <div id="historyOverlayDesktop" class="overlay" style="display: none;">
                    <div class="overlay-content">
                        <h2>Interaction History</h2>
                        <div id="historyContentDesktop"></div>
                        <button onclick="closeHistoryOverlay('Desktop')" class="btn btn-danger w-100 mt-3">Close</button>
                    </div>
                </div>

                <div class="mt-4">
                    <button id="toggleDevicesButtonDesktop" class="btn bg-[#2e7d32] text-white w-100">Show Connected Devices</button>
                    <div id="connectedDevicesSectionDesktop" style="display: none;">
                        <h2 class="text-lg font-semibold text-[#00796b]">Connected Devices</h2>
                        <ul id="connectedDevicesListDesktop"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <div class="bg-[#004d40] p-4">
            <button id="menuToggleMobile" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>

        <div id="mobileMenuMobile" class="hidden bg-[#004d40] p-4">
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-home me-2"></i>{{ __('Cost') }}</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-plug me-2"></i>{{ __('Appliance') }}</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-link me-2"></i>{{ __('Connected Devices') }}</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka') }}</a></li>
            </ul>
        </div>

        <div class="p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Usage Op</h1>
                <p class="text-center mb-4">Enter your Yaka units and select appliances to calculate how long your units will last.</p>

                <h2 class="text-lg font-semibold text-[#00796b]">Enter Yaka Units</h2>
                <input type="number" id="yakaUnitsMobile" placeholder="Enter Yaka Units" class="w-full p-2 border rounded mb-4" />

                <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
                <select id="applianceDropdownMobile" class="w-full p-2 border rounded mb-4" onchange="addAppliance('Mobile')">
                    <option value="">-- Select an Appliance --</option>
                </select>

                <h2 class="text-lg font-semibold text-[#00796b]">Manage Saved Lists</h2>
                <div class="mb-4">
                    <button class="btn bg-purple-500 text-white w-100 mb-2" onclick="saveCurrentList('Mobile')">Save Current List</button>
                    <select id="savedListsDropdownMobile" class="w-full p-2 border rounded mb-2" onchange="loadSavedList('Mobile')">
                        <option value="">-- Select a Saved List --</option>
                    </select>
                </div>

                <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
                <div class="mb-4">
                    <input type="text" id="customApplianceNameMobile" placeholder="Enter Appliance Name" class="w-full p-2 border rounded mb-2" />
                    <input type="number" id="customAppliancePowerMobile" placeholder="Enter Power Usage (Watts)" class="w-full p-2 border rounded mb-2" />
                    <button class="w-full bg-blue-500 text-white py-2 rounded" onclick="addCustomAppliance('Mobile')">Add Custom Appliance</button>
                </div>

                <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
                <div id="applianceListMobile" class="mb-4"></div>
                <button class="w-full bg-green-500 text-white py-2 rounded" onclick="calculateUsage('Mobile')">Calculate</button>

                <div id="resultMobile" class="mt-4 p-4 bg-gray-100 rounded" style="display: none;"></div>
                <div id="resultOverlayMobile" class="overlay" style="display: none;">
                    <div class="overlay-content">
                        <div id="resultOverlayContentMobile"></div>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-secondary w-100 mb-2" onclick="refreshPage()">Refresh</button>
                    <button class="btn btn-info w-100" onclick="showHistoryOverlay('Mobile')">View History</button>
                </div>

                <div id="historyOverlayMobile" class="overlay" style="display: none;">
                    <div class="overlay-content">
                        <h2>Interaction History</h2>
                        <div id="historyContentMobile"></div>
                        <button onclick="closeHistoryOverlay('Mobile')" class="btn btn-danger w-100 mt-3">Close</button>
                    </div>
                </div>

                <div class="mt-4">
                    <button id="toggleDevicesButtonMobile" class="btn bg-[#2e7d32] text-white w-100">Show Connected Devices</button>
                    <div id="connectedDevicesSectionMobile" style="display: none;">
                        <h2 class="text-lg font-semibold text-[#00796b]">Connected Devices</h2>
                        <ul id="connectedDevicesListMobile"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shared JavaScript -->
    <script>
        // Shared Data
        const appliances = [
            { name: "Fridge", power: 150 },
            { name: "TV", power: 100 },
            { name: "Washing Machine", power: 500 },
            { name: "Electric Iron", power: 1000 },
            { name: "Microwave", power: 1200 },
            { name: "Laptop", power: 65 },
            { name: "Fan", power: 70 },
            { name: "Lights", power: 60 },
        ];

        // Initialize selectedAppliances as empty by default
        let selectedAppliances = [];
        let timerIntervals = JSON.parse(localStorage.getItem("timerIntervals")) || {};
        let interactionHistory = JSON.parse(localStorage.getItem("interactionHistory")) || [];
        let connectedDevices = JSON.parse(localStorage.getItem("connectedDevices")) || [];
        let savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];

        // Initialize UI
        function initializeUI(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const applianceDropdown = document.getElementById(`applianceDropdown${suffix}`);
            applianceDropdown.innerHTML = "<option value=''>-- Select an Appliance --</option>";
            appliances.forEach((appliance, index) => {
                const option = document.createElement("option");
                option.value = index;
                option.textContent = appliance.name;
                applianceDropdown.appendChild(option);
            });
            populateSavedListsDropdown(suffix);
            displayApplianceList(suffix); // This will now display an empty list initially
            loadConnectedDevices(suffix);
        }

        // Populate Saved Lists Dropdown
        function populateSavedListsDropdown(suffix) {
            const dropdown = document.getElementById(`savedListsDropdown${suffix}`);
            dropdown.innerHTML = "<option value=''>-- Select a Saved List --</option>";
            savedLists.forEach((list, index) => {
                const option = document.createElement("option");
                option.value = index;
                option.textContent = `List ${index + 1}`;
                dropdown.appendChild(option);
            });
        }

        // Save Current List
        function saveCurrentList(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            if (selectedAppliances.length === 0) {
                alert("No appliances selected to save.");
                return;
            }
            savedLists.push([...selectedAppliances]);
            localStorage.setItem("applianceLists", JSON.stringify(savedLists));
            populateSavedListsDropdown(suffix);
            alert("Current appliance list saved!");
        }

        // Add Appliance
        function addAppliance(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const selectedIndex = document.getElementById(`applianceDropdown${suffix}`).value;
            if (selectedIndex === "") return;

            const appliance = appliances[selectedIndex];
            if (!selectedAppliances.some(a => a.name === appliance.name && a.power === appliance.power)) {
                selectedAppliances.push(appliance);
                localStorage.setItem("selectedAppliances", JSON.stringify(selectedAppliances));
                displayApplianceList(suffix);
            }
            document.getElementById(`applianceDropdown${suffix}`).value = "";
        }

        // Add Custom Appliance
        function addCustomAppliance(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const name = document.getElementById(`customApplianceName${suffix}`).value.trim();
            const power = parseFloat(document.getElementById(`customAppliancePower${suffix}`).value);
            if (!name || isNaN(power) || power <= 0) {
                alert("Please enter valid appliance name and power usage.");
                return;
            }
            selectedAppliances.push({ name, power });
            localStorage.setItem("selectedAppliances", JSON.stringify(selectedAppliances));
            displayApplianceList(suffix);
            document.getElementById(`customApplianceName${suffix}`).value = "";
            document.getElementById(`customAppliancePower${suffix}`).value = "";
        }

        // Display Appliance List
        function displayApplianceList(suffix) {
            const applianceList = document.getElementById(`applianceList${suffix}`);
            applianceList.innerHTML = "";
            selectedAppliances.forEach((appliance, index) => {
                applianceList.innerHTML += `
                    <div class="appliance-row flex items-center justify-between bg-gray-100 p-3 rounded-lg shadow-md mb-3">
                        <span class="text-lg font-semibold">${appliance.name} (${appliance.power}W):</span>
                        <input type="number" id="hours${suffix}-${index}" placeholder="Hours/day" class="form-control w-1/5 p-2 border border-gray-300 rounded-md" />
                        <div class="flex gap-2">
                            <button class="btn bg-blue-500 text-white hover:bg-blue-600" onclick="startTimer(${index}, '${suffix}')">Start Timer</button>
                            <button class="btn bg-red-500 text-white hover:bg-red-600" onclick="stopTimer(${index}, '${suffix}')">Stop Timer</button>
                            <button class="btn bg-green-500 text-white hover:bg-green-600" onclick="scheduleTimer(${index}, '${suffix}')">Schedule</button>
                        </div>
                    </div>`;
            });
        }

        // Start Timer
        function startTimer(index, suffix) {
            const hoursInput = document.getElementById(`hours${suffix}-${index}`);
            const hours = parseFloat(hoursInput.value);
            if (isNaN(hours) || hours <= 0) {
                alert("Please enter a valid number of hours.");
                return;
            }

            const seconds = hours * 3600;
            let remainingTime = seconds;

            let timerDisplay = document.getElementById(`timer${suffix}-${index}`);
            if (!timerDisplay) {
                timerDisplay = document.createElement("div");
                timerDisplay.id = `timer${suffix}-${index}`;
                timerDisplay.className = "timer-display";
                hoursInput.parentNode.appendChild(timerDisplay);
            }

            if (timerIntervals[index]) clearInterval(timerIntervals[index]);
            timerIntervals[index] = setInterval(() => {
                remainingTime--;
                const hoursLeft = Math.floor(remainingTime / 3600);
                const minutesLeft = Math.floor((remainingTime % 3600) / 60);
                const secondsLeft = remainingTime % 60;
                timerDisplay.textContent = `${hoursLeft}h ${minutesLeft}m ${secondsLeft}s`;

                if (remainingTime <= 0) {
                    clearInterval(timerIntervals[index]);
                    timerDisplay.textContent = "Time's up!";
                }
            }, 1000);
            localStorage.setItem("timerIntervals", JSON.stringify(timerIntervals));
        }

        // Stop Timer
        function stopTimer(index, suffix) {
            if (timerIntervals[index]) {
                clearInterval(timerIntervals[index]);
                delete timerIntervals[index];
                localStorage.setItem("timerIntervals", JSON.stringify(timerIntervals));
                const timerDisplay = document.getElementById(`timer${suffix}-${index}`);
                if (timerDisplay) timerDisplay.textContent = "Timer stopped.";
            }
        }

        // Schedule Timer
        function scheduleTimer(index, suffix) {
            const scheduleTime = prompt("Enter the time to start the timer (HH:MM, 24-hour format):");
            if (!scheduleTime || !/^(\d{2}):(\d{2})$/.test(scheduleTime)) {
                alert("Please enter a valid time in HH:MM format.");
                return;
            }

            const now = new Date();
            const [hours, minutes] = scheduleTime.split(":").map(Number);
            const scheduledTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes);

            if (scheduledTime <= now) scheduledTime.setDate(scheduledTime.getDate() + 1);
            const delay = scheduledTime - now;
            setTimeout(() => {
                startTimer(index, suffix);
                alert(`Timer started for ${selectedAppliances[index].name} at ${scheduleTime}.`);
            }, delay);
            alert(`Timer scheduled to start at ${scheduledTime.toLocaleTimeString()}.`);
        }

        // Load Saved List
        function loadSavedList(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const selectedIndex = document.getElementById(`savedListsDropdown${suffix}`).value;
            if (selectedIndex === "") return;

            savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
            if (savedLists[selectedIndex]) {
                selectedAppliances = [...savedLists[selectedIndex]];
                localStorage.setItem("selectedAppliances", JSON.stringify(selectedAppliances));
                displayApplianceList(suffix);
            } else {
                alert("Selected list not found.");
            }
        }

        // Calculate Usage
        function calculateUsage(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const yakaUnits = parseFloat(document.getElementById(`yakaUnits${suffix}`).value);
            if (isNaN(yakaUnits) || yakaUnits <= 0) {
                alert("Enter valid Yaka units.");
                return;
            }

            let totalKwh = 0;
            let breakdown = "";
            selectedAppliances.forEach((appliance, index) => {
                const hours = parseFloat(document.getElementById(`hours${suffix}-${index}`).value) || 0;
                const units = (appliance.power / 1000) * hours;
                totalKwh += units;
                breakdown += `<p>${appliance.name}: ${units.toFixed(2)} units/day (${hours} hours/day).</p>`;
            });

            const totalHours = (yakaUnits / totalKwh) * 24;
            const days = Math.floor(totalHours / 24);
            const hours = Math.floor(totalHours % 24);
            const minutes = Math.floor((totalHours % 1) * 60);
            const seconds = Math.floor(((totalHours % 1) * 60 - minutes) * 60);

            const interaction = { yakaUnits, selectedAppliances: [...selectedAppliances], totalKwh, days, hours, minutes, seconds };
            interactionHistory.push(interaction);
            localStorage.setItem("interactionHistory", JSON.stringify(interactionHistory));

            const overlayContent = `
                <h3>Your Yaka units will last ${days} days, ${hours} hours, ${minutes} minutes, and ${seconds} seconds.</h3>
                <div class="breakdown">
                    <h4>Breakdown:</h4>
                    ${breakdown}
                </div>
                <button class="btn btn-primary mt-3 close-result-btn" data-suffix="${suffix}">Close</button>`;
            const resultOverlayContent = document.getElementById(`resultOverlayContent${suffix}`);
            resultOverlayContent.innerHTML = overlayContent;
            document.getElementById(`resultOverlay${suffix}`).style.display = "block";

            const closeButton = resultOverlayContent.querySelector(".close-result-btn");
            closeButton.addEventListener("click", () => closeResultOverlay(suffix));
        }

        // Close Result Overlay
        function closeResultOverlay(suffix) {
            document.getElementById(`resultOverlay${suffix}`).style.display = "none";
            document.getElementById(`result${suffix}`).innerHTML = document.getElementById(`resultOverlayContent${suffix}`).innerHTML;
            document.getElementById(`result${suffix}`).style.display = "block";

            const overlayButton = document.getElementById(`resultOverlayContent${suffix}`).querySelector(".close-result-btn");
            if (overlayButton) overlayButton.removeEventListener("click", () => closeResultOverlay(suffix));

            const resultButton = document.getElementById(`result${suffix}`).querySelector(".close-result-btn");
            if (resultButton) resultButton.style.display = "none";
        }

        // Show History Overlay
        function showHistoryOverlay(suffix) {
            const historyContent = document.getElementById(`historyContent${suffix}`);
            historyContent.innerHTML = "";
            if (interactionHistory.length === 0) {
                historyContent.innerHTML = "<p>No history available.</p>";
            } else {
                interactionHistory.forEach((entry, index) => {
                    const { yakaUnits, selectedAppliances, totalKwh, days, hours, minutes, seconds } = entry;
                    const appliances = selectedAppliances.map(a => `${a.name} (${a.power}W)`).join(", ");
                    historyContent.innerHTML += `
                        <div class="history-entry">
                            <h4>Interaction ${index + 1}</h4>
                            <p><strong>Yaka Units:</strong> ${yakaUnits}</p>
                            <p><strong>Appliances:</strong> ${appliances}</p>
                            <p><strong>Total kWh:</strong> ${totalKwh.toFixed(2)}</p>
                            <p><strong>Duration:</strong> ${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds</p>
                            <span class="delete-btn" onclick="deleteHistoryEntry(${index}, '${suffix}')">Delete</span>
                        </div>`;
                });
            }
            document.getElementById(`historyOverlay${suffix}`).style.display = "block";
        }

        // Close History Overlay
        function closeHistoryOverlay(suffix) {
            document.getElementById(`historyOverlay${suffix}`).style.display = "none";
        }

        // Delete History Entry
        function deleteHistoryEntry(index, suffix) {
            interactionHistory.splice(index, 1);
            localStorage.setItem("interactionHistory", JSON.stringify(interactionHistory));
            showHistoryOverlay(suffix);
        }

        // Load Connected Devices
        function loadConnectedDevices(suffix) {
            const devicesList = document.getElementById(`connectedDevicesList${suffix}`);
            devicesList.innerHTML = connectedDevices.map(device => `
                <li class="bg-gray-100 p-3 rounded-lg shadow-md mb-3">
                    <p class="font-semibold">${device.name}</p>
                    <p class="text-gray-600">${device.type}</p>
                </li>
            `).join("");
        }

        // Toggle Connected Devices
        document.getElementById("toggleDevicesButtonDesktop").addEventListener("click", () => {
            const section = document.getElementById("connectedDevicesSectionDesktop");
            section.style.display = section.style.display === "none" ? "block" : "none";
            loadConnectedDevices("Desktop");
        });
        document.getElementById("toggleDevicesButtonMobile").addEventListener("click", () => {
            const section = document.getElementById("connectedDevicesSectionMobile");
            section.style.display = section.style.display === "none" ? "block" : "none";
            loadConnectedDevices("Mobile");
        });

        // Refresh Page
        function refreshPage() {
            localStorage.clear();
            location.reload();
        }

        // Mobile Menu Toggle
        document.getElementById("menuToggleMobile").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenuMobile");
            mobileMenu.classList.toggle("hidden");
        });

        // Initialize Both Layouts
        document.addEventListener("DOMContentLoaded", () => {
            initializeUI("Desktop");
            initializeUI("Mobile");
        });
    </script>
</x-app-layout>
