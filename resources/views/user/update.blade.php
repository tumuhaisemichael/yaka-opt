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
                <li>
                    <a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka') }}
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

                <!-- Add this below the "Choose Your Appliances" section -->
                <h2 class="text-lg font-semibold text-[#00796b]">Load Saved Appliance List</h2>
                <div class="dropdown mb-4">
                    <select id="savedListsDropdown" class="form-control" onchange="loadSavedList()">
                        <option value="">-- Select a Saved List --</option>
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
<!-- overlay -->
                <div id="resultOverlay" class="overlay" style="display: none;">
                <div class="overlay-content">
                    <div id="resultOverlayContent"></div>
                </div>
            </div>
<style>.timer-display {
    margin-left: 10px;
    font-weight: bold;
}

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
}</style>

<!-- <div class="appliance-row flex items-center justify-between mb-2">
    <span>${appliance.name} (${appliance.power}W):</span>
    <input type="number" id="hours-${index}" placeholder="Hours/day" class="form-control w-1/4" />
    <button class="btn btn-sm btn-outline-primary" onclick="startTimer(${index})">Start Timer</button>
    <button class="btn btn-sm btn-outline-danger" onclick="stopTimer(${index})">Stop Timer</button>
    <button class="btn btn-sm btn-outline-success" onclick="scheduleTimer(${index})">Schedule</button>
</div> -->
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


        // Add this to the existing script
        function populateSavedListsDropdown() {
            const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
            const dropdown = document.getElementById("savedListsDropdown");
            dropdown.innerHTML = "<option value=''>-- Select a Saved List --</option>";
            savedLists.forEach((list, index) => {
                const option = document.createElement("option");
                option.value = index;
                option.textContent = `List ${index + 1}`;
                dropdown.appendChild(option);
            });
        }

        // Call this function when the page loads
        populateSavedListsDropdown();


        // Add this to the existing script
        function loadSavedList() {
            const dropdown = document.getElementById("savedListsDropdown");
            const selectedIndex = dropdown.value;
            if (selectedIndex === "") return;

            const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
            const selectedList = savedLists[selectedIndex];

            // Clear the current selected appliances
            selectedAppliances.length = 0;

            // Add the appliances from the saved list
            selectedList.forEach(appliance => {
                selectedAppliances.push(appliance);
            });

            // Display the selected appliances
            displayApplianceList();
        }



function displayApplianceList() {
    const applianceList = document.getElementById("applianceList");
    applianceList.innerHTML = "";
    selectedAppliances.forEach((appliance, index) => {
        applianceList.innerHTML += `
            <div class="appliance-row flex items-center justify-between bg-gray-100 p-3 rounded-lg shadow-md mb-3">
                <span class="text-lg font-semibold">${appliance.name} (${appliance.power}W):</span>
                <input type="number" id="hours-${index}" placeholder="Hours/day" class="form-control w-1/5 p-2 border border-gray-300 rounded-md" />
                <div class="flex gap-2">
                    <button class="btn btn-sm bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600" onclick="startTimer(${index})">Start Timer</button>
                    <button class="btn btn-sm bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="stopTimer(${index})">Stop Timer</button>
                    <button class="btn btn-sm bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600" onclick="scheduleTimer(${index})">Schedule</button>
                </div>
            </div>`;
    });
}


let timerIntervals = {}; // Store intervals for each appliance timer

function startTimer(index) {
    const hoursInput = document.getElementById(`hours-${index}`);
    const hours = parseFloat(hoursInput.value);
    if (isNaN(hours) || hours <= 0) {
        alert("Please enter a valid number of hours.");
        return;
    }

    const seconds = hours * 3600;
    let remainingTime = seconds;

    let timerDisplay = document.getElementById(`timer-${index}`);
    if (!timerDisplay) {
        timerDisplay = document.createElement("div");
        timerDisplay.id = `timer-${index}`;
        timerDisplay.className = "timer-display";
        hoursInput.parentNode.appendChild(timerDisplay);
    }

    // Stop any existing timer for this appliance
    if (timerIntervals[index]) {
        clearInterval(timerIntervals[index]);
    }

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
}

