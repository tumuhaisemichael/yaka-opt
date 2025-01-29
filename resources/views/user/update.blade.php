<x-app-layout>
    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: 100vh;">
        <!-- Sidebar -->
        <nav class="bg-[#004d40] dark:bg-[#00332c]" style="width: 250px; padding: 20px;">

            <h3 class="text-white text-lg font-semibold mb-4 text-center">Yaka-Opt</h3>
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
                        <i class="fas fa-home me-2"></i>
                        {{ __('Cost') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-link me-2"></i>
                        {{ __('Connected Devices') }}
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Usage Op</h1>
                <p class="text-center mb-4">Enter your Yaka units and select appliances to calculate how long your units will last.</p>

                <!-- Steps -->
                <!-- Step 1 -->
                <h2 class="text-lg font-semibold text-[#00796b]">Enter Yaka Units</h2>
                <input type="number" id="yakaUnits" placeholder="Enter Yaka Units" class="form-control mb-4" />



                <!-- Step 2 -->
                <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
                <div class="dropdown mb-4">
                    <select id="applianceDropdown" class="form-control" onchange="addAppliance()">
                        <option value="">-- Select an Appliance --</option>
                    </select>
                </div>

                <!-- Step 3 -->
                <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
                <div class="custom-appliance mb-4">
                    <input type="text" id="customApplianceName" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePower" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn w-100" onclick="addCustomAppliance()">Add Custom Appliance</button>
                </div>

                <!-- Step 4 -->
                <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
                <div id="applianceList" class="appliance-list mb-4"></div>
                <button class="btn w-100" onclick="calculateUsage()">Calculate</button>

                <!-- Results -->
                <div id="result" class="result mt-4" style="display: none;"></div>

                <!-- Adjustment Options -->
                <div id="adjustmentOptions" class="adjustment-options mt-4" style="display: none;">
                    <h3 class="font-semibold">Would you like to adjust appliance usage to extend your Yaka units?</h3>
                    <button class="btn mt-2" onclick="showAdjustments();">
                        Yes, make adjustments
                    </button>
                </div>

                <!-- History and Refresh -->
                <div class="mt-4">
                    <button class="btn btn-secondary w-100 mb-2" onclick="refreshPage()">Refresh</button>
                    <button class="btn btn-info w-100" onclick="showHistoryOverlay()">View History</button>
                </div>
            </div>

            <!-- Updated Overlay for Viewing History -->
            <div id="historyOverlay" class="overlay" style="display: none;">
                <div class="overlay-content">
                    <h2>Interaction History</h2>
                    <div id="historyContent"></div>
                    <button onclick="closeHistoryOverlay()" class="btn btn-danger w-100 mt-3">Close</button>
                </div>
            </div>

            <div class="ccontainer">
        <!-- Button to toggle the connected devices list -->
        <button id="toggleDevicesButton">Show Connected Devices</button>

        <!-- Connected Devices List (initially hidden) -->
        <div id="connectedDevicesSection" style="display: none;">
            <h1>Connected Devices</h1>
            <ul id="connectedDevicesList">
                <!-- Connected devices will be dynamically added here -->
            </ul>
        </div>
    </div>

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

    .history-entry {
        background-color: #444;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .history-entry h4 {
        color: #f5c518;
    }

    .history-entry p {
        margin: 5px 0;
    }

    .delete-btn {
        color: #f00;
        cursor: pointer;
        text-decoration: underline;
        margin-top: 5px;
    }
</style>

        </div>
    </div>

    <!-- Scripts -->
    <script>
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

        const applianceDropdown = document.getElementById("applianceDropdown");
        const selectedAppliances = [];
        const interactionHistory = JSON.parse(localStorage.getItem("interactionHistory")) || [];

        appliances.forEach((appliance, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = appliance.name;
            applianceDropdown.appendChild(option);
        });

        function addAppliance() {
    const selectedIndex = applianceDropdown.value;
    if (selectedIndex === "") return;

    const appliance = appliances[selectedIndex];
    if (!selectedAppliances.includes(appliance)) {
        selectedAppliances.push(appliance);
        displayApplianceList();
    }

    // Reset the dropdown to the default option
    applianceDropdown.value = "";
}

appliances.forEach((appliance, index) => {
    const option = document.createElement("option");
    option.value = index;
    option.textContent = appliance.name;
    applianceDropdown.appendChild(option);
});

        function addCustomAppliance() {
            const name = document.getElementById("customApplianceName").value.trim();
            const power = parseFloat(document.getElementById("customAppliancePower").value);
            if (!name || isNaN(power) || power <= 0) {
                alert("Please enter valid appliance name and power usage.");
                return;
            }
            selectedAppliances.push({ name, power });
            displayApplianceList();
        }

        function displayApplianceList() {
            const applianceList = document.getElementById("applianceList");
            applianceList.innerHTML = "";
            selectedAppliances.forEach((appliance, index) => {
                applianceList.innerHTML += `
                    <div class="appliance-row">
                        <span>${appliance.name} (${appliance.power}W):</span>
                        <input type="number" id="hours-${index}" placeholder="Hours/day" />
                    </div>`;
            });
        }

        function calculateUsage() {
    const yakaUnits = parseFloat(document.getElementById("yakaUnits").value);
    if (isNaN(yakaUnits) || yakaUnits <= 0) {
        alert("Enter valid Yaka units.");
        return;
    }

    let totalKwh = 0;
    let breakdown = "";
    selectedAppliances.forEach((appliance, index) => {
        const hours = parseFloat(document.getElementById(`hours-${index}`).value) || 0;
        const kwh = (appliance.power / 1000) * hours;
        totalKwh += kwh;
        breakdown += `<p>${appliance.name}: ${kwh.toFixed(2)} kWh/day (${hours} hours/day).</p>`;
    });

    const totalHours = (yakaUnits / totalKwh) * 24;

    // Convert total hours into days, hours, minutes, and seconds
    const days = Math.floor(totalHours / 24);
    const hours = Math.floor(totalHours % 24);
    const minutes = Math.floor((totalHours % 1) * 60);
    const seconds = Math.floor(((totalHours % 1) * 60 - minutes) * 60);

    // Store the interaction in localStorage
    const interaction = {
        yakaUnits,
        selectedAppliances: [...selectedAppliances],
        totalKwh,
        totalHours,
        days,
        hours,
        minutes,
        seconds,
    };
    interactionHistory.push(interaction);
    localStorage.setItem("interactionHistory", JSON.stringify(interactionHistory));

    document.getElementById("result").innerHTML = `
        <h3>Your Yaka units will last ${days} days, ${hours} hours, ${minutes} minutes, and ${seconds} seconds.</h3>
        <div class="breakdown">
            <h4>Breakdown:</h4>
            ${breakdown}
        </div>`;
    document.getElementById("result").style.display = "block";
    document.getElementById("adjustmentOptions").style.display = "block";
}


        function showAdjustments() {
            document.getElementById("adjustmentsForm").style.display = "block";
            document.getElementById("adjustmentFields").innerHTML = "";
            selectedAppliances.forEach((appliance, index) => {
                document.getElementById("adjustmentFields").innerHTML += `
                    <div class="adjustment-row">
                        <label>${appliance.name} (${appliance.power}W):</label>
                        <input type="number" id="adjustment-${index}" placeholder="Hours/day" />
                    </div>`;
            });
        }

        function hideAdjustments() {
            document.getElementById("adjustmentOptions").style.display = "none";
        }



        function recalculate() {
    const yakaUnits = parseFloat(document.getElementById("yakaUnits").value);
    if (isNaN(yakaUnits) || yakaUnits <= 0) {
        alert("Enter valid Yaka units.");
        return;
    }
    let totalKwh = 0;
    let breakdown = "";
    selectedAppliances.forEach((appliance, index) => {
        const hours = parseFloat(document.getElementById(`adjustment-${index}`).value) || 0;
        const kwh = (appliance.power / 1000) * hours;
        totalKwh += kwh;
        breakdown += `<p>${appliance.name}: ${kwh.toFixed(2)} kWh/day (${hours} hours/day).</p>`;
    });

    const totalHours = (yakaUnits / totalKwh) * 24;

    // Convert totalHours into days, hours, minutes, and seconds
    const days = Math.floor(totalHours / 24);
    const hours = Math.floor(totalHours % 24);
    const minutes = Math.floor((totalHours % 1) * 60);
    const seconds = Math.floor(((totalHours % 1) * 60 - minutes) * 60);

    document.getElementById("result").innerHTML = `
        <h3>Your Yaka units will last ${days} days, ${hours} hours, ${minutes} minutes, and ${seconds} seconds.</h3>
        <div class="breakdown">
            <h4>Breakdown:</h4>
            ${breakdown}
        </div>`;
    document.getElementById("result").style.display = "block";
}


// function showHistoryOverlay() {
//     const historyList = document.getElementById("historyList");
//     historyList.innerHTML = "";

//     // Check if there is any interaction history
//     if (interactionHistory.length === 0) {
//         historyList.innerHTML = `<p>No interaction history found.</p>`;
//         document.getElementById("historyOverlay").style.display = "block";
//         return;
//     }

//     // Loop through interaction history and display each item with a trash icon
//     interactionHistory.forEach((interaction, index) => {
//         historyList.innerHTML += `
//             <div class="history-item mb-4 p-4 bg-gray-100 rounded shadow relative flex items-center">
//                 <button
//                     class="delete-btn mr-4 bg-blue-500 text-white rounded-full p-2"
//                     onclick="deleteInteraction(${index})">
//                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
//                         <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m2 10H7a2 2 0 01-2-2V7h14v14a2 2 0 01-2 2zM5 7h14m-6-3v3m2 0V4m-6 0v3" />
//                     </svg>
//                 </button>
//                 <div>
//                     <h4>Interaction #${index + 1}</h4>
//                     <p><strong>Yaka Units:</strong> ${interaction.yakaUnits}</p>
//                     <p><strong>Total KWh:</strong> ${interaction.totalKwh.toFixed(2)}</p>
//                     <p><strong>Time Remaining:</strong> ${interaction.days} days, ${interaction.hours} hours, ${interaction.minutes} minutes, and ${interaction.seconds} seconds.</p>
//                     <h5 class="mt-2">Appliances Used:</h5>
//                     <ul>
//                         ${interaction.selectedAppliances
//                             .map(appliance => `<li>${appliance.name} (${appliance.power}W)</li>`)
//                             .join('')}
//                     </ul>
//                 </div>
//             </div>
//         `;
//     });

//     document.getElementById("historyOverlay").style.display = "block";
// }
// function showHistoryOverlay() {
//     const historyContent = document.getElementById("historyContent");
//     historyContent.innerHTML = ""; // Clear any previous content

//     // Retrieve interaction history from localStorage
//     const history = JSON.parse(localStorage.getItem("interactionHistory")) || [];

//     if (history.length === 0) {
//         historyContent.innerHTML = "<p>No history available.</p>";
//     } else {
//         history.forEach((entry, index) => {
//             const { yakaUnits, selectedAppliances, totalKwh, days, hours, minutes, seconds } = entry;
//             const appliances = selectedAppliances
//                 .map(appliance => `${appliance.name} (${appliance.power}W)`)
//                 .join(", ");

//             historyContent.innerHTML += `
//                 <div class="history-entry mb-3">
//                     <h4>Interaction ${index + 1}</h4>
//                     <p><strong>Yaka Units:</strong> ${yakaUnits}</p>
//                     <p><strong>Appliances:</strong> ${appliances}</p>
//                     <p><strong>Total kWh:</strong> ${totalKwh.toFixed(2)}</p>
//                     <p><strong>Duration:</strong> ${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds</p>
//                 </div>
//                 <hr />
//             `;
//         });
//     }

//     // Show the overlay
//     document.getElementById("historyOverlay").style.display = "block";
// }
function showHistoryOverlay() {
    const historyContent = document.getElementById("historyContent");
    historyContent.innerHTML = ""; // Clear previous content

    // Retrieve interaction history from localStorage
    const history = JSON.parse(localStorage.getItem("interactionHistory")) || [];

    if (history.length === 0) {
        historyContent.innerHTML = "<p>No history available.</p>";
    } else {
        history.forEach((entry, index) => {
            const { yakaUnits, selectedAppliances, totalKwh, days, hours, minutes, seconds } = entry;
            const appliances = selectedAppliances
                .map(appliance => `${appliance.name} (${appliance.power}W)`)
                .join(", ");

            historyContent.innerHTML += `
                <div class="history-entry">
                    <h4>Interaction ${index + 1}</h4>
                    <p><strong>Yaka Units:</strong> ${yakaUnits}</p>
                    <p><strong>Appliances:</strong> ${appliances}</p>
                    <p><strong>Total kWh:</strong> ${totalKwh.toFixed(2)}</p>
                    <p><strong>Duration:</strong> ${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds</p>
                    <span class="delete-btn" onclick="deleteHistoryEntry(${index})">Delete</span>
                </div>
            `;
        });
    }

    // Show the overlay
    document.getElementById("historyOverlay").style.display = "block";
}
function closeHistoryOverlay() {
    document.getElementById("historyOverlay").style.display = "none";
}

function deleteHistoryEntry(index) {
    // Retrieve history from localStorage
    let history = JSON.parse(localStorage.getItem("interactionHistory")) || [];

    // Remove the specific entry by index
    history.splice(index, 1);

    // Save the updated history back to localStorage
    localStorage.setItem("interactionHistory", JSON.stringify(history));

    // Refresh the history overlay
    showHistoryOverlay();
}
    // Delete interaction from history
    function deleteInteraction(index) {
        // Remove the interaction from the history array
        interactionHistory.splice(index, 1);
        // Save the updated history back to localStorage
        localStorage.setItem("interactionHistory", JSON.stringify(interactionHistory));
        // Update the displayed history
        showHistoryOverlay();
    }

        function closeHistoryOverlay() {
            document.getElementById("historyOverlay").style.display = "none";
        }


        function refreshPage() {
            location.reload();
        }
    </script>

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
                        <i class="fas fa-home me-2"></i>
                        {{ __('Cost') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-link me-2"></i>
                        {{ __('Connected Devices') }}
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Usage Op</h1>
                <p class="text-center mb-4">Enter your Yaka units and select appliances to calculate how long your units will last.</p>

                <!-- Step 1: Enter Yaka Units -->
                <h2 class="text-lg font-semibold text-[#00796b]">Enter Yaka Units</h2>
                <input type="number" id="yakaUnitsMobile" placeholder="Enter Yaka Units" class="form-control mb-4" />

                <!-- Step 2: Choose Appliances -->
                <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
                <div class="dropdown mb-4">
                    <select id="applianceDropdownMobile" class="form-control" onchange="addApplianceMobile()">
                        <option value="">-- Select an Appliance --</option>
                    </select>
                </div>

                <!-- Step 3: Add Custom Appliance -->
                <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
                <div class="custom-appliance mb-4">
                    <input type="text" id="customApplianceNameMobile" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePowerMobile" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn w-100" onclick="addCustomApplianceMobile()">Add Custom Appliance</button>
                </div>

                <!-- Step 4: Set Usage Details -->
                <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
                <div id="applianceListMobile" class="appliance-list mb-4"></div>
                <button class="btn w-100" onclick="calculateUsageMobile()">Calculate</button>

                <!-- Results -->
                <div id="resultMobile" class="result mt-4" style="display: none;"></div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const appliancesMobile = [
            { name: "Fridge", power: 150 },
            { name: "TV", power: 100 },
            { name: "Washing Machine", power: 500 },
            { name: "Electric Iron", power: 1000 },
            { name: "Microwave", power: 1200 },
            { name: "Laptop", power: 65 },
            { name: "Fan", power: 70 },
            { name: "Lights", power: 60 },
        ];

        const applianceDropdownMobile = document.getElementById("applianceDropdownMobile");
        const selectedAppliancesMobile = [];

        appliancesMobile.forEach((appliance, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = appliance.name;
            applianceDropdownMobile.appendChild(option);
        });

        function addApplianceMobile() {
            const selectedIndex = applianceDropdownMobile.value;
            if (selectedIndex === "") return;

            const appliance = appliancesMobile[selectedIndex];
            if (!selectedAppliancesMobile.includes(appliance)) {
                selectedAppliancesMobile.push(appliance);
                displayApplianceListMobile();
            }

            // Reset the dropdown to the default option
            applianceDropdownMobile.value = "";
        }

        function addCustomApplianceMobile() {
            const name = document.getElementById("customApplianceNameMobile").value.trim();
            const power = parseFloat(document.getElementById("customAppliancePowerMobile").value);
            if (!name || isNaN(power) || power <= 0) {
                alert("Please enter valid appliance name and power usage.");
                return;
            }
            selectedAppliancesMobile.push({ name, power });
            displayApplianceListMobile();
        }

        function displayApplianceListMobile() {
            const applianceListMobile = document.getElementById("applianceListMobile");
            applianceListMobile.innerHTML = "";
            selectedAppliancesMobile.forEach((appliance, index) => {
                applianceListMobile.innerHTML += `
                    <div class="appliance-row">
                        <span>${appliance.name} (${appliance.power}W):</span>
                        <input type="number" id="hoursMobile-${index}" placeholder="Hours/day" />
                    </div>`;
            });
        }

        function calculateUsageMobile() {
            const yakaUnits = parseFloat(document.getElementById("yakaUnitsMobile").value);
            if (isNaN(yakaUnits) || yakaUnits <= 0) {
                alert("Enter valid Yaka units.");
                return;
            }

            let totalKwh = 0;
            let breakdown = "";
            selectedAppliancesMobile.forEach((appliance, index) => {
                const hours = parseFloat(document.getElementById(`hoursMobile-${index}`).value) || 0;
                const kwh = (appliance.power / 1000) * hours;
                totalKwh += kwh;
                breakdown += `<p>${appliance.name}: ${kwh.toFixed(2)} kWh/day (${hours} hours/day).</p>`;
            });

            const totalHours = (yakaUnits / totalKwh) * 24;

            const days = Math.floor(totalHours / 24);
            const hours = Math.floor(totalHours % 24);
            const minutes = Math.floor((totalHours % 1) * 60);
            const seconds = Math.floor(((totalHours % 1) * 60 - minutes) * 60);

            document.getElementById("resultMobile").innerHTML = `
                <h3>Your Yaka units will last ${days} days, ${hours} hours, ${minutes} minutes, and ${seconds} seconds.</h3>
                <div class="breakdown">
                    <h4>Breakdown:</h4>
                    ${breakdown}
                </div>`;
            document.getElementById("resultMobile").style.display = "block";
        }

        // Mobile Menu Toggle
        document.getElementById("menuToggle").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("hidden");
        });
    </script>


<script>
    // Function to load connected devices from localStorage
    function loadConnectedDevices() {
        const connectedDevices = JSON.parse(localStorage.getItem("connected_devices") || "[]");
        const devicesList = document.getElementById("connectedDevicesList");

        // Clear the list before populating
        devicesList.innerHTML = "";

        if (connectedDevices.length > 0) {
            connectedDevices.forEach((device) => {
                const deviceElement = document.createElement("li");
                deviceElement.innerHTML = `
                    <div>
                        <p class="device-name">${device.name}</p>
                        <p class="device-type">${device.type}</p>
                    </div>
                `;
                devicesList.appendChild(deviceElement);
            });
        } else {
            devicesList.innerHTML = `<li>No devices connected.</li>`;
        }
    }

    // Function to toggle the visibility of the connected devices list
    function toggleConnectedDevices() {
        const devicesSection = document.getElementById("connectedDevicesSection");
        const toggleButton = document.getElementById("toggleDevicesButton");

        if (devicesSection.style.display === "none") {
            devicesSection.style.display = "block";
            toggleButton.textContent = "Hide Connected Devices";
            loadConnectedDevices(); // Load devices when the section is shown
        } else {
            devicesSection.style.display = "none";
            toggleButton.textContent = "Show Connected Devices";
        }
    }

    // Add event listener to the toggle button
    document.getElementById("toggleDevicesButton").addEventListener("click", toggleConnectedDevices);
</script>

<style>
    /* body {
        font-family: Arial, sans-serif;
        background-color: #f1f8e9;
        margin: 0;
        padding: 20px;
    } */
    .ccontainer {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 600px;
        margin: 0 auto;
    }
    h1 {
        text-align: center;
        color: #2e7d32;
    }
    /* ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }
    li:last-child {
        border-bottom: none;
    } */
    .device-name {
        font-weight: bold;
    }
    .device-type {
        color: #757575;
        font-size: 0.9em;
    }
    #toggleDevicesButton {
        background-color: #2e7d32;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        margin-bottom: 20px;
    }
    #toggleDevicesButton:hover {
        background-color: #1b5e20;
    }
