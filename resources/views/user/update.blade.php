<x-app-layout>
    <div class="flex" style="height: 100vh;">
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
                <!-- New Appliance Link -->
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow p-4 bg-[#e8f5e9] dark:bg-[#c8e6c9]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <h1 class="text-2xl font-bold text-[#004d40] text-center">Yaka Units Usage Calculator</h1>
                <p class="text-center mb-4">Enter your Yaka units and select appliances to calculate how long your units will last.</p>

                <!-- Step 1: Yaka Units -->
                <h2 class="text-lg font-semibold text-[#00796b]">Step 1: Enter Yaka Units</h2>
                <input type="number" id="yakaUnits" placeholder="Enter Yaka Units" class="form-control mb-4" />

                <!-- Step 2: Choose Appliances
                <h2 class="text-lg font-semibold text-[#00796b]">Step 2: Choose Your Appliances</h2>
                <div class="dropdown mb-4">
                    <select id="applianceDropdown" class="form-control">
                        <option value="">-- Select an Appliance --</option>
                    </select>
                    <button class="btn mt-2 w-100" onclick="addAppliance()">Add Appliance</button>
                </div> -->
<!-- Step 2: Choose Appliances -->
<h2 class="text-lg font-semibold text-[#00796b]">Step 2: Choose Your Appliances</h2>
<div class="dropdown mb-4">
    <select id="applianceDropdown" class="form-control" onchange="addAppliance()">
        <option value="">-- Select an Appliance --</option>
    </select>
</div>



                <!-- Step 3: Add Custom Appliance -->
                <h2 class="text-lg font-semibold text-[#00796b]">Step 3: Add Custom Appliance</h2>
                <div class="custom-appliance mb-4">
                    <input type="text" id="customApplianceName" placeholder="Enter Appliance Name" class="form-control mb-2" />
                    <input type="number" id="customAppliancePower" placeholder="Enter Power Usage (Watts)" class="form-control mb-2" />
                    <button class="btn w-100" onclick="addCustomAppliance()">Add Custom Appliance</button>
                </div>

                <!-- Step 4: Set Usage Details -->
                <h2 class="text-lg font-semibold text-[#00796b]">Step 4: Set Usage Details</h2>
                <div id="applianceList" class="appliance-list mb-4"></div>
                <button class="btn w-100" onclick="calculateUsage()">Calculate</button>

                <!-- Results -->
                <div id="result" class="result mt-4" style="display: none;"></div>

                <!-- Adjustment Options -->
                <div id="adjustmentOptions" class="adjustment-options mt-4" style="display: none;">
                    <h3 class="font-semibold">Would you like to adjust appliance usage to extend your Yaka units?</h3>
                    <button class="btn mt-2" onclick="showAdjustments()">Yes, make adjustments</button>
                    <button class="btn mt-2" onclick="hideAdjustments()">No, I'm fine</button>
                </div>

                <!-- Adjustments Form -->
                <!-- <div id="adjustmentsForm" class="adjustments-form mt-4" style="display: none;">
                    <h3 class="font-semibold">Make Your Adjustments</h3>
                    <div id="adjustmentFields"></div>
                    <button class="btn mt-2" onclick="recalculate()">Recalculate</button>
                </div> -->
                <div id="adjustmentOptions" class="adjustment-options mt-4" style="display: none;">
    <h3 class="font-semibold">Would you like to adjust appliance usage to extend your Yaka units?</h3>
    <!-- Button to show adjustments with link -->
    <button class="btn mt-2" onclick="showAdjustments(); window.location.href='https://cdn.botpress.cloud/webchat/v2.3/shareable.html?configUrl=https://files.bpcontent.cloud/2025/01/07/06/20250107061331-I57U8DS2.json';">
    Yes, make adjustments
</button>

    <!-- Updated refresh button -->
    <button class="btn btn-secondary w-100 mb-2" onclick="refreshPage()">Refresh</button>
</div>


                <!-- History and Refresh -->
                <div class="mt-4">
                    <button class="btn btn-secondary w-100 mb-2" onclick="refreshPage()">Refresh</button>
                    <button class="btn btn-info w-100" onclick="showHistoryOverlay()">View History</button>
                </div>
            </div>
        </div>
    </div>


    <div id="historyOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); color: white; z-index: 1000; overflow-y: auto;">
    <div style="max-width: 800px; margin: 50px auto; background: white; color: black; padding: 20px; border-radius: 8px;">
        <h2 class="text-xl font-bold text-center">Interaction History</h2>
        <div id="historyList" class="mt-4"></div>
        <button class="btn mt-4 w-100" onclick="closeHistoryOverlay()">Close</button>
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

        // function addAppliance() {
        //     const selectedIndex = applianceDropdown.value;
        //     if (selectedIndex === "") {
        //         alert("Please select an appliance to add.");
        //         return;
        //     }
        //     const appliance = appliances[selectedIndex];
        //     if (!selectedAppliances.includes(appliance)) {
        //         selectedAppliances.push(appliance);
        //         displayApplianceList();
        //     }
        // }
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


function showHistoryOverlay() {
    const historyList = document.getElementById("historyList");
    historyList.innerHTML = "";

    // Check if there is any interaction history
    if (interactionHistory.length === 0) {
        historyList.innerHTML = `<p>No interaction history found.</p>`;
        document.getElementById("historyOverlay").style.display = "block";
        return;
    }

    // Loop through interaction history and display each item with a trash icon
    interactionHistory.forEach((interaction, index) => {
        historyList.innerHTML += `
            <div class="history-item mb-4 p-4 bg-gray-100 rounded shadow relative flex items-center">
                <button
                    class="delete-btn mr-4 bg-blue-500 text-white rounded-full p-2"
                    onclick="deleteInteraction(${index})">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m2 10H7a2 2 0 01-2-2V7h14v14a2 2 0 01-2 2zM5 7h14m-6-3v3m2 0V4m-6 0v3" />
                    </svg>
                </button>
                <div>
                    <h4>Interaction #${index + 1}</h4>
                    <p><strong>Yaka Units:</strong> ${interaction.yakaUnits}</p>
                    <p><strong>Total KWh:</strong> ${interaction.totalKwh.toFixed(2)}</p>
                    <p><strong>Time Remaining:</strong> ${interaction.days} days, ${interaction.hours} hours, ${interaction.minutes} minutes, and ${interaction.seconds} seconds.</p>
                    <h5 class="mt-2">Appliances Used:</h5>
                    <ul>
                        ${interaction.selectedAppliances
                            .map(appliance => `<li>${appliance.name} (${appliance.power}W)</li>`)
                            .join('')}
                    </ul>
                </div>
            </div>
        `;
    });

    document.getElementById("historyOverlay").style.display = "block";
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


</x-app-layout>