function stopTimer(index) {
    if (timerIntervals[index]) {
        clearInterval(timerIntervals[index]);
        delete timerIntervals[index];
        const timerDisplay = document.getElementById(`timer-${index}`);
        if (timerDisplay) {
            timerDisplay.textContent = "Timer stopped.";
        }
    }
}

function scheduleTimer(index) {
    const scheduleTime = prompt("Enter the time to start the timer (HH:MM, 24-hour format):");
    if (!scheduleTime || !/^(\d{2}):(\d{2})$/.test(scheduleTime)) {
        alert("Please enter a valid time in HH:MM format.");
        return;
    }

    const now = new Date();
    const [hours, minutes] = scheduleTime.split(":").map(Number);
    const scheduledTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes);

    if (scheduledTime <= now) {
        scheduledTime.setDate(scheduledTime.getDate() + 1); // Schedule for the next day if time has passed
    }

    const delay = scheduledTime - now;
    setTimeout(() => {
        startTimer(index);
        alert(`Timer started for ${selectedAppliances[index].name} at ${scheduleTime}.`);
    }, delay);

    alert(`Timer scheduled to start at ${scheduledTime.toLocaleTimeString()}.`);
}


            document.addEventListener("DOMContentLoaded", () => {
                populateSavedListsDropdown();
            });



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
        const units = (appliance.power / 1000) * hours;
        totalKwh += units;
        breakdown += `<p>${appliance.name}: ${units.toFixed(2)} units/day (${hours} hours/day).</p>`;
    });

    const totalHours = (yakaUnits / totalKwh) * 24;
    const days = Math.floor(totalHours / 24);
    const hours = Math.floor(totalHours % 24);
    const minutes = Math.floor((totalHours % 1) * 60);
    const seconds = Math.floor(((totalHours % 1) * 60 - minutes) * 60);

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

    // Display results in an overlay
    const overlayContent = `
        <h3>Your Yaka units will last ${days} days, ${hours} hours, ${minutes} minutes, and ${seconds} seconds.</h3>
        <div class="breakdown">
            <h4>Breakdown:</h4>
            ${breakdown}
        </div>
        <button onclick="closeResultOverlay()" class="btn btn-primary mt-3">Close</button>`;
    document.getElementById("resultOverlayContent").innerHTML = overlayContent;
    document.getElementById("resultOverlay").style.display = "block";
}