</style>


</x-app-layout>

<div class="ccontainer p-4 border rounded-lg shadow-md bg-white">
    <!-- Button to Show/Hide Saved Lists -->
    <button id="toggleListsButton" class="bg-[#00796b] text-white px-4 py-2 rounded-md mb-4">
        Show Saved Lists
    </button>

    <!-- Saved Lists Section (Initially Hidden) -->
    <div id="savedListsSection" style="display: none;">
        <h2 class="text-lg font-semibold text-[#00796b] mb-4">Saved Lists</h2>
        <div id="savedListsContent">
            <!-- Lists will be dynamically added here -->
        </div>
    </div>
</div>

<script>
    // Toggle Saved Lists Section
    document.getElementById("toggleListsButton").addEventListener("click", function () {
        const section = document.getElementById("savedListsSection");
        section.style.display = section.style.display === "none" ? "block" : "none";
    });

    // Function to delete a saved list
    function deleteSavedList(index) {
        let savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
        savedLists.splice(index, 1);
        localStorage.setItem("applianceLists", JSON.stringify(savedLists));
        displaySavedLists(); // Refresh list display
    }

    // Function to display saved lists
    function displaySavedLists() {
        let savedListsElement = document.getElementById("savedListsContent");
        let savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];

        if (savedLists.length === 0) {
            savedListsElement.innerHTML = "<p class='text-gray-500'>No lists saved yet.</p>";
        } else {
            savedListsElement.innerHTML = `
                <div class="flex flex-wrap gap-4">
                    ${savedLists.map((list, i) => `
                        <div class="mb-3 p-3 border rounded flex justify-between w-1/3 relative bg-gray-100">
                            <div>
                                <h4 class="font-semibold">List ${i + 1}</h4>
                                <ul class="list-disc pl-4">
                                    ${list.map(a => `<li>${a.name} (${a.power}W)</li>`).join("")}
                                </ul>
                            </div>
                            <button class="text-red-500 absolute top-0 right-0 text-2xl"
                                style="background: none; border: none;"
                                onclick="deleteSavedList(${i})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    `).join("")}
                </div>
            `;
        }
    }

    // Load saved lists on page load
    window.onload = displaySavedLists;
</script>