function closeResultOverlay() {
    document.getElementById("resultOverlay").style.display = "none";
    document.getElementById("result").innerHTML = document.getElementById("resultOverlayContent").innerHTML;
    document.getElementById("result").style.display = "block";
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
    <!-- Mobile Layout -->
    <div class="md:hidden">
        <!-- Mobile Header -->
        <div class="bg-[#004d40] p-4">
            <button id="menuToggleMobile" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenuMobile" class="hidden bg-[#004d40] p-4">
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
                <li>
                    <a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka') }}
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
                <input type="number" id="yakaUnitsInputMobile" placeholder="Enter Yaka Units" class="w-full p-2 border rounded mb-4" />

                <!-- Step 2: Choose Appliances -->
                <h2 class="text-lg font-semibold text-[#00796b]">Choose Your Appliances</h2>
                <select id="applianceDropdownMobile" class="w-full p-2 border rounded mb-4" onchange="addApplianceMobile()">
                    <option value="">-- Select an Appliance --</option>
                </select>

                <!-- Step 3: Load Saved Appliance List -->
                <h2 class="text-lg font-semibold text-[#00796b]">Load Saved Appliance List</h2>
                <select id="savedListsDropdownMobile" class="w-full p-2 border rounded mb-4" onchange="loadSavedListMobile()">
                    <option value="">-- Select a Saved List --</option>
                </select>

                <!-- Step 4: Add Custom Appliance -->
                <h2 class="text-lg font-semibold text-[#00796b]">Add Custom Appliance</h2>
                <div class="mb-4">
                    <input type="text" id="customApplianceNameMobile" placeholder="Enter Appliance Name" class="w-full p-2 border rounded mb-2" />
                    <input type="number" id="customAppliancePowerMobile" placeholder="Enter Power Usage (Watts)" class="w-full p-2 border rounded mb-2" />
                    <button onclick="addCustomApplianceMobile()" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Add Custom Appliance</button>
                </div>

                <!-- Step 5: Set Usage Details -->
                <h2 class="text-lg font-semibold text-[#00796b]">Set Usage Details</h2>
                <div id="applianceListMobile" class="mb-4"></div>
                <button onclick="calculateUsageMobile()" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Calculate</button>

                <!-- Results -->
                <div id="resultMobile" class="mt-4 p-4 bg-gray-100 rounded" style="display: none;"></div>

                <!-- Timer Section -->
                <div id="timerSectionMobile" class="mt-6">
                    <h2 class="text-lg font-semibold text-[#00796b]">Appliance Timers</h2>
                    <div id="timerDisplayMobile" class="mb-4"></div>
                </div>

                <!-- Connected Devices Section -->
                <div class="mt-6">
                    <button id="toggleDevicesButtonMobile" class="w-full bg-[#2e7d32] text-white py-2 rounded hover:bg-[#1b5e20]">Show Connected Devices</button>
                    <div id="connectedDevicesSectionMobile" class="mt-4" style="display: none;">
                        <h2 class="text-lg font-semibold text-[#00796b]">Connected Devices</h2>
                        <ul id="connectedDevicesListMobile" class="list-unstyled"></ul>
                    </div>
                </div>
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
        const savedListsDropdownMobile = document.getElementById("savedListsDropdownMobile");
        const selectedAppliancesMobile = [];
        const timerIntervalsMobile = {}; // Store intervals for each appliance timer

        // Populate appliance dropdown
        appliancesMobile.forEach((appliance, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = appliance.name;
            applianceDropdownMobile.appendChild(option);
        });

        // Populate saved lists dropdown
        // function populateSavedListsDropdownMobile() {
        //     const savedLists = JSON.parse(localStorage.getItem("applianceListsMobile")) || [];
        //     savedListsDropdownMobile.innerHTML = "<option value=''>-- Select a Saved List --</option>";
        //     savedLists.forEach((list, index) => {
        //         const option = document.createElement("option");
        //         option.value = index;
        //         option.textContent = `List ${index + 1}`;
        //         savedListsDropdownMobile.appendChild(option);
        //     });
        // }

        function populateSavedListsDropdownMobile() {
        const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
        const savedListsDropdownMobile = document.getElementById("savedListsDropdownMobile");
        savedListsDropdownMobile.innerHTML = "<option value=''>-- Select a Saved List --</option>";
        savedLists.forEach((list, index) => {
            const option = document.createElement("option");
            option.value = index;
            option.textContent = `List ${index + 1}`;
            savedListsDropdownMobile.appendChild(option);
        });
    }

        // Add appliance to list
        function addApplianceMobile() {
            const selectedIndex = applianceDropdownMobile.value;
            if (selectedIndex === "") return;

            const appliance = appliancesMobile[selectedIndex];
            if (!selectedAppliancesMobile.includes(appliance)) {
                selectedAppliancesMobile.push(appliance);
                displayApplianceListMobile();
            }
            applianceDropdownMobile.value = ""; // Reset dropdown
        }

        // Add custom appliance
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

        // Display appliance list with timers
        function displayApplianceListMobile() {
            const applianceListMobile = document.getElementById("applianceListMobile");
            applianceListMobile.innerHTML = ""; // Clear the list before repopulating

            selectedAppliancesMobile.forEach((appliance, index) => {
                applianceListMobile.innerHTML += `
                    <div class="appliance-row flex items-center justify-between bg-gray-100 p-3 rounded-lg shadow-md mb-3">
                        <span class="text-lg font-semibold">${appliance.name} (${appliance.power}W):</span>
                        <input type="number" id="hoursMobile-${index}" placeholder="Hours/day" class="w-1/4 p-2 border rounded" />
                        <div class="flex gap-2">
                            <button class="btn btn-sm bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600" onclick="startTimerMobile(${index})">Start Timer</button>
                            <button class="btn btn-sm bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="stopTimerMobile(${index})">Stop Timer</button>
                        </div>
                    </div>`;
            });
        }

        // Start timer for an appliance
        function startTimerMobile(index) {
            const hoursInput = document.getElementById(`hoursMobile-${index}`);
            const hours = parseFloat(hoursInput.value);
            if (isNaN(hours) || hours <= 0) {
                alert("Please enter a valid number of hours.");
                return;
            }

            const seconds = hours * 3600;
            let remainingTime = seconds;

            const timerDisplay = document.createElement("div");
            timerDisplay.id = `timerMobile-${index}`;
            timerDisplay.className = "timer-display";
            hoursInput.parentNode.appendChild(timerDisplay);

            // Stop any existing timer for this appliance
            if (timerIntervalsMobile[index]) {
                clearInterval(timerIntervalsMobile[index]);
            }

            timerIntervalsMobile[index] = setInterval(() => {
                remainingTime--;
                const hoursLeft = Math.floor(remainingTime / 3600);
                const minutesLeft = Math.floor((remainingTime % 3600) / 60);
                const secondsLeft = remainingTime % 60;

                timerDisplay.textContent = `${hoursLeft}h ${minutesLeft}m ${secondsLeft}s`;

                if (remainingTime <= 0) {
                    clearInterval(timerIntervalsMobile[index]);
                    timerDisplay.textContent = "Time's up!";
                }
            }, 1000);
        }

        // Stop timer for an appliance
        function stopTimerMobile(index) {
            if (timerIntervalsMobile[index]) {
                clearInterval(timerIntervalsMobile[index]);
                const timerDisplay = document.getElementById(`timerMobile-${index}`);
                if (timerDisplay) {
                    timerDisplay.textContent = "Timer stopped.";
                }
            }
        }

        // Load saved list
        // function loadSavedListMobile() {
        //     const selectedIndex = savedListsDropdownMobile.value;
        //     if (selectedIndex === "") return;

        //     const savedLists = JSON.parse(localStorage.getItem("applianceListsMobile")) || [];
        //     const selectedList = savedLists[selectedIndex];

        //     // Clear the current selected appliances
        //     selectedAppliancesMobile.length = 0;

        //     // Add the appliances from the saved list
        //     selectedList.forEach(appliance => {
        //         selectedAppliancesMobile.push(appliance);
        //     });

        //     // Display the selected appliances
        //     displayApplianceListMobile();
        // }

        function loadSavedListMobile() {
        const selectedIndex = document.getElementById("savedListsDropdownMobile").value;
        if (selectedIndex === "") return;

        const savedLists = JSON.parse(localStorage.getItem("applianceLists")) || [];
        const selectedList = savedLists[selectedIndex];

        selectedAppliancesMobile.length = 0;
        selectedList.forEach(appliance => {
            selectedAppliancesMobile.push(appliance);
        });
        displayApplianceListMobile();
    }

        // Calculate usage
        function calculateUsageMobile() {
            const yakaUnits = parseFloat(document.getElementById("yakaUnitsInputMobile").value);
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

        // Toggle mobile menu
        document.getElementById("menuToggleMobile").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenuMobile");
            mobileMenu.classList.toggle("hidden");
        });

        // Toggle connected devices
        document.getElementById("toggleDevicesButtonMobile").addEventListener("click", () => {
            const devicesSection = document.getElementById("connectedDevicesSectionMobile");
            devicesSection.style.display = devicesSection.style.display === "none" ? "block" : "none";
            loadConnectedDevicesMobile();
        });

        // Load connected devices
        function loadConnectedDevicesMobile() {
            const connectedDevices = JSON.parse(localStorage.getItem("connectedDevicesMobile")) || [];
            const devicesList = document.getElementById("connectedDevicesListMobile");
            devicesList.innerHTML = connectedDevices.map(device => `
                <li class="bg-gray-100 p-3 rounded-lg shadow-md mb-3">
                    <p class="font-semibold">${device.name}</p>
                    <p class="text-gray-600">${device.type}</p>
                </li>
            `).join("");
        }

        // Initialize saved lists dropdown
        populateSavedListsDropdownMobile();
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


</script>
